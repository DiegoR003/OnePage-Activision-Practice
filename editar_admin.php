<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: index.php'); 
    exit;
}

require 'php/conexion.php'; 

// Verificar si se proporcionó el ID del usuario a editar
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID de usuario no proporcionado.');
            window.location.href = 'verusuarios.php';
          </script>";
    exit;
}

$id_usuario_editar = $_GET['id']; // ID del usuario seleccionado en la tabla

$db = new conectDB();
$usuario = $db->buscar('usuarios', "id_usuario = '$id_usuario_editar'");

if ($usuario && count($usuario) > 0) {
    $nombre = htmlspecialchars($usuario[0]['nombre_usuario']);
    $correo = htmlspecialchars($usuario[0]['correo']);
    $contrasena = htmlspecialchars($usuario[0]['contrasena']);
    $estatus = $usuario[0]['estatus_activo'];
} else {
    echo "<script>
            alert('Usuario no encontrado.');
            window.location.href = 'verusuarios.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    
</head>

<style>
    
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
    color: #fff; 
}

.titulo{
    color: black;
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

/* Estilos del contenedor del formulario */
.contenedor-formulario {
    max-width: 500px;
    margin: 100px auto; 
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9); 
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
}

/* Estilo para las etiquetas de los campos */
.contenedor-formulario label {
    display: block;
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: bold;
    color: #333;
}

/* Estilo de los inputs de texto */
.contenedor-formulario input[type="text"],
.contenedor-formulario input[type="email"],
.contenedor-formulario input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Estilo del botón de actualizar */
.contenedor-formulario button {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50; /* Color verde */
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.contenedor-formulario button:hover {
    background-color: #45a049; 
}

/* Añadir un margen pequeño a los campos de entrada */
.contenedor-formulario input[type="text"],
.contenedor-formulario input[type="email"],
.contenedor-formulario input[type="password"] {
    margin-bottom: 15px;
}



</style>
<body>


<div class="capa"></div>


<div class="contenedor-formulario">
    <h2 class = "titulo" >Editar Perfil</h2><br>

   
    <?php if(isset($_SESSION['mensaje_error'])): ?>
        <div class="mensaje"><?php echo $_SESSION['mensaje_error']; unset($_SESSION['mensaje_error']); ?></div>
    <?php endif; ?>

    <form action="actualizar_perfil.php" method="POST">
        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_editar; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>" required>
        
       
        
        <button type="submit">Actualizar Usuario</button>
    </form>
</div>



</body>
</html>
