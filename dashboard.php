<?php
$maxlifetime = 3600;
$secure = true;
$httponly = true;
$samesite = 'Lax';

session_set_cookie_params([
    'lifetime' => $maxlifetime,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => $secure,
    'httponly' => $httponly,
    'samesite' => $samesite
]);
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
unset($_SESSION['error']);
unset($_SESSION['success']);
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'self'");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard - Ralktech</title>
    <link rel="icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <link rel="shortcut icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            text-align: center;
            padding: 20px 0;
            background-color: #ffffff;
            margin-bottom: 20px;
            border-bottom: 2px solid #bdc3c7;
        }

        header h1 {
            color: #2c3e50;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1;
            min-width: 250px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            color: #2c3e50;
        }

        .card ul {
            list-style: none;
            padding: 0;
        }

        .card ul li {
            margin: 10px 0;
            color: #2c3e50;
        }

        .card ul li:before {
            content: "•";
            color: #f39c12;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        button {
            padding: 10px 20px;
            background-color: #0a67b1;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e74c3c;
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        button:active {
            background-color: #f39c12;
        }

        .error {
            color: green;
            margin: 10px 0;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 40%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-body {
            padding: 20px 0;
        }

        .modal-footer {
            padding: 10px 20px;
            border-top: 1px solid #ddd;
            text-align: right;
        }

        .modal-button {
            padding: 10px 20px;
            background-color: #0a67b1;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-button:hover {
            background-color: #e74c3c;
        }

        .modal-button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .modal-button:active {
            background-color: #f39c12;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Dashboard Ralken</h1>
            <div class="header-buttons">
            </div>
        </header>
        <section class="cards">
            <div class="card desarrollo">
                <h2>Blog</h2>
                <ul>
                    <li><a href="ActualizarNoticias.php"><button>Crear Noticia</button></a></li>
                    <li><a href="listaNoticias.php"><button>Editar Noticias</button></a></li>
                </ul>
            </div>
            <div class="card integracion">
                <h2>Integración Tecnológica</h2>
                <ul>
                </ul>
            </div>
            <div class="card qa">
                <h2>Acciones</h2>
                <ul>
                    <li><a href="cerrar_sesion.php"><button>Cerrar Sesión</button></a></li>
                    <li><a href="index.php"><button>Ir a Inicio</button></a></li>
                </ul>
            </div>
            <div class="card estrategias">
                <h2>Estrategias de Digitalización</h2>
                <ul>
                </ul>
            </div>
        </section>
    </div>
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">¡Error!</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p><?php echo $error; ?></p>
            </div>
        </div>
    </div>
    <div id="successModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">¡Éxito!</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p><?php echo $success; ?></p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($error) : ?>
                var errorModal = document.getElementById("errorModal");
                errorModal.style.display = "block";
                var errorCloseButton = errorModal.querySelector(".close");
                errorCloseButton.onclick = function() {
                    errorModal.style.display = "none";
                }
            <?php endif; ?>
            <?php if ($success) : ?>
                var successModal = document.getElementById("successModal");
                successModal.style.display = "block";
                var successCloseButton = successModal.querySelector(".close");
                successCloseButton.onclick = function() {
                    successModal.style.display = "none";
                }
            <?php endif; ?>
        });
    </script>
</body>

</html>