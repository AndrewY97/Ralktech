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
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
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
    <title>Login - Ralktech</title>
    <link rel="icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <link rel="shortcut icon" href="img\RALKTECH_FavIcon.svg" type="image/jpg">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #870000, #1c1c1c);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            text-align: center;
            width: 300px;
        }

        .login-container h1 {
            margin-bottom: 20px;
        }

        .login-container input,
        .login-container button {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: white;
            color: #1c1c1c;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #f0f0f0;
        }

        .login-container a {
            color: #ff9500;
            text-decoration: none;
            display: block;
            margin-top: 10px;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .logo img {
            height: 40px;
        }

        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
    <!-- Agrega estos enlaces para SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.svg" alt="Ralktech Logo" style="width: 140px">
        </a>
    </div>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form method="POST" action="logeo.php">
            <input type="text" name="user" placeholder="Correo electrónico" required>
            <input type="password" name="pass" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{$_SESSION['error']}',
                confirmButtonText: 'Aceptar'
            });
        </script>";
        unset($_SESSION['error']);
    }
    ?>
</body>

</html>