<?php
require 'php/conexion.php';

session_start();

// Verificar si se recibió el ID del producto
if (!isset($_GET['id'])) {
    echo "<script>alert('ID del producto no proporcionado.'); window.history.back();</script>";
    exit;
}

$id_producto = $_GET['id'];
$db = new conectDB();

// Intentar eliminar el producto
if ($db->eliminar('productos', "id_producto = $id_producto")) {
    echo "<script>
            alert('Producto eliminado con éxito.');
            window.location.href = 'paneladministrador.php';
          </script>";
} else {
    echo "<script>
            alert('Error al eliminar el producto.');
            window.history.back();
          </script>";
}
?>
