<?php
session_start(); 

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: index.php'); 
    exit;
}

require 'php/conexion.php'; 

$id_usuario = $_SESSION['id_usuario'];

$db = new conectDB();
$usuario = $db->buscar('usuarios', "id_usuario = '$id_usuario'");

if ($usuario && count($usuario) > 0) {
    $nombre = htmlspecialchars($usuario[0]['nombre_usuario']); // Obtener el nombre
    $correo = htmlspecialchars($usuario[0]['correo']); // Obtener el correo
} else {
    $nombre = "Nombre no encontrado";
    $correo = "Correo no encontrado";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <style>
        /* Fondo de la página */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat Alternates", sans-serif;
        }
        body {
            background-image: url("https://cdn.pixabay.com/photo/2023/05/28/09/21/south-tyrol-8023213_1280.jpg");
            background-attachment: fixed;
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
        }
        .capa {
            position: fixed;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
            top: 0;
            left: 0;
        }

        /* Contenedor de los datos del perfil de usuario */
        .miperfil-contenedor {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            padding: 20px;
            text-align: center;
            margin: 100px auto;
        }
        .miperfil-contenedor img {
            width: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .contenedor-boton {
            width: 350px;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px auto; 
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .contenedor-boton button, .contenedor-boton a {
            flex: 1;
            padding: 10px;
            margin-bottom: 40px;
            border: none;
            border-radius: 5px;
            text-align: center;
            color: #fff;
            background-color: #008acb;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contenedor-boton button:hover, .contenedor-boton a:hover {
            background-color: #45a049; 
            transform: scale(1.05); 
        }
    </style>
</head>
<body>

<div class="capa"></div>
<section>
    <div class="miperfil-contenedor">
        <h1>Datos del Perfil</h1>
        <img src="imagenes/mifoto.png" alt="Foto de perfil">
        <p><strong>Nombre:</strong> <?php echo $nombre; ?></p><br>
        <p><strong>Correo:</strong> <?php echo $correo; ?></p>
    </div>



    <div class="contenedor-boton">
        <!-- Botón para regresar al panel principal -->
        <a href="paneladministrador.php">Regresar al Panel de Administrador</a>
    </div>
</section>

<script>
    // Función para mostrar la alerta de confirmación
    function confirmarEliminacion() {
        return confirm("¿Estás seguro de que deseas eliminar tu perfil?");
    }
</script>
</body>
</html>
