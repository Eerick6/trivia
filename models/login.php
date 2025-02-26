<?php
session_start();
require 'config.php'; // Archivo de conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password_hash);
            $stmt->fetch();

            // Verificar si la contraseña ingresada coincide con el hash almacenado
            if (password_verify($password, $password_hash)) { 
                $_SESSION['user_id'] = $id;
                echo json_encode(["status" => "success", "message" => "Login exitoso"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Correo no registrado"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Faltan datos"]);
    }
}
$conn->close();
?>
