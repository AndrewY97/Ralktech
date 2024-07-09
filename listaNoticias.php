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
include 'include/connect.php';
function obtenerNoticias()
{
    $conexion = conectarBD();

    if ($conexion) {
        try {
            $query = "SELECT * FROM noticias";
            $statement = $conexion->prepare($query);
            $statement->execute();
            $noticias = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $noticias;
        } catch (PDOException $e) {
            echo "Error al obtener noticias: " . $e->getMessage();
            return null;
        }
    } else {
        echo "Error: No se pudo conectar a la base de datos.";
        return null;
    }
}

$noticias = obtenerNoticias();
header("X-Frame-Options: DENY");
header("Content-Security-Policy: frame-ancestors 'self'");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Noticias</title>
    <link rel="icon" href="img/RALKTECH_FavIcon.svg" type="image/jpg">
    <link rel="shortcut icon" href="img/RALKTECH_FavIcon.svg" type="image/jpg">
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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #ffffff;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: rgba(0, 71, 166, 1);
            /* Azul */
            color: white;
            width: 15%;
        }

        th:nth-child(2) {
            width: 25%;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card h2 {
            color: #2c3e50;
        }

        button {
            padding: 10px;
            background-color: transparent;
            color: #2c3e50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
            font-size: 1.2em;
        }

        button:hover {
            background-color: #f2f2f2;
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        button:active {
            background-color: #e0e0e0;
        }

        .cancel-button {
            display: block;
            text-align: start;
            margin-top: 20px;
        }

        .cancel-button button {
            background-color: rgb(252, 37, 0);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .cancel-button button:hover {
            background-color: rgb(252, 37, 0);
        }

        .cancel-button button:active {
            background-color: rgb(252, 37, 0);
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Lista de Noticias</h1>
        </header>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Fecha de Borrar</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($noticias as $noticia) : ?>
                <tr>
                    <td><?php echo $noticia['nombre']; ?></td>
                    <td><?php echo substr($noticia['descipcion'], 0, 50) . "..."; ?></td>
                    <td><?php echo $noticia['fecha']; ?></td>
                    <td><?php echo $noticia['fecha_borrar']; ?></td>
                    <td>
                        <button onclick="editar(<?php echo $noticia['id']; ?>)">&#9998;</button>
                        <button onclick="borrar(<?php echo $noticia['id']; ?>)">&#128465;</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="cancel-button">
            <a href="dashboard.php">
                <button>Cancelar</button>
            </a>
        </div>
    </div>
    <script>
        function borrar(id) {
            if (confirm('¿Estás seguro de que deseas borrar esta noticia?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'borrarNoticia.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        window.location.reload();
                    }
                };
                xhr.send('id=' + id);
            }
        }
    </script>
    <script>
        function editar(id) {
            window.location.href = 'editarNoticia.php?id=' + id;
        }
    </script>
</body>

</html>