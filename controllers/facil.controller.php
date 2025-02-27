<?php
session_start();
// facil.controller.php

require_once 'models/facil.php';  // Incluir el modelo

class FacilController {
    
    public function getQuestionsWithAnswers() {
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];  // Obtener el user_id de la sesión

            // Llamar al modelo para obtener las preguntas y respuestas
            $facilModel = new FacilModel();
            $questions = $facilModel->getQuestionsWithAnswers();

            // Comprobar si las preguntas se obtuvieron correctamente
            if ($questions && count($questions) > 0) {
                // Devolver las preguntas y respuestas como JSON con caracteres no escapados
                echo json_encode([
                    "status" => "success",
                    "questions" => $questions
                ], JSON_UNESCAPED_UNICODE);  // Asegura que los caracteres especiales no sean codificados
            } else {
                // No hay preguntas disponibles
                echo json_encode([
                    "status" => "error",
                    "message" => "No hay preguntas disponibles"
                ], JSON_UNESCAPED_UNICODE);  // Asegura que los caracteres especiales no sean codificados
            }
        } else {
            // El usuario no está autenticado
            echo json_encode([
                "status" => "error",
                "message" => "Usuario no autenticado"
            ], JSON_UNESCAPED_UNICODE);  // Asegura que los caracteres especiales no sean codificados
        }
    }
}
?>
