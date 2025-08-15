<?php
require 'php/conexion.php';
session_start();

// Verificar si se recibió el ID del producto
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID de producto no proporcionado.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$id_producto = $_GET['id'];

$db = new conectDB();
$producto = $db->buscar('productos', "id_producto = '$id_producto'");

if (!$producto || count($producto) === 0) {
    echo "<script>
            alert('Producto no encontrado.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$producto = $producto[0]; // Obtener los datos del producto
$nombre_producto = htmlspecialchars($producto['nombre_producto']);
$descripcion = htmlspecialchars($producto['descripcion']);
$precio = htmlspecialchars($producto['precio']);
$imagen_producto = htmlspecialchars($producto['imagen_producto']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Productos</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: white;
        }

        /* Logo */
        .logo {
            margin-bottom: 30px;
            background-size: contain;
            margin-left: 80px;
        }

        .logo img {
            width: 184px;
            height: 44px;
            background-size: contain;
        }

        .detalle-contenedor {
            max-width: 900px;
            margin: 50px auto;
            margin-bottom: 200px;
            padding: 20px;
            background-color: #121212;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .detalle-imagen {
            display: block;
            margin: 0 auto;
            width: 400px;
            max-width: 100%;
            border-radius: 10px;
            margin-left: 10px;
        }

        .detalle-titulo {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0 10px;
        }

        .detalle-precio {
            font-size: 20px;
            color: #00ff00;
            margin-bottom: 20px;
        }

        .detalle-contenido {
            font-size: 16px;
            line-height: 1.8;
        }

        .volver {
            display: inline-block;
            position: relative;
            text-decoration: none;
            font-family: "Montserrat", Arial, sans-serif;
            font-weight: normal;
            font-style: normal;
            color: #fff;
            padding: 10px 20px;
            background-color: #0d161c;
            background-image: url("imagenes/global-nav-bg.png");
            background-size: 2px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 0px solid #fff;
            box-shadow: 0px 0px 30px -15px #ffffff inset;
            transition: all 0.4s ease-in-out;
            width: 190px;
            max-width: 315px;
            height: 20px;
            line-height: 20px;
            text-transform: uppercase;
            text-align: center;
        }

        .volver:hover {
            background-color: #008acb;
        }

        .volver::before,
        .volver::after {
            content: "";
            width: 100%;
            height: 2px;
            display: block;
            position: absolute;
            background-image: linear-gradient(to right, rgba(250, 250, 250, 0.5), #ffffff 20%, #ffffff 80%, rgba(250, 250, 250, 0.5));
            left: 0;
            transform: scaleX(0);
            transition: transform 0.8s ease;
            transform-origin: center;
        }

        .volver::before {
            top: 0;
        }

        .volver::after {
            bottom: 0;
        }

        .volver:hover::before,
        .volver:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <img src="imagenes/activision_logo_white-text.png" alt="Activision Logo">
    </div>

    <div class="detalle-contenedor">
        <img src="<?php echo $imagen_producto; ?>" alt="Imagen del Producto" class="detalle-imagen">
        <h1 class="detalle-titulo"><?php echo $nombre_producto; ?></h1>
        <p class="detalle-precio">Precio: $<?php echo $precio; ?></p>
        <p class="detalle-contenido"><?php echo nl2br($descripcion); ?></p>
        <a href="index.php" class="volver">Volver</a>
    </div>
</body>
</html>
