<?php
require 'php/conexion.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Obtener el ID del autor desde la sesión
    if (isset($_SESSION['id_usuario'])) {
        $id_autor_producto = $_SESSION['id_usuario'];
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
            // Conexión a la base de datos
            $db = new conectDB();

            // Preparar los datos para la inserción
            $datos = "'$id_autor_producto', '$nombre', '$descripcion', '$precio', '$rutaImagen', 1"; // `1` como estatus de publicación
            $tabla = 'productos';

            // Insertar los datos en la base de datos
            if ($db->insertar($tabla, $datos)) {
                echo "<script>
                        alert('Producto agregado con éxito.');
                        window.location.href = 'paneladministrador.php'; 
                      </script>";
            } else {
                echo "<script>
                        alert('Error al guardar el producto en la base de datos.');
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
