<?php
require 'php/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $db = new conectDB();

    // Manejo de la imagen
    $rutaImagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'imagenes/';
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaImagen = $directorio . $nombreImagen;

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            echo "<script>alert('Error al subir la imagen.'); window.history.back();</script>";
            exit;
        }
    }

    // Actualizar el producto
    $campos = "nombre_producto = '$nombre', descripcion = '$descripcion', precio = $precio";
    if ($rutaImagen) {
        $campos .= ", imagen_producto = '$rutaImagen'";
    }

    if ($db->actualizar('productos', $campos, "id_producto = $id_producto")) {
        echo "<script>
                alert('Producto actualizado con éxito.');
                window.location.href = 'paneladministrador.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar el producto.');
                window.history.back();
              </script>";
    }
}
?>
