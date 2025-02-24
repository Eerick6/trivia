<?php
class Database {
    private $host = "localhost";  // Host de la base de datos
    private $db_name = "trivia_game";  // Nombre de la base de datos
    private $username = "root";  // Usuario de la base de datos
    private $password = "";  // Contraseña del usuario de la base de datos
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Establecer la conexión utilizando PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, 
                                  $this->password);
            // Configurar el modo de errores de PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Capturar el error y mostrarlo si la conexión falla
            echo "Error al conectar a la base de datos: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
