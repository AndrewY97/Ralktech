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
            //echo "No se pudo crear el directorio: " . realpath($directorio);
            return false;
        } else {
            //echo "Directorio creado: " . realpath($directorio) . "<br>";
        }
    } else {
        //echo "El directorio ya existe: " . realpath($directorio) . "<br>";
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
        //echo "El archivo es demasiado grande.<br>";
        $_SESSION['error'] = 'El archivo es demasiado grande.';
        return false;
    }
    if (!in_array(strtolower($extension), $extensiones_permitidas)) {
        //echo "Sólo se permiten archivos JPG, JPEG, PNG y GIF.<br>";
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
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $link = $_POST['link'];
    $fecha = $_POST['fecha'];
    $fecha_borrado = $_POST['fecha_borrado'];
    $ubicacion = $_POST['ubicacion'];

    if (isset($_FILES['imagen'])) {
        $ruta_imagen = subirImagen($_FILES['imagen']);

        if ($ruta_imagen) {
            try {
                $conexion = conectarBD();
                $consulta = $conexion->prepare("INSERT INTO noticias (nombre, descipcion, link, fecha, fecha_borrar, foto, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $consulta->execute([$nombre, $descripcion, $link, $fecha, $fecha_borrado, $ruta_imagen, 1]);
                $_SESSION['success'] = '¡Noticia publicada con éxito!';
                header("Location: dashboard.php");
                exit();
            } catch (PDOException $e) {
                // Eliminar la imagen si no se pudo crear la noticia
                if (isset($ruta_imagen) && file_exists($ruta_imagen)) {
                    unlink($ruta_imagen); // Eliminar la imagen
                }
                $_SESSION['error'] = 'Error al crear noticia: ' . $e->getMessage();
                header("Location: dashboard.php");
                exit();
            }
        } else {
            //echo "Error al subir la imagen.";
            $_SESSION['error'] = 'Error al subir la imagen.';
            header("Location: dashboard.php");
            exit();
        }
    } else {
        //echo "No se recibió ninguna imagen.<br>";
        $_SESSION['error'] = 'No se recibió ninguna imagen.';
        header("Location: dashboard.php");
        exit();
    }
}
