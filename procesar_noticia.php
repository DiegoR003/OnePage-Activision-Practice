<?php
require 'php/conexion.php';

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    // Obtener el ID del autor desde la sesión
    if (isset($_SESSION['id_usuario'])) {
        $id_autor_noticia = $_SESSION['id_usuario'];
    } else {
        echo "<script>
                alert('Error: Usuario no autenticado.');
                window.location.href = 'index.php'; 
              </script>";
        exit;
    }

    // Manejo de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'imagenes/'; // Carpeta donde se guardarán las imágenes
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaImagen = $directorio . $nombreImagen;

        // Mover la imagen al directorio
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            // Obtener la fecha actual en formato estándar (YYYY-MM-DD HH:MM:SS)
            $fecha_actual = date("Y-m-d H:i:s");

            // Conexión a la base de datos
            $db = new conectDB();

            // Preparar los datos para la inserción
            $datos = "'$titulo', '$id_autor_noticia', '$contenido', '$rutaImagen', '$fecha_actual'";
            $tabla = 'noticias';

            // Insertar los datos en la base de datos
            if ($db->insertar($tabla, $datos)) {
                echo "<script>
                        alert('Noticia agregada con éxito.');
                        window.location.href = 'paneladministrador.php'; 
                      </script>";
            } else {
                echo "<script>
                        alert('Error al guardar la noticia en la base de datos.');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error al subir la imagen.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error: No se recibió una imagen válida.');
                window.history.back();
              </script>";
    }
}
?>
