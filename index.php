<?php

require_once 'GeminiClient.php';

$apiKey = "TU_API_KEY_AQUI"; // Reemplaza con tu clave de API de Gemini
$cliente = new GeminiClient($apiKey);

$pregunta = "¿Cómo funciona la inteligencia artificial?";
$respuesta = $cliente->preguntar($pregunta);

echo "<strong>Respuesta:</strong> " . $respuesta;
