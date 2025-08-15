<?php
require 'php/conexion.php';

session_start();

// Verificar si se recibió el ID de la noticia
if (!isset($_GET['id'])) {
    echo "<script>alert('ID de noticia no proporcionado.'); window.history.back();</script>";
    exit;
}

$id_noticia = $_GET['id'];
$db = new conectDB();

// Buscar los datos de la noticia por ID
$noticia = $db->buscar('noticias', "id_noticia = $id_noticia");
if (!$noticia || count($noticia) === 0) {
    echo "<script>alert('Noticia no encontrada.'); window.history.back();</script>";
    exit;
}

// Obtener la noticia
$noticia = $noticia[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Noticia</title>
  <style>
    body {
      background-color: #151515;
      color: #fff;
      font-family: "Open Sans", Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      max-width: 1200px;
      margin: 50px auto;
      padding: 20px;
    }

    .form-container, .preview-container {
      background-color: rgba(0, 0, 0, 0.8);
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    }

    .form-container {
      width: 58%;
      margin-bottom: 300px;
    }

    .preview-container {
      width: 38%; /* Más pequeño */
      margin-left: 20px; /* Separación adicional */
      margin-bottom: 50px;
    }

    .form-container h2, .preview-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-container input, .form-container textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: none;
      border-radius: 5px;
      background-color: #333;
      color: #fff;
      font-size: 14px;
    }

    .form-container input[type="file"] {
      background-color: transparent;
    }

    .form-container button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #008acb;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form-container button:hover {
      background-color: #005f8a;
    }

    .preview-container img {
      width: 100%;
      height: 200px; /* Ajuste de altura */
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .preview-container .blog-timestamp,
    .preview-container .blog-headline,
    .preview-container .blog-copy {
      margin: 10px 0;
    }

    .preview-container .blog-timestamp {
      color: gray;
      font-size: 16px;
    }

    .preview-container .blog-headline {
      font-size: 18px;
      font-weight: bold;
    }

    .blog-more-wrapper a {
      color: #008acb;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- Formulario de edición -->
  <div class="form-container">
    <h2>Editar Noticia</h2>
    <form action="procesar_editar_noticia.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_noticia" value="<?php echo htmlspecialchars($noticia['id_noticia']); ?>">

      <label for="titulo">Título de la Noticia:</label>
      <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>

      <label for="contenido">Contenido:</label>
      <textarea id="contenido" name="contenido" rows="5" required><?php echo htmlspecialchars($noticia['contenido']); ?></textarea>

      <label for="imagen">Cambiar Imagen (opcional):</label>
      <input type="file" id="imagen" name="imagen" accept="image/*">

      <button type="submit">Guardar Cambios</button>
    </form>
  </div>

  <!-- Vista previa de la noticia -->
  <div class="preview-container">
    <h2>Vista Previa</h2>
    <img src="<?php echo htmlspecialchars($noticia['imagen_publicacion']); ?>" alt="Imagen de la noticia">
    <div class="blog-timestamp"><?php echo date("M d, Y", strtotime($noticia['fecha_publicacion'])); ?></div>
    <div class="blog-headline"><?php echo htmlspecialchars($noticia['titulo']); ?></div>
    <div class="blog-copy"><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></div>
    <div class="blog-more-wrapper">
      <a href="#">LEER MÁS</a>
    </div>
  </div>
</div>

</body>
</html>
