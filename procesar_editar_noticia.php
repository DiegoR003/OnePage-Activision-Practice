<?php
require 'php/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_noticia = $_POST['id_noticia'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

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

    // Actualizar la noticia
    $campos = "titulo = '$titulo', contenido = '$contenido'";
    if ($rutaImagen) {
        $campos .= ", imagen_publicacion = '$rutaImagen'";
    }

    if ($db->actualizar('noticias', $campos, "id_noticia = $id_noticia")) {
        echo "<script>
                alert('Noticia actualizada con éxito.');
                window.location.href = 'paneladministrador.php';
              </script>";
    } else {
        echo "<script>
                alert('Error al actualizar la noticia.');
                window.history.back();
              </script>";
    }
}
?>
