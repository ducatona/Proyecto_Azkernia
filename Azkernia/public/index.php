<?php
// // Define constantes
define('APP_ROOT', dirname(__DIR__) . '/');
require_once('../app/controllers/UserController.php');
require_once('../config/database.php');
// Obtener el controlador y la acción de los parámetros GET
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'UserController';
$action = $_GET['action'] ?? 'login';

// Ruta del controlador
$controllerPath = APP_ROOT . 'app/controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    $controllerInstance = new $controllerName();

    // Verificar si el método existe en el controlador
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        echo "La acción '{$action}' no está definida en el controlador '{$controllerName}'.";
    }
} else {
    echo "El controlador '{$controllerName}' no existe.";
}




?>