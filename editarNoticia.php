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

// Incluir el archivo de conexión a la base de datos
include 'include/connect.php';

// Verificar si se ha proporcionado un ID de noticia para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    $conexion = conectarBD();

    if ($conexion) {
        try {
            // Preparar la consulta SQL para obtener los datos de la noticia con el ID proporcionado
            $query = "SELECT * FROM noticias WHERE id = :id";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            // Obtener los datos de la noticia
            $noticia = $statement->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontró la noticia
            if ($noticia) {
?>
                <!DOCTYPE html>
                <html lang="es">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Actualizar Noticias</title>
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
                        <h1 style="margin-top: 130px;">Actualizar Noticias</h1>
                        <form method="POST" action="editN.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">

                            <label for="nombre">Titulo (Maximo 150 caracteres):</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $noticia['nombre']; ?>" required>

                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" rows="4" required><?php echo $noticia['descipcion']; ?></textarea>

                            <label for="link">Link:</label>
                            <input type="url" id="link" name="link" value="<?php echo $noticia['link']; ?>" required>

                            <label for="fecha">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" value="<?php echo $noticia['fecha']; ?>" required>

                            <label for="fecha_borrado">Fecha de Borrado:</label>
                            <input type="date" id="fecha_borrado" name="fecha_borrado" value="<?php echo $noticia['fecha_borrar']; ?>" required>
                            <?php
                            // Suponiendo que $noticia['foto'] contiene algo como "uploads\nombre_de_archivo.jpg"
                            $foto = str_replace('\\', '/', $noticia['foto']);
                            $uploadsIndex = strpos($foto, 'uploads/');
                            $imagePath = htmlspecialchars(substr($foto, $uploadsIndex), ENT_QUOTES);
                            ?>

                            <label for="imagen">Imagen actual:</label>
                            <?php if (!empty($imagePath)) : ?>
                                <img src="<?php echo $imagePath; ?>" alt="Imagen actual" style="max-width: 50%; height: auto;">
                            <?php else : ?>
                                <p>No hay imagen disponible</p>
                            <?php endif; ?>

                            <label for="imagen">Subir imagen:</label>
                            <input type="file" id="imagen" name="imagen" accept="image/*">
                            <img id="preview" class="preview-image" src="#" alt="Vista previa de la imagen" style="display: none;">
                            <button type="submit">Actualizar</button>
                        </form>
                        <div class="cancel-button">
                            <a href="listaNoticias.php">
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
<?php
            } else {
                echo "No se encontró ninguna noticia con el ID proporcionado.";
            }
        } catch (PDOException $e) {
            echo "Error al intentar obtener la noticia: " . $e->getMessage();
        }
    } else {
        echo "Error: No se pudo conectar a la base de datos.";
    }
} else {
    echo "Error: No se proporcionó un ID de noticia para editar.";
}
?>