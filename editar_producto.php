<?php
require 'php/conexion.php';

session_start();

// Verificar si se recibió el ID del producto
if (!isset($_GET['id'])) {
    echo "<script>alert('ID de producto no proporcionado.'); window.history.back();</script>";
    exit;
}

$id_producto = $_GET['id'];
$db = new conectDB();

// Buscar los datos del producto por ID
$producto = $db->buscar('productos', "id_producto = $id_producto");
if (!$producto || count($producto) === 0) {
    echo "<script>alert('Producto no encontrado.'); window.history.back();</script>";
    exit;
}

// Obtener el producto
$producto = $producto[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Producto</title>
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
    }

    .preview-container {
      width: 38%; /* Más pequeño */
      margin-left: 20px; /* Separación adicional */
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
      max-height: 300px; /* Reducir altura */
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .preview-container .product-price,
    .preview-container .product-name,
    .preview-container .product-description {
      margin: 10px 0;
    }

    .preview-container .product-price {
      color: gray;
      font-size: 16px;
    }

    .preview-container .product-name {
      font-size: 18px;
      font-weight: bold;
    }

    .product-more-wrapper a {
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
    <h2>Editar Producto</h2>
    <form action="procesar_editar_producto.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">

      <label for="nombre">Nombre del Producto:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" required>

      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="5" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>

      <label for="imagen">Cambiar Imagen (opcional):</label>
      <input type="file" id="imagen" name="imagen" accept="image/*">

      <button type="submit">Guardar Cambios</button>
    </form>
  </div>

  <!-- Vista previa del producto -->
  <div class="preview-container">
    <h2>Vista Previa</h2>
    <img src="<?php echo htmlspecialchars($producto['imagen_producto']); ?>" alt="Imagen del producto">
    <div class="product-price">$<?php echo number_format($producto['precio'], 2); ?></div>
    <div class="product-name"><?php echo htmlspecialchars($producto['nombre_producto']); ?></div>
    <div class="product-description"><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></div>
  </div>
</div>

</body>
</html>
