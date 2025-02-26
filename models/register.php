<?php
require 'config.php'; // Archivo de conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Hashear la contraseña antes de guardarla
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar usuario en la BD
        $stmt = $conn->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password_hash);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Usuario registrado correctamente"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar usuario"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan datos"]);
    }
}
$conn->close();
?>
