<?php

class GeminiClient
{
    private $apiKey;
    private $modelUrl;
    private $xmlUrl;
    private $historial = [];

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->modelUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;
        $this->xmlUrl = "https://www.frutasnievesonline.com/fno_googleshopping-s1-es-EUR.xml";

        // Al iniciar, agregar contexto como primer mensaje del sistema
        $contexto = $this->generarContexto();
        $this->historial[] = [
            "role" => "user",
            "parts" => [["text" => $contexto . "\nResponde a las preguntas del cliente"]]
        ];
    }

    private function generarContexto($limite = 20)
    {
        $xml = simplexml_load_file($this->xmlUrl, null, LIBXML_NOCDATA);
        $contexto = "Catálogo de productos de Frutas Nieves Online:\n\n";
        $contador = 0;

        foreach ($xml->channel->item as $item) {
            $titulo = trim((string)$item->title);
            $precio = trim((string)$item->children('g', true)->price);
            $descripcion = trim((string)$item->description);

            $origen = "";
            $categoria = "";

            if (strpos($descripcion, "Origen:") !== false) {
                $partes = explode("Origen:", $descripcion);
                if (isset($partes[1])) {
                    $subpartes = explode("Categoría:", $partes[1]);
                    $origen = trim($subpartes[0]);
                    if (isset($subpartes[1])) {
                        $categoria = trim($subpartes[1]);
                    }
                }
            }

            $contexto .= "Producto: $titulo\n";
            $contexto .= "Precio: $precio\n";
            if ($origen) $contexto .= "Origen: $origen\n";
            if ($categoria) $contexto .= "Categoría: $categoria\n";
            $contexto .= "\n";

            $contador++;
            //if ($contador >= $limite) break;
        }

        return $contexto;
    }

    public function preguntar($pregunta)
    {
        // Añadir la nueva pregunta al historial
        $this->historial[] = [
            "role" => "user",
            "parts" => [["text" => $pregunta]]
        ];

        // Preparar el payload con todo el historial
        $input = [
            "contents" => $this->historial
        ];

        $ch = curl_init($this->modelUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input));

        $respuesta = curl_exec($ch);

        if (curl_errno($ch)) {
            return "Error en la conexión: " . curl_error($ch);
        }

        curl_close($ch);

        $json = json_decode($respuesta, true);
        $texto = $json['candidates'][0]['content']['parts'][0]['text'] ?? "No se obtuvo respuesta.";

        // Añadir la respuesta al historial
        $this->historial[] = [
            "role" => "model",
            "parts" => [["text" => $texto]]
        ];

        return $texto;
    }
}
