<?php

require 'php/conexion.php';


session_start();


$db = new conectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  
    $password = $_POST['password']; 


// Buscar usuario en la base de datos
$tabla = "usuarios";
$condicion = "correo = '$email' AND contrasena = '$password'";
$resultado = $db->buscar($tabla, $condicion);


if ($resultado && count($resultado) > 0) {
    $_SESSION['email'] = $email; // Almacenar el correo en la sesión
    header('Location: paneladministrador.php'); 
    exit; 
} else {
    // Redirige con un mensaje de error
    echo "<script>
            alert('El usuario no existe o el correo y contraseña ingresada no es correcto');
            window.history.back(); // Regresa al formulario de inicio de sesión
          </script>";
    exit; 
}


}
?>
