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
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'self'");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Noticia</title>
    <link rel="icon" href="img/RALKTECH_FavIcon.svg" type="image/jpg">
    <link rel="shortcut icon" href="img/RALKTECH_FavIcon.svg" type="image/jpg">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input,
        textarea,
        select {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        input[type="file"] {
            padding: 10px 0;
        }

        .preview-image {
            max-width: calc(100% - 20px);
            max-height: 200px;
            margin: 10px auto;
            display: block;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            background-color: #003d80;
        }

        .cancel-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .cancel-button button {
            background-color: black;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .cancel-button button:hover {
            background-color: #333;
        }

        .cancel-button button:active {
            background-color: #000;
        }
    </style>
    <!-- Agrega estos enlaces para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <h1>Actualizar Noticias</h1>
        <form method="POST" action="actualizarN.php" enctype="multipart/form-data">
            <label for="nombre">Titulo (Maximo 150 caracteres):</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

            <label for="link">Link:</label>
            <input type="url" id="link" name="link" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="fecha_borrado">Fecha de Borrado:</label>
            <input type="date" id="fecha_borrado" name="fecha_borrado" required>

            <label for="imagen">Subir imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
            <img id="preview" class="preview-image" src="#" alt="Vista previa de la imagen" style="display: none;">
            <button type="submit">Actualizar</button>
        </form>
        <div class="cancel-button">
            <a href="dashboard.php">
                <button>Cancelar</button>
            </a>
        </div>
    </div>

    <script>
        function mostrarVistaPrevia(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById('imagen').addEventListener('change', function() {
            mostrarVistaPrevia(this);
        });
    </script>
</body>

</html>
