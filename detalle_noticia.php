<?php
require 'php/conexion.php';
session_start();

// Verificar si se ha recibido el ID de la noticia
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID de noticia no proporcionado.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$id_noticia = $_GET['id'];

$db = new conectDB();
$noticia = $db->buscar('noticias', "id_noticia = '$id_noticia'");

if (!$noticia || count($noticia) === 0) {
    echo "<script>
            alert('Noticia no encontrada.');
            window.location.href = 'index.php';
          </script>";
    exit;
}

$noticia = $noticia[0]; // Obtener la noticia
$titulo = htmlspecialchars($noticia['titulo']);
$contenido = htmlspecialchars($noticia['contenido']);
$imagen_publicacion = htmlspecialchars($noticia['imagen_publicacion']);
$fecha_publicacion = date("M d, Y", strtotime($noticia['fecha_publicacion']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Noticias</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: white;
        }

          /* Logo */
     .logo {
      margin-bottom: 30px;
      background-size: contain;
      margin-left: 80px;
     
      
    }

    .logo img {
      width: 184px; /* Tamaño del logo */
      height: 44px;
      background-size: contain;
      
    }
        .detalle-contenedor {
            max-width: 900px;
            margin: 50px auto;
            margin-bottom: 200px;
           
            padding: 20px;
            background-color: #121212;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .detalle-imagen {
            display: block; /* Esto permite usar margen automático */
            margin: 0 auto; /* Centra la imagen horizontalmente */
            width: 400px;
            border-radius: 10px;
            margin-left: 10px;
            
        }
        .detalle-titulo {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0 10px;
        }
        .detalle-fecha {
            font-size: 14px;
            color: gray;
            margin-bottom: 20px;
        }
        .detalle-contenido {
            font-size: 16px;
            line-height: 1.8;
        }
       

        .volver {
  display: inline-block;
  position: relative; /* Necesario para los pseudo-elementos */
  text-decoration: none;
  font-family: "Montserrat", Arial, sans-serif;
  font-weight: normal;
  font-style: normal;
  color: #fff;
  padding: 10px 20px;
  background-color: #0d161c;
  background-image: url("imagenes/global-nav-bg.png");
  background-size: 2px;
  border-radius: 5px;
  margin-bottom: 20px;
  border: 0px solid #fff;
  box-shadow: 0px 0px 30px -15px #ffffff inset;
  transition: all 0.4s ease-in-out;
  width: 190px;
  max-width: 315px;
  height: 20px;
  line-height: 20px;
  text-transform: uppercase;
  text-align: center; /* Centra el texto */
}

.volver:hover {
  background-color: #008acb; /* Azul más oscuro */
}

/* Pseudo-elemento superior */
.volver::before {
  content: "";
  width: 100%;
  height: 2px;
  display: block;
  position: absolute;
  background-image: linear-gradient(
    to right,
    rgba(250, 250, 250, 0.5),
    #ffffff 20%,
    #ffffff 80%,
    rgba(250, 250, 250, 0.5)
  );
  top: 0; /* Posición superior */
  left: 0;
  transform: scaleX(0); /* Inicialmente colapsado */
  transition: transform 0.8s ease; /* Transición suave */
  transform-origin: center; /* Expande desde el centro */
}

/* Pseudo-elemento inferior */
.volver::after {
  content: "";
  width: 100%;
  height: 2px;
  display: block;
  position: absolute;
  background-image: linear-gradient(
    to right,
    rgba(250, 250, 250, 0.5),
    #ffffff 20%,
    #ffffff 80%,
    rgba(250, 250, 250, 0.5)
  );
  bottom: 0; /* Posición inferior */
  left: 0;
  transform: scaleX(0); /* Inicialmente colapsado */
  transition: transform 0.8s ease; /* Transición suave */
  transform-origin: center; /* Expande desde el centro */
}

/* Animaciones al pasar el mouse */
.volver:hover::before,
.volver:hover::after {
  transform: scaleX(1); /* Expande el pseudo-elemento completamente */
}

    </style>
</head>
<body>
    
      <!-- Logo -->
  <div class="logo">
    <img src="imagenes/activision_logo_white-text.png"  alt="Activision Logo">
  </div>



    <div class="detalle-contenedor">
        <img src="<?php echo $imagen_publicacion; ?>" alt="Imagen de Noticia" class="detalle-imagen">
        <h1 class="detalle-titulo"><?php echo $titulo; ?></h1>
        <p class="detalle-fecha"><?php echo $fecha_publicacion; ?></p>
        <p class="detalle-contenido"><?php echo nl2br($contenido); ?></p>
        <a href="index.php" class="volver">Volver</a>
    </div>
</body>
</html>
