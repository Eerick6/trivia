<?php
require "config/db.php";

class LoginModel {
    public function authenticate($email, $username, $password) {
        global $conn;

        // Verificar si se proporciona email o username
        if (!empty($email)) {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $email);
        } else {
            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $username);
        }

        // Ejecutar la consulta y verificar errores
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();
        
        // Verificar si el usuario existe
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            // Si la contraseña es correcta, retornar los datos del usuario
            return $user;
        } else {
            // Si no es válido, retornar NULL
            return null;
        }
    }
}
?>
