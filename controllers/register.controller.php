<?php
// controllers/register.controller.php

require_once 'models/register.php';

class RegisterController {
    public function registerUser() {
        // Obtener los datos enviados en el cuerpo de la solicitud
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        // Verificar si los campos necesarios están presentes
        if (empty($data['email']) || empty($data['password']) || empty($data['username'])) {
            echo json_encode(["status" => "error", "message" => "Faltan campos obligatorios"]);
            return;
        }

        $email = $data['email'];
        $password = $data['password'];
        $username = $data['username'];  // Obtenemos el username

        // Crear una instancia del modelo de registro
        $registerModel = new RegisterModel();

        // Intentar registrar al usuario
        $response = $registerModel->register($email, $password, $username);  // Pasamos el username al modelo

        // Enviar la respuesta en formato JSON
        echo json_encode($response);
    }
}
?>

