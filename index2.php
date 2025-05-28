<?php

require_once 'GeminiClient2.php';

$apiKey = "API_KEY"; // Reemplaza con tu clave de API de Gemini
$cliente = new GeminiClient($apiKey);



$pregunta = "\nCliente: ¿Cuál es el precio de las mandarinas? me haces una comparación entre mandarinas disponibles con preicio y origen";
$respuesta = $cliente->preguntar($pregunta);

//$respuesta = $cliente->preguntar($pregunta);

echo "<strong>Respuesta:</strong> " . $respuesta;
