<?php
require 'php/conexion.php';

// Obtener los usuarios
$db = new conectDB();
$usuarios = $db->buscar('usuarios', '1 ORDER BY id_usuario ASC');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Usuarios</title>
    <style>
        body {
          background-color: #151515; /* Fondo negro */
          background-image: url('imagenes/atvi-hero.jpg'); /* Imagen de fondo */
          background-repeat: no-repeat; /* Evitar repetir la imagen */
          background-size: auto 450px; /* Cubrir todo el fondo */
          background-position: center 55px; /* Centrar la imagen */
          background-attachment: initial;
          color: #fff; /* Texto blanco */
          font-family: "Open Sans", Arial, sans-serif;
          margin: 0;
          padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 100px;
            background-color: #222;
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


        th, td {
            border: 1px solid #444;
            padding: 10px;
            text-align: left;
            color: #fff;
        }

        th {
            background-color: #333;
        }

        h1{
            margin-top: 70px;
            text-align: center;
        }

        .actions a {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #008acb;
            border-radius: 5px;
            margin-right: 5px;
        }

        .actions a:hover {
            background-color: #005f8a;
        }

        .actions .delete {
            background-color: #d9534f;
        }

        .actions .delete:hover {
            background-color: #c9302c;
        }


         /* Menú lateral */
         #btn-menu {
            display: none;
            
        }
        .menu-icon{
            font-size: 40px; /* Tamaño grande del ícono */
            margin-right: 200px; /* Desplaza el ícono hacia la derecha */
            cursor: pointer; /* Cambia el cursor al pasar sobre el ícono */
            color: white; /* Puedes ajustar el color del ícono */
            transition: all 0.3s ease; /* Suaviza las transiciones de efectos */
        }
        .menu-icon:hover {
            color: #c7c7c7; /* Cambia el color del ícono al pasar el mouse */
        }

        /* Estilo para el botón de cierre X */
        .close-btn {
            position: relative;
            right: 20px;
            top: 20px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            color: #c7c7c7; /* Cambio de color al pasar el mouse */
        }
    



        
        .container-menu {
            position: fixed;
            background: rgba(0, 0, 0, 0.70); /* Fondo más opaco */
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            transition: all 500ms ease;
            opacity: 0;
            visibility: hidden;
            z-index: 1000; /* Coloca el menú en un nivel más alto */
        }
        #btn-menu:checked ~ .container-menu {
            opacity: 1;
            visibility: visible;
            
        }
        .cont-menu {
            width: 100%;
            max-width: 250px;
            background: #1c1c1c;
            height: 100vh;
            position: relative;
            transition: all 500ms ease;
            transform: translateX(-100%);
        }
        #btn-menu:checked ~ .container-menu .cont-menu {
            transform: translateX(0%);
            
        }
        .cont-menu nav {
            transform: translateY(15%);
            
        }
        .cont-menu nav a {
            display: block;
            text-decoration: none;
            padding: 20px;
            color: #c7c7c7;
            border-left: 5px solid transparent;
            transition: all 400ms ease;
            
        }
        .cont-menu nav a:hover {
            border-left: 5px solid #c7c7c7;
            background: #1f1f1f;
        }
        .cont-menu label {
            position: absolute;
            right: 5px;
            top: 10px;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
            
        }

        
        /* Fin de Menú lateral */

        
    </style>
</head>
<body>

 <!-- Logo -->
 <div class="logo">
    <img src="imagenes/activision_logo_white-text.png"  alt="Activision Logo">
  </div>

   <!-- Barra lateral -->

  <input type="checkbox" id="btn-menu" >
    <label for="btn-menu" class="menu-icon">☰</label>
    <div class="container-menu">
        <div class="cont-menu"> 
          
            <nav>
                <a href="paneladministrador.php">Volver</a>
                
            </nav>
            <label for="btn-menu" >X</label> 
        </div>
    </div>


<h1>Gestión de Usuarios</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
           
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($usuarios): ?>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['id_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                
                    <td><?php echo htmlspecialchars($usuario['estatus_activo'] ? 'Activo' : 'Inactivo'); ?></td>
                    <td class="actions">
                        <a href="editar_admin.php?id=<?php echo $usuario['id_usuario']; ?>">Editar</a>
                        <a href="eliminar_admin.php?id=<?php echo $usuario['id_usuario']; ?>" class="delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay usuarios registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
