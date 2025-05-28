<?php

require_once 'GeminiClient.php';

$apiKey = "API_KEY"; // Reemplaza con tu clave de API de Gemini
$cliente = new GeminiClient($apiKey);

$contexto = <<<EOT
Eres un asistente de una frutería online. Aquí tienes el catálogo actualizado:

- Plátano de Canarias: 4.99€/kg
- Manzana Golden: 3.20€/kg
- Uva Blanca: 2.90€/kg
- Boniato blanco: 3.50€/kg

Responde a continuación a las preguntas del cliente usando solo esta información.
EOT;

$pregunta = $contexto . "\n\nCliente: ¿Cuál es el precio de las mandarinas? puedes comparar tres webs de venta online";
$respuesta = $cliente->preguntar($pregunta);

//$respuesta = $cliente->preguntar($pregunta);

echo "<strong>Respuesta:</strong> " . $respuesta;
