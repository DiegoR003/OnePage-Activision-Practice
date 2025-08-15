<?php
require 'php/conexion.php';

session_start();

// Verificar si se proporcionó el ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID de usuario no proporcionado.');
            window.location.href = 'verusuarios.php';
          </script>";
    exit;
}

$id_usuario = intval($_GET['id']); // Asegúrate de que el ID sea un número

$db = new conectDB();

// Verificar si el usuario existe antes de eliminar
$usuario = $db->buscar('usuarios', "id_usuario = $id_usuario");
if (!$usuario || count($usuario) === 0) {
    echo "<script>
            alert('El usuario no existe.');
            window.location.href = 'verusuarios.php';
          </script>";
    exit;
}

// Intentar eliminar el usuario
if ($db->eliminar('usuarios', "id_usuario = $id_usuario")) {
    echo "<script>
            alert('Usuario eliminado correctamente.');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Error al eliminar el usuario.');
            window.history.back();
          </script>";
}
?>
