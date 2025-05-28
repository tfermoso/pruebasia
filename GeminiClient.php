<?php

class GeminiClient
{
    private $apiKey;
    private $modelUrl;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->modelUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;
    }

    public function preguntar($texto)
    {
        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $texto]
                    ]
                ]
            ]
        ];

        $ch = curl_init($this->modelUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $respuesta = curl_exec($ch);

        if (curl_errno($ch)) {
            return "Error en la conexión: " . curl_error($ch);
        }

        curl_close($ch);

        $json = json_decode($respuesta, true);

        if (isset($json['candidates'][0]['content']['parts'][0]['text'])) {
            return $json['candidates'][0]['content']['parts'][0]['text'];
        } else {
            return "No se pudo obtener respuesta de la IA.";
        }
    }
}
