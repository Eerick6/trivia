<?php
// models/dashboard.model.php

require_once 'config/db.php'; // Incluir la configuración de la base de datos

class DashboardModel {

    // Método para obtener los datos del dashboard de un usuario
    public function getUserDashboardData($user_id) {
        global $conn;

        // Aquí puedes modificar la consulta según los datos que necesitas del dashboard
        $query = "SELECT points, easy_points, medium_points, hard_points, username FROM users WHERE id = ?";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $data;
        } else {
            return []; // Si ocurre un error en la consulta, retornamos un arreglo vacío
        }
    }
}
?>
