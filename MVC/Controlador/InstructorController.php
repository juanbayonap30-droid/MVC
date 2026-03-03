<?php
require_once 'MVC/Modelo/Instructor.php';
require_once 'MVC/Controlador/AuthController.php';

class InstructorController
{
    // Listar todos los instructores
    public function index()
    {
        AuthController::requireCoordinador();
        
        try {
            $instructores = Instructor::all();
            if ($instructores === null) {
                $instructores = [];
            }
        } catch (Exception $e) {
            $instructores = [];
            error_log("Error al listar instructores: " . $e->getMessage());
        }
        require_once 'MVC/Vista/instructor/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/instructor/create.php';
    }

    // Guardar nuevo instructor
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $instructor = new Instructor(
                $_POST['inst_id'],
                $_POST['inst_nombres'],
                $_POST['inst_apellidos'],
                $_POST['inst_correo'],
                $_POST['inst_telefono']
            );
            Instructor::save($instructor);
            header('Location: index.php?controller=instructor&action=index');
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireCoordinador();
        $inst_id = $_GET['id'];
        $instructor = Instructor::searchById($inst_id);
        require_once 'MVC/Vista/instructor/edit.php';
    }

    // Actualizar instructor
    public function update()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $instructor = new Instructor(
                $_POST['inst_id'],
                $_POST['inst_nombres'],
                $_POST['inst_apellidos'],
                $_POST['inst_correo'],
                $_POST['inst_telefono']
            );
            Instructor::update($instructor);
            header('Location: index.php?controller=instructor&action=index');
        }
    }

    // Eliminar instructor
    public function delete()
    {
        AuthController::requireCoordinador();
        $inst_id = $_GET['id'];
        Instructor::delete($inst_id);
        header('Location: index.php?controller=instructor&action=index');
    }
    
    // Ver perfil del instructor (solo para instructores)
    public function profile()
    {
        AuthController::requireAuth();
        
        // Verificar que sea instructor
        if ($_SESSION['user_rol'] !== 'instructor') {
            $_SESSION['error'] = 'No tienes permisos para acceder a esta sección';
            header('Location: index.php?controller=asignacion&action=index');
            exit;
        }
        
        $inst_id = $_SESSION['user_id'];
        $instructor = Instructor::searchById($inst_id);
        require_once 'MVC/Vista/instructor/profile.php';
    }
    
    // Actualizar perfil del instructor
    public function updateProfile()
    {
        AuthController::requireAuth();
        
        if ($_SESSION['user_rol'] !== 'instructor') {
            $_SESSION['error'] = 'No tienes permisos';
            header('Location: index.php?controller=asignacion&action=index');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inst_id = $_SESSION['user_id'];
            
            // Actualizar datos básicos
            $instructor = new Instructor(
                $inst_id,
                $_POST['inst_nombres'],
                $_POST['inst_apellidos'],
                $_POST['inst_correo'],
                $_POST['inst_telefono']
            );
            Instructor::update($instructor);
            
            // Actualizar contraseña si se proporcionó
            if (!empty($_POST['new_password'])) {
                $currentPassword = $_POST['current_password'] ?? '';
                $newPassword = $_POST['new_password'];
                $confirmPassword = $_POST['confirm_password'] ?? '';
                
                // Verificar contraseña actual
                $instructorActual = Instructor::searchById($inst_id);
                if (password_verify($currentPassword, $instructorActual->getInstPassword())) {
                    if ($newPassword === $confirmPassword) {
                        Instructor::updatePassword($inst_id, $newPassword);
                        $_SESSION['success'] = 'Perfil y contraseña actualizados correctamente';
                    } else {
                        $_SESSION['error'] = 'Las contraseñas nuevas no coinciden';
                    }
                } else {
                    $_SESSION['error'] = 'La contraseña actual es incorrecta';
                }
            } else {
                $_SESSION['success'] = 'Perfil actualizado correctamente';
            }
            
            // Actualizar nombre en sesión
            $_SESSION['user_nombre'] = $_POST['inst_nombres'] . ' ' . $_POST['inst_apellidos'];
            
            header('Location: index.php?controller=instructor&action=profile');
            exit;
        }
    }
}
