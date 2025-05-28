<?php
session_start();
require_once 'GeminiClient3.php';

$apiKey = 'API_KEY_AQUI'; // Reemplaza con tu clave de API de Gemini

// Guardar instancia de GeminiClient entre preguntas
if (!isset($_SESSION['chat'])) {
    $_SESSION['chat'] = serialize(new GeminiClient($apiKey));
}

$cliente = unserialize($_SESSION['chat']);
$pregunta = $_POST['pregunta'] ?? '';

if ($pregunta) {
    $respuesta = $cliente->preguntar($pregunta);
    $_SESSION['chat'] = serialize($cliente); // Actualizar historial
    echo $respuesta;
} else {
    echo "Pregunta vacía.";
}
