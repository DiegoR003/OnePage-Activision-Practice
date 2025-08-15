<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Noticia</title>
  <link rel="stylesheet" href="styles.css"> 
  <style>
    body {
      background-color: #151515;
      color: #fff;
      font-family: "Open Sans", Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .form-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.8);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    }

    .form-container h2 {
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
  </style>
</head>
<body>

<div class="form-container">
  <h2>Agregar Noticia</h2>
  <form action="procesar_noticia.php" method="POST" enctype="multipart/form-data">
    <label for="titulo">Título de la Noticia:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="contenido">Contenido:</label>
    <textarea id="contenido" name="contenido" rows="5" required></textarea>

    <label for="imagen">Subir Imagen:</label>
    <input type="file" id="imagen" name="imagen" accept="image/*" required>

    <button type="submit">Guardar Noticia</button>
  </form>
</div>

</body>
</html>
