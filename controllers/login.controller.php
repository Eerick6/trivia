<?php
session_start();

require "models/login.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si es una solicitud JSON, obtener los datos de esta manera
    $input = json_decode(file_get_contents('php://input'), true);

    $email = $input['email'] ?? '';
    $username = $input['username'] ?? '';
    $password = $input['password'] ?? '';

  

    // Validar que los campos necesarios no estén vacíos
    if ((empty($email) && empty($username)) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Ingrese email/username y contraseña."]);
        exit();
    }

    // Crear una instancia del modelo
    $loginModel = new LoginModel();
    // Intentar autenticar al usuario
    $user = $loginModel->authenticate($email, $username, $password);

    if ($user) {
        // Si la autenticación es exitosa, almacenar los datos del usuario en la sesión
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        

        echo json_encode(["status" => "success", "message" => "Login exitoso"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Credenciales incorrectas"]);
    }
}
?>
