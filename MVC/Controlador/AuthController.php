<?php
require_once 'MVC/Modelo/Usuario.php';

class AuthController
{
    // Mostrar formulario de login
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirectToDashboard();
            exit;
        }
        require_once 'MVC/Vista/auth/login.php';
    }

    // Procesar login
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($nombre) || empty($password)) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                header('Location: index.php?controller=auth&action=login');
                exit;
            }

            try {
                $usuario = Usuario::findByNombre($nombre);

                if (!$usuario) {
                    $_SESSION['error'] = 'Usuario no encontrado. Intenta con otro nombre.';
                    header('Location: index.php?controller=auth&action=login');
                    exit;
                }

                // Verificar contraseña
                $passwordValida = false;
                
                // Intentar primero con password_verify (contraseñas hasheadas)
                if (password_verify($password, $usuario->getPassword())) {
                    $passwordValida = true;
                }
                // Si no funciona, intentar comparación directa (para datos de prueba)
                else if ($password === $usuario->getPassword()) {
                    $passwordValida = true;
                }
                
                if ($passwordValida) {
                    // Login exitoso
                    $_SESSION['user_id'] = $usuario->getId();
                    $_SESSION['user_nombre'] = $usuario->getNombre();
                    $_SESSION['user_email'] = $usuario->getCorreo();
                    $_SESSION['user_rol'] = $usuario->getRol();

                    $this->redirectToDashboard();
                } else {
                    $_SESSION['error'] = 'Contraseña incorrecta';
                    header('Location: index.php?controller=auth&action=login');
                }
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error: ' . $e->getMessage();
                header('Location: index.php?controller=auth&action=login');
            }
            exit;
        }
    }

    // Mostrar formulario de registro
    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirectToDashboard();
            exit;
        }
        require_once 'MVC/Vista/auth/register.php';
    }

    // Procesar registro
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';
            $rol = $_POST['rol'] ?? '';
            $telefono = trim($_POST['telefono'] ?? '');

            // Validaciones
            if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
                $_SESSION['error'] = 'Complete todos los campos obligatorios';
                header('Location: index.php?controller=auth&action=register');
                exit;
            }

            if ($password !== $password_confirm) {
                $_SESSION['error'] = 'Las contraseñas no coinciden';
                header('Location: index.php?controller=auth&action=register');
                exit;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
                header('Location: index.php?controller=auth&action=register');
                exit;
            }

            try {
                if ($rol === 'instructor') {
                    $nombreParts = explode(' ', $nombre, 2);
                    $nombres = $nombreParts[0];
                    $apellidos = isset($nombreParts[1]) ? $nombreParts[1] : '';
                    
                    Usuario::createInstructor($nombres, $apellidos, $email, $telefono, $password);
                } else {
                    Usuario::createCoordinador($nombre, 'Coordinador', $email, $password);
                }

                $_SESSION['success'] = 'Registro exitoso. Inicia sesión.';
                header('Location: index.php?controller=auth&action=login');
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al registrar: ' . $e->getMessage();
                header('Location: index.php?controller=auth&action=register');
            }
            exit;
        }
    }

    // Cerrar sesión
    public function logout()
    {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }

    // Redirigir según el rol
    private function redirectToDashboard()
    {
        $rol = $_SESSION['user_rol'] ?? '';
        
        if ($rol === 'coordinador' || $rol === 'centro') {
            header('Location: index.php?controller=instructor&action=index');
        } else {
            header('Location: index.php?controller=asignacion&action=index');
        }
    }

    // Verificar autenticación
    public static function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }

    public static function isCoordinador()
    {
        return isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'coordinador';
    }
    
    public static function isCentro()
    {
        return isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'centro';
    }

    public static function isInstructor()
    {
        return isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'instructor';
    }
    
    public static function isCoordinadorOrCentro()
    {
        return self::isCoordinador() || self::isCentro();
    }

    // Middleware
    public static function requireAuth()
    {
        if (!self::isAuthenticated()) {
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }

    public static function requireCoordinador()
    {
        self::requireAuth();
        if (!self::isCoordinadorOrCentro()) {
            $_SESSION['error'] = 'No tienes permisos';
            header('Location: index.php?controller=asignacion&action=index');
            exit;
        }
    }
}
?>
