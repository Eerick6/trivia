<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trivi";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer la codificación a UTF-8
$conn->set_charset("utf8");
?>
