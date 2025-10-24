<?php
  session_start();                 // Inicia la sesión  
  unset($_SESSION['usuario']);       // Elimina la variable de sesión 'email'
  session_destroy();               // Destruye la sesión actual
  header("Location: login.html");  // Redirige al usuario a la página de login.html
?>