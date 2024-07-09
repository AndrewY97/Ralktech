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
require_once 'include/connect.php';

function verificarOCrearDirectorio($directorio)
{
    if (!is_dir($directorio)) {
        if (!mkdir($directorio, 0755, true)) {
            return false;
        }
    }
    return true;
}

function subirImagen($imagen)
{
    $directorio_destino = 'uploads/';

    if (!verificarOCrearDirectorio($directorio_destino)) {
        return false;
    }

    $directorio_destino_real = realpath($directorio_destino) . DIRECTORY_SEPARATOR;

    if ($imagen['error'] !== UPLOAD_ERR_OK) {
        echo "Error al cargar el archivo. Código de error: " . $imagen['error'] . "<br>";
        return false;
    }

    $nombre_archivo = basename($imagen['name']);
    $tipo_archivo = $imagen['type'];
    $tamaño_archivo = $imagen['size'];
    $nombre_temporal = $imagen['tmp_name'];
    $extensiones_permitidas = array('jpg', 'jpeg', 'png', 'gif');
    $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
    if ($tamaño_archivo > 5000000) {
        $_SESSION['error'] = 'El archivo es demasiado grande.';
        return false;
    }
    if (!in_array(strtolower($extension), $extensiones_permitidas)) {
        $_SESSION['error'] = 'Sólo se permiten archivos JPG, JPEG, PNG y GIF.';
        return false;
    }
    $nombre_archivo = uniqid() . '.' . $extension;
    $ruta_archivo = $directorio_destino_real . $nombre_archivo;
    if (move_uploaded_file($nombre_temporal, $ruta_archivo)) {
        return $ruta_archivo;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $link = $_POST['link'];
    $fecha = $_POST['fecha'];
    $fecha_borrado = $_POST['fecha_borrado'];

    try {
        $conexion = conectarBD();

        // Obtener la noticia actual
        $consulta_actual = $conexion->prepare("SELECT * FROM noticias WHERE id = ?");
        $consulta_actual->execute([$id]);
        $noticia_actual = $consulta_actual->fetch(PDO::FETCH_ASSOC);

        if (!$noticia_actual) {
            $_SESSION['error'] = 'No se encontró la noticia.';
            header("Location: dashboard.php");
            exit();
        }

        $ruta_imagen = $noticia_actual['foto'];

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nueva_ruta_imagen = subirImagen($_FILES['imagen']);

            if ($nueva_ruta_imagen) {
                // Eliminar la imagen anterior
                if (file_exists($ruta_imagen)) {
                    unlink($ruta_imagen);
                }
                $ruta_imagen = $nueva_ruta_imagen;
            } else {
                $_SESSION['error'] = 'Error al subir la nueva imagen.';
                header("Location: dashboard.php");
                exit();
            }
        }

        // Actualizar la noticia en la base de datos
        $consulta = $conexion->prepare("UPDATE noticias SET nombre = ?, descipcion = ?, link = ?, fecha = ?, fecha_borrar = ?, foto = ? WHERE id = ?");
        $consulta->execute([$nombre, $descripcion, $link, $fecha, $fecha_borrado, $ruta_imagen, $id]);

        $_SESSION['success'] = '¡Noticia actualizada con éxito!';
        header("Location: dashboard.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al actualizar la noticia: ' . $e->getMessage();
        header("Location: dashboard.php");
        exit();
    }
}
