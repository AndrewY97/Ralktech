<?php
function conectarBD()
{
    $host = '67.222.155.229';
    $dbname = 'devgdlho_ralken';
    $username = 'devgdlho_admin';
    $password = '$yMRzoe6ipy4ts@g';
    $port = '3306';
    try {
        $conexion = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        return null;
    }
}
