<?php

// models/RegisterModel.php

require_once 'config/db.php';

class RegisterModel {

    // Método para registrar un nuevo usuario
    public function register($email, $password, $username) {
        global $conn;

        // Validar el formato del correo
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['status' => 'error', 'message' => 'Correo inválido'];
        }

        // Validar si el username ya está registrado
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        if (!$stmt) {
            return ['status' => 'error', 'message' => 'Error al preparar la consulta para verificar el username: ' . $conn->error];
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return ['status' => 'error', 'message' => 'Username ya registrado'];
        }

        // Verificar si el correo ya está registrado
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        if (!$stmt) {
            return ['status' => 'error', 'message' => 'Error al preparar la consulta para verificar el correo: ' . $conn->error];
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return ['status' => 'error', 'message' => 'Correo ya registrado'];
        }

        // Hashear la contraseña
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar el usuario
        $stmt = $conn->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
        if (!$stmt) {
            return ['status' => 'error', 'message' => 'Error al preparar la consulta para insertar el usuario: ' . $conn->error];
        }
        $stmt->bind_param("sss", $email, $passwordHash, $username);

        // Ejecutar la consulta y verificar si tuvo éxito
        if ($stmt->execute()) {
            return ['status' => 'success', 'message' => 'Usuario registrado con éxito'];
        } else {
            return ['status' => 'error', 'message' => 'Error al registrar el usuario: ' . $stmt->error];
        }
    }
}

?>
