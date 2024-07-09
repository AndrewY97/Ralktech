<?php
include 'include/connect.php';

function obtenerNoticias() {
    try {
        $conexion = conectarBD();
        if ($conexion) {
            $query = "SELECT * FROM noticias WHERE fecha_borrar > CURDATE() OR fecha_borrar IS NULL";
            $stmt = $conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    } catch (PDOException $e) {
        error_log("Error al obtener noticias: " . $e->getMessage());
        return [];
    } finally {
        if ($conexion) {
            $conexion = null;
        }
    }
}

$noticias = obtenerNoticias();
?>
