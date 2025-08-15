<?php
session_start();
if (isset($_SESSION['mensaje_error'])) {
    echo '<div class="mensaje">' . $_SESSION['mensaje_error'] . '</div>';
    unset($_SESSION['mensaje_error']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrador</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Íconos si son necesarios -->
  <style>

    /* Estilos generales */
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

    /* Contenedor del formulario */
    .login-container {
        background-color: rgba(26, 26, 26, 0.0); /* Fondo gris oscuro */
  width: 400px; /* Ancho fijo */
  margin: 30px auto; /* Centrar el formulario */
  padding: 20px 0px; /* Espaciado interno */
  border-radius: 0px; /* Bordes redondeados */
  text-align: center; /* Centrar el contenido */
    }

    .login-container h2 {
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

    /* Campos de entrada */
.login-container input[type="email"],
.login-container input[type="password"] {
    background-color: #d8d8d8 !important;
    display: inline-block;
    width: 100%;
    border: none;
    border-radius: 3px;
    font-size: 15px;
    line-height: 19px;
    color: #000;
    margin: 0;
    padding: 9px 13px;
    box-sizing: border-box;
}

    /* Botón de inicio de sesión */
    .login-container button {
        
     font-family: "Montserrat", Arial, sans-serif;
    font-weight: normal;
    font-style: normal;
    color: #fff;
    background-color: #0d161c;
    background-image: url("imagenes/global-nav-bg.png");
    background-size: 2px;
    border: 0px solid #fff;
    box-shadow: 0px 0px 30px -15px #ffffff inset;
    transition: all 0.4s ease-in-out;
    float: none;
    display: block;
    position: relative;
    margin: 0 auto;
    width: 100%;
    max-width: 315px;
    height: 40px;
    line-height: 20px;
    text-transform: uppercase;
    padding: 10px 0;
    margin-top: 50px;
    }

    .login-container button:hover {
      background-color: #008acb; /* Azul más oscuro */
    }


    /* Enlace de recuperación de contraseña */
    .login-container a {
display: block;
  margin-top: 10px;
  color: #00bfff; /* Azul claro */
  font-size: 14px;
  text-decoration: none;
  transition: color 0.3s;
    }

    .login-container a:hover {
      color: #008acb; /* Azul más oscuro */
    }

    .main-logo{
    background-image: url("https://www.callofduty.com/content/dam/atvi/callofduty/sso/atvi-logo.png");
    background-repeat: no-repeat;
    background-position: center top;
    background-size: contain;
    overflow: hidden;
    text-indent: -200%;
    color: transparent;
    display: block;
    height: 80px;
    margin: 60px 0;

    }

    .datos-login{
    display: block;
    position: relative;
    width: 100%;
    height: 25px;
    font-size: 14px;
    line-height: 18px;
    font-weight: normal;
    text-transform: none;
    padding: 5px 0;
    color: #fff;
    z-index: 1;
    text-align: left;
    }

 
 /* Pseudo-elemento superior */
.login-container button::before {
  content: "";
  width: 100%;
  height: 2px;
  display: block;
  position: absolute;
  background-image: linear-gradient(to right, rgba(250, 250, 250, 0.5), #ffffff 20%, #ffffff 80%, rgba(250, 250, 250, 0.5));
  top: -1px; /* Posición superior */
  left: 0;
  transform: scaleX(0); /* Inicialmente colapsado */
  transition: transform 0.8s ease; /* Transición suave */
  transform-origin: center; /* Expande desde el centro */
}

/* Pseudo-elemento inferior */
.login-container button::after {
  content: "";
  width: 100%;
  height: 2px;
  display: block;
  position: absolute;
  background-image: linear-gradient(to right, rgba(250, 250, 250, 0.5), #ffffff 20%, #ffffff 80%, rgba(250, 250, 250, 0.5));
  bottom: -1px; /* Posición inferior */
  left: 0;
  transform: scaleX(0); /* Inicialmente colapsado */
  transition: transform 0.8s ease; /* Transición suave */
  transform-origin: center; /* Expande desde el centro */
}

/* Animaciones al pasar el mouse */
.login-container button:hover::before,
.login-container button:hover::after {
  transform: scaleX(1); /* Expande el pseudo-elemento completamente */
}

.register-link a{
    color: #D6E212;
    text-decoration: underline;
}

  </style>
</head>
<body>
  <!-- Logo -->
  <div class="logo">
    <img src="imagenes/activision_logo_white-text.png"  alt="Activision Logo">
  </div>


    <!-- Logo Encabezado-->
  <h1 class="header-logo"><span class="main-logo" role="img" aria-label="Activision">Activision</span></h1>

  <!-- Contenedor del formulario -->
  <div class="login-container">
    <h2>INICIA SESIÓN EN TU CUENTA</h2>
    <form action="validaradmin.php" method="POST">
      <label class= "datos-login" for="email">Dirección de correo electrónico: *</label>
      <input type="email" id="email" name="email"  required>
      
      <label  class= "datos-login" for="password">Contraseña: *</label>
      <input type="password" id="password" name="password"  required>
      
     

      <!-- Botón de inicio de sesión -->
      <button type="submit">INICIAR SESIÓN</button>
    </form>

    

    <div class="register-link">
                <p>¿No tienes una cuenta ? <a  href="registro.php" target="target">Registrate</a></p>
            </div>
    

  
</body>
</html>
