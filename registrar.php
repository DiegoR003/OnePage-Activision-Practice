<?php
require 'php/conexion.php';

session_start(); // Iniciar sesión si aún no lo has hecho

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre_usuario = trim($_POST['usuario']);
    $correo = trim($_POST['email']);
    $contrasena = trim($_POST['password']);

    // Validar que los campos no estén vacíos
    if (empty($nombre_usuario) || empty($correo) || empty($contrasena)) {
        echo "<script>
                alert('Todos los campos son obligatorios.');
                window.history.back();
              </script>";
        exit;
    }

    $db = new conectDB();

    // Preparamos los datos para insertar
    $datos = "'$nombre_usuario', '$correo', '$contrasena', 1"; 
    $tabla = "usuarios";

    // Intentar insertar los datos
    if ($db->insertar($tabla, $datos)) {
        // Guardar el usuario en la sesión para redirigir correctamente
        $_SESSION['email'] = $correo;
        $_SESSION['nombre_usuario'] = $nombre_usuario;

        header('Location: paneladministrador.php');
        exit;
    } else {
        echo "<script>
                alert('Error al registrar el usuario.');
                window.history.back();
              </script>";
    }
}
?>
