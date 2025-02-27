<?php
require_once "auth.php"; // Asegurar sesión iniciada
session_unset();  // Eliminar variables de sesión
session_destroy(); // Destruir la sesión
header("Location: login.php"); // Redirigir al login
exit();
?>
