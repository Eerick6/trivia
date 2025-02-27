<?php
session_start();


// Incluir el modelo de Dashboard
require_once 'models/dashboard.php';

class DashboardController {

    public function handleDashboardRequest() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['user_id'])) {
            // Si no está autenticado, devolver un error
            echo json_encode(["status" => "error", "message" => "Usuario no autenticado"]);
            exit(); // Detener la ejecución
        }

        // Obtener el ID del usuario desde la sesión
        $user_id = $_SESSION['user_id'];

        // Crear una instancia del modelo de Dashboard
        $dashboardModel = new DashboardModel();

        // Obtener los datos del dashboard para el usuario
        $data = $dashboardModel->getUserDashboardData($user_id);

        // Verificar si los datos fueron obtenidos correctamente
        if (!$data) {
            // Si no se pudieron obtener los datos, devolver un error
            echo json_encode(["status" => "error", "message" => "No se pudieron obtener los datos del dashboard"]);
            exit();
        }

        // Si todo está bien, devolver los datos en formato JSON
        echo json_encode(["status" => "success", "data" => $data]);
        include_once 'views/user/dashboard.html';
    }
}
?>


