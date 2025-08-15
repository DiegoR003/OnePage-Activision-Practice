<?php
require 'php/conexion.php';

session_start();

// Verificar que el formulario haya sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);
    

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($correo)) {
        echo "<script>
                alert('El nombre y el correo son obligatorios.');
                window.history.back();
              </script>";
        exit;
    }

    $campos = "nombre_usuario = '$nombre', correo = '$correo', contrasena = '$contrasena'";

    $db = new conectDB();

    // Actualizar los datos del usuario
    if ($db->actualizar('usuarios', $campos, "id_usuario = $id_usuario")) {
        echo "<script>
                alert('Usuario actualizado correctamente.');
                window.location.href = 'verusuarios.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar el usuario.');
                window.history.back();
              </script>";
    }
}
?>
