<?php
// Archivo principal del proyecto
session_start();

// Configurar error reporting - solo errores críticos
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', '1');

require_once 'config/database.php';

// Obtener el controlador y la acción de la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Construir el nombre del archivo del controlador
$controllerFile = "MVC/Controlador/" . ucfirst($controller) . "Controller.php";

// Verificar si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Construir el nombre de la clase del controlador
    $controllerClass = ucfirst($controller) . "Controller";
    
    // Crear una instancia del controlador
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        
        // Verificar si el método existe
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            echo "Error: La acción '$action' no existe en el controlador '$controllerClass'";
        }
    } else {
        echo "Error: La clase del controlador '$controllerClass' no existe";
    }
} else {
    echo "Error: El archivo del controlador '$controllerFile' no existe";
}
?>
