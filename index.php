<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Frutas Nieves Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
    }
    .navbar {
      background-color: #2d6a4f;
    }
    .navbar-brand, .nav-link, .navbar-toggler-icon {
      color: white !important;
    }
    .hero {
      background-image: url('https://www.frutasnievesonline.com/img/frutasnieves-logo-1605692362.jpg');
      background-size: cover;
      background-position: center;
      height: 300px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: bold;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }
    .product-card {
      border: none;
      transition: transform 0.2s ease-in-out;
    }
    .product-card:hover {
      transform: scale(1.02);
    }
    #chatWidget {
      position: fixed;
      bottom: 0;
      right: 20px;
      width: 100%;
      max-width: 400px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
      z-index: 1050;
    }
    #chatToggleBtn {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1040;
      background-color: #2d6a4f;
      color: white;
      font-size: 1.5rem;
      width: 60px;
      height: 60px;
      animation: bounceIn 0.5s;
    }
    @keyframes bounceIn {
      0% {
        transform: scale(0.3);
        opacity: 0;
      }
      50% {
        transform: scale(1.05);
        opacity: 0.8;
      }
      70% {
        transform: scale(0.9);
      }
      100% {
        transform: scale(1);
        opacity: 1;
      }
    }
    @media (max-width: 768px) {
      #chatWidget {
        right: 0;
        left: 0;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Frutas Nieves</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Frutas</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Verduras</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="hero">
  Bienvenido a Frutas Nieves Online 🍓
</div>

<div class="container py-5">
  <h2 class="mb-4">Productos destacados</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card product-card">
        <img src="https://www.frutasnievesonline.com/2200-medium_default/fruta-platano-canarias-superior-venta-online-frescos.jpg" class="card-img-top" alt="Plátano">
        <div class="card-body">
          <h5 class="card-title">Plátano de Canarias</h5>
          <p class="card-text">Origen: Canarias<br>Precio: 4.99 €/kg</p>
          <a href="#" class="btn btn-success">Comprar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card product-card">
        <img src="https://www.frutasnievesonline.com/2200-medium_default/fruta-manzana-roja-fresca.jpg" class="card-img-top" alt="Manzana Roja">
        <div class="card-body">
          <h5 class="card-title">Manzana Roja</h5>
          <p class="card-text">Origen: Galicia<br>Precio: 3.20 €/kg</p>
          <a href="#" class="btn btn-success">Comprar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card product-card">
        <img src="https://www.frutasnievesonline.com/2200-medium_default/verdura-brocoli-gallego.jpg" class="card-img-top" alt="Brócoli">
        <div class="card-body">
          <h5 class="card-title">Brócoli</h5>
          <p class="card-text">Origen: Galicia<br>Precio: 2.80 €/kg</p>
          <a href="#" class="btn btn-success">Comprar</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Botón flotante del chat personalizado -->
<button id="chatToggleBtn" class="btn rounded-circle shadow d-flex align-items-center justify-content-center"
        data-bs-toggle="tooltip" data-bs-placement="left" title="Habla con FrutarIA">
  <img src="https://cdn-icons-png.flaticon.com/512/590/590685.png" alt="IA" style="width: 24px; height: 24px; margin-right: 5px;">
  <span style="font-size: 0.75rem; font-weight: bold;">IA</span>
</button>

<!-- Chat Widget -->
<div id="chatWidget" class="bg-light d-none">
  <div class="d-flex justify-content-between align-items-center bg-success text-white px-3 py-2">
    <span>FrutarIA - Tu asistente</span>
    <button class="btn btn-sm btn-light" onclick="toggleChat()">&times;</button>
  </div>
  <div class="chat-body p-3" id="chat" style="height:300px; overflow-y:auto;"></div>
  <form id="chatForm" class="d-flex border-top">
    <input type="text" id="pregunta" class="form-control border-0" placeholder="Escribe tu pregunta...">
    <button class="btn btn-success" type="submit">Enviar</button>
  </form>
</div>

<script>
function toggleChat() {
  const widget = document.getElementById('chatWidget');
  widget.classList.toggle('d-none');
}

document.getElementById('chatToggleBtn').addEventListener('click', toggleChat);

document.getElementById('chatForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const input = document.getElementById('pregunta');
  const pregunta = input.value.trim();
  if (!pregunta) return;

  const chat = document.getElementById('chat');
  chat.innerHTML += `<div class='text-end mb-2'><strong>Tú:</strong> ${pregunta}</div>`;

  fetch('ajax.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'pregunta=' + encodeURIComponent(pregunta)
  })
  .then(response => response.text())
  .then(respuesta => {
    chat.innerHTML += `<div class='text-start text-success mb-2'><strong>FrutarIA:</strong> ${respuesta}</div>`;
    chat.scrollTop = chat.scrollHeight;
    input.value = '';
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
