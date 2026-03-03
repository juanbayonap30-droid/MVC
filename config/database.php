<?php
// Configuración de la base de datos MySQL

class Database {
    private static $instance = null;
    private $connection;
    
    // Configuración de conexión
    private $host = 'localhost';
    private $port = '3306';
    private $database = 'gestion_academica';
    private $username = 'root';
    private $password = ''; // En XAMPP por defecto está vacío
    
    private function __construct() {
        try {
            // Crear la cadena de conexión para MySQL
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset=utf8mb4";
            
            // Crear la conexión PDO
            $this->connection = new PDO($dsn, $this->username, $this->password);
            
            // Configurar PDO para que lance excepciones en caso de error
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Configurar el conjunto de caracteres
            $this->connection->exec("SET NAMES 'utf8mb4'");
            
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
    
    // Método para obtener la instancia única (Singleton)
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    // Método para obtener la conexión
    public function getConnection() {
        return $this->connection;
    }
    
    // Prevenir la clonación del objeto
    private function __clone() {}
    
    // Prevenir la deserialización del objeto
    public function __wakeup() {
        throw new Exception("No se puede deserializar un singleton");
    }
}

// Función helper para obtener la conexión fácilmente
function getDB() {
    return Database::getInstance()->getConnection();
}
?>
