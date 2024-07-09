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
require 'include/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);
    if (!empty($user) && !empty($pass)) {
        $conn = conectarBD();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM users WHERE user = :user");
            $stmt->bindParam(':user', $user, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $stored_password = $row['pass'];
                if ($pass === $stored_password) {
                    $_SESSION['user'] = $user;
                    header('Location: dashboard.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'Contraseña incorrecta';
                    header('Location: login.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Usuario o contraseña incorrectos';
                header('Location: login.php');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Error al conectar a la base de datos';
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Por favor, complete todos los campos';
        header('Location: login.php');
        exit();
    }
}
