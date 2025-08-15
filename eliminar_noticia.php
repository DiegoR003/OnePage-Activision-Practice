<?php
require 'php/conexion.php';

session_start();

// Verificar si se recibió el ID de la noticia
if (!isset($_GET['id'])) {
    echo "<script>alert('ID de la noticia no proporcionado.'); window.history.back();</script>";
    exit;
}

$id_noticia = $_GET['id'];
$db = new conectDB();

// Intentar eliminar la noticia
if ($db->eliminar('noticias', "id_noticia = $id_noticia")) {
    echo "<script>
            alert('Noticia eliminada con éxito.');
            window.location.href = 'paneladministrador.php';
          </script>";
} else {
    echo "<script>
            alert('Error al eliminar la noticia.');
            window.history.back();
          </script>";
}
?>
