<?php

// index.php

// Verificar la solicitud POST para registrar un usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registrar un usuario
    if (strpos($_SERVER["REQUEST_URI"], '/register') !== false) {
        require_once 'controllers/register.controller.php';
        $registerController = new RegisterController();
        $registerController->registerUser();
    }
    // Iniciar sesión
    elseif (strpos($_SERVER["REQUEST_URI"], '/login') !== false) {
        require_once 'controllers/login.controller.php';
        
    }
    elseif (strpos($_SERVER["REQUEST_URI"], '/facil') !== false) {
        require_once 'controllers/facil.controller.php';
        
    }
    
    else {
        echo json_encode(["status" => "error", "message" => "Método o ruta no permitido"]);
    }
}
// Verificar la solicitud GET para el formulario de registro
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && strpos($_SERVER["REQUEST_URI"], '/register') !== false) {
    require_once 'views/user/register.html';
}
// Verificar la solicitud GET para el formulario de login
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && strpos($_SERVER["REQUEST_URI"], '/login') !== false) {
    require_once 'views/user/login.html';
}
// Verificar la solicitud GET para el dashboard
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && strpos($_SERVER["REQUEST_URI"], '/dashboard') !== false) {
    // Incluir el controlador de dashboard
    require_once 'controllers/dashboard.controller.php';
    $dashboardController = new DashboardController();
    $dashboardController->handleDashboardRequest();  // El controlador maneja la verificación de sesión
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && strpos($_SERVER["REQUEST_URI"], '/facil') !== false) {
    require_once 'views/user/juego_tri-facil.html';
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET" && strpos($_SERVER["REQUEST_URI"], '/api-facil') !== false) {
    // Llamar al controlador 'facil.controller.php'
    require_once 'controllers/facil.controller.php';
    $facilController = new FacilController();
    $facilController->getQuestionsWithAnswers();
}
 else {
    echo json_encode(["status" => "error", "message" => "Método o ruta no permitido"]);
}
?>
