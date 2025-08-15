<?php
require 'php/conexion.php';
session_start();

// Redirigir si no hay sesión activa
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

$db = new conectDB();

// Obtener noticias
$noticias = $db->buscar("noticias", "1"); // 1 equivale a 'true' en SQL para obtener todos los registros

// Obtener productos
$productos = $db->buscar("productos", "1");



$correo_usuario = $_SESSION['email']; // Correo del usuario actual
$db = new conectDB();

// Consultar los datos del usuario
try {
    $usuario = $db->buscar('usuarios', "correo = '$correo_usuario'");
    if (!$usuario || count($usuario) === 0) {
        throw new Exception("Usuario no encontrado.");
    }
    $nombre_usuario = isset($usuario[0]['nombre_usuario']) ? $usuario[0]['nombre_usuario'] : 'Usuario';

     // Almacenar el id y el nombre del usuario en la sesión
     $_SESSION['id_usuario'] = $usuario[0]['id_usuario']; 
     $_SESSION['nombre_usuario'] = $usuario[0]['nombre_usuario']; 

    $clave_usuario = $usuario[0]['id_usuario'];

    
  

} catch (Exception $e) {
    
    echo "Error al cargar los datos del usuario: " . htmlspecialchars($e->getMessage());
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administración</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

    .container {
      width: 90%;
      margin: auto;
    }

    h1 {
      position: relative;
      color: #ffffff;
      font-family: "Open Sans Condensed", Verdana, Arial, Helvetica, sans-serif;
      font-size-adjust: 0.5;
      font-weight: bold;
      font-style: normal;
      font-size: 22px;
      margin: 0 auto 40px;
      text-transform: uppercase;
      text-align: center;
    }

    
    
    .table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    .table th, .table td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      margin-top: 29px;
    }
    .table th {
      background-color: #333;
    }
    .table tr:hover {
      background-color: #444;
    }
    .actions {
      display: flex;
      gap: 10px;
    }
    .actions a {
      text-decoration: none;
      color: white;
      padding: 5px 10px;
      background-color: #00bfff;
      border-radius: 5px;
    }
    .actions a:hover {
      background-color: #008acb;
    }
    .btn-add {
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

.btn-add:hover {
  background-color: #008acb; /* Azul más oscuro */
}

/* Pseudo-elemento superior */
.btn-add::before {
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
.btn-add::after {
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
.btn-add:hover::before,
.btn-add:hover::after {
  transform: scaleX(1); /* Expande el pseudo-elemento completamente */
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


        table td img {
  width: 100px;
  height: auto;
  border-radius: 5px;
}

table td.actions a {
  display: inline-block;
  margin: 14px;
  padding: 8px 12px;
  background-color: #00bfff;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

table td.actions a:hover {
  background-color: #008acb;
}



  </style>
</head>
<body>
  <div class="container">

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
               
            <p>Bienvenido, <strong><?php echo htmlspecialchars($nombre_usuario); ?></strong></p>
                
                <a href="miperfil.php"> Mi Perfil</a>
                <a href="verusuarios.php"> Ver Usuarios</a>
                <a href="cerrar_sesion.php">Cerrar sesión</a>
                
            </nav>
            <label for="btn-menu" >X</label> 
        </div>
    </div>


    <h1>Panel de Administración</h1>

    <h2>Noticias</h2>
    <a href="crear_noticia.php" class="btn-add">Agregar Noticia</a>
    <table class="table">
      <thead>
        <tr>
          <th>Título</th>
          <th>Contenido</th>
          <th>Fecha</th>
          <th>Imagen de la Noticia</th>
          <th>Acciones </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($noticias as $noticia): ?>
          <tr>
            <td><?php echo $noticia['titulo']; ?></td>
            <td><?php echo $noticia['contenido']; ?></td>
            <td><?php echo $noticia['fecha_publicacion']; ?></td>
            <td>
            <img src="<?php echo $noticia['imagen_publicacion']; ?>" alt="Imagen de la noticia" style="width: 100px; height: auto;">
            </td>

            <td class="actions">
              <a href="editar_noticia.php?id=<?php echo $noticia['id_noticia']; ?>">Editar</a>
              <a href="eliminar_noticia.php?id=<?php echo $noticia['id_noticia']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta noticia?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2>Productos</h2>
    <a href="crear_producto.php" class="btn-add">Agregar Producto</a>
    <table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Imagen del Producto</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productos as $producto): ?>
          <tr>
            <td><?php echo $producto['nombre_producto']; ?></td>
            <td><?php echo $producto['descripcion']; ?></td>
            <td>$<?php echo number_format($producto['precio'], 2); ?></td>
            
            <td>
            <img src="<?php echo $producto['imagen_producto']; ?>" alt="Imagen del producto" style="width: 100px; height: auto;">
            </td>
            
            <td class="actions">
              <a href="editar_producto.php?id=<?php echo $producto['id_producto']; ?>">Editar</a>
              <a href="eliminar_producto.php?id=<?php echo $producto['id_producto']; ?>" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
