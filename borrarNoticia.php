<?php
// Incluir el archivo de conexión a la base de datos
include 'include/connect.php';

// Verificar si se ha proporcionado un ID de noticia para borrar
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Conectar a la base de datos
    $conexion = conectarBD();

    if ($conexion) {
        try {
            // Preparar la consulta SQL para eliminar la noticia con el ID proporcionado
            $query = "DELETE FROM noticias WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            // Comprobar si se eliminó la noticia correctamente
            if ($statement->rowCount() > 0) {
                echo "Noticia eliminada correctamente.";
            } else {
                echo "No se encontró ninguna noticia con el ID proporcionado.";
            }
        } catch (PDOException $e) {
            echo "Error al intentar borrar la noticia: " . $e->getMessage();
        }
    } else {
        echo "Error: No se pudo conectar a la base de datos.";
    }
} else {
    echo "Error: No se proporcionó un ID de noticia para borrar.";
}
