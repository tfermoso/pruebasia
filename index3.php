<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat con IA - Frutas Nieves</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        #chat { border: 1px solid #ccc; padding: 1rem; height: 300px; overflow-y: scroll; }
        .user { font-weight: bold; }
        .bot { color: green; margin-bottom: 1rem; }
    </style>
</head>
<body>

<h2>Asistente de Frutas Nieves 🍌</h2>

<div id="chat"></div>

<form id="chatForm">
    <input type="text" id="pregunta" placeholder="Escribe tu pregunta..." autocomplete="off" style="width: 60%;">
    <button type="submit">Enviar</button>
</form>

<script>
document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const input = document.getElementById('pregunta');
    const pregunta = input.value.trim();
    if (!pregunta) return;

    // Mostrar pregunta en chat
    const chat = document.getElementById('chat');
    chat.innerHTML += `<div class="user">Tú: ${pregunta}</div>`;

    // Enviar por AJAX
    fetch('ajax.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'pregunta=' + encodeURIComponent(pregunta)
    })
    .then(response => response.text())
    .then(respuesta => {
        chat.innerHTML += `<div class="bot">IA: ${respuesta}</div>`;
        chat.scrollTop = chat.scrollHeight;
        input.value = '';
    });
});
</script>

</body>
</html>
