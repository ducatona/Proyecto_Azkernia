<?php
require_once APP_ROOT . 'app/models/User.php'; // Usar APP_ROOT para rutas absolutas

class UserController
{
    public function login()
    {
        // Verificar si la solicitud es POST (cuando el formulario es enviado)
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password']; // Contraseña sin hash

            // Evita crear sesiones que ya están activas
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Crear una instancia del modelo User
            $verificacionUsuario = new User;
            $usuario = $verificacionUsuario->findByUsername($username);

            if ($usuario) {
                // Comprobar si la contraseña es correcta usando password_verify
                if (password_verify($password, $usuario['contrasena'])) {
                    // La contraseña es correcta, guardar el ID del usuario en la sesión
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];

                    // Cargar la vista de inicio
                    require APP_ROOT . 'app/views/inicio.php';
                    exit();
                } else {
                    // Contraseña incorrecta
                    $error = "Contraseña incorrecta";
                    require APP_ROOT . 'app/views/login.php';
                }
            } else {
                // Usuario no encontrado
                $error = "El usuario no existe";
                require APP_ROOT . 'app/views/login.php';
            }
        } else {
            // Mostrar formulario de login
            require APP_ROOT . 'app/views/login.php';
        }
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            // Capturar datos enviados por el formulario
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $nombre = $_POST['nombre'] ?? null; // Si no se envía, se establece como NULL
            $apellidos = $_POST['apellidos'] ?? null; // Lo mismo para apellidos
    
            // Validaciones básicas
            if (empty($username) || empty($password)) {
                $error = "El nombre de usuario y la contraseña son obligatorios";
                require APP_ROOT . 'app/views/register.php';
                return;
            }
    
            // Validación de email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "El correo electrónico no es válido";
                require APP_ROOT . 'app/views/register.php';
                return;
            }
    
            // Crear instancia del modelo User
            $user = new User();
    
            // Intentar registrar al usuario
            $registroExitoso = $user->create($username, $password, $nombre, $apellidos, $email);
    
            if ($registroExitoso) {
                // Redirigir al login
                header("Location: index.php?controller=user&action=login"); // Redirigir al login
                exit();
            } else {
                $error = "El nombre de usuario ya existe o hubo un error al registrar";
                require APP_ROOT . 'app/views/register.php';
            }
        } else {
            // Mostrar formulario de registro
            require APP_ROOT . 'app/views/register.php';
        }
    }
}
?>
