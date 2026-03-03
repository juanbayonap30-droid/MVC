<?php
require_once 'MVC/Modelo/Coordinacion.php';
require_once 'MVC/Controlador/AuthController.php';

class CoordinacionController
{
    // Listar todas las coordinaciones
    public function index()
    {
        AuthController::requireCoordinador();
        
        try {
            $coordinaciones = Coordinacion::all();
            if ($coordinaciones === null) {
                $coordinaciones = [];
            }
        } catch (Exception $e) {
            $coordinaciones = [];
            error_log("Error al listar coordinaciones: " . $e->getMessage());
        }
        require_once 'MVC/Vista/coordinacion/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/coordinacion/create.php';
    }

    // Guardar nueva coordinación
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $coordinacion = new Coordinacion(
                $_POST['coord_id'],
                $_POST['coord_nombre'],
                $_POST['password'],
                $_POST['centro_formacion_id']
            );
            Coordinacion::save($coordinacion);
            header('Location: index.php?controller=coordinacion&action=index');
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireCoordinador();
        $coord_id = $_GET['id'];
        $coordinacion = Coordinacion::searchById($coord_id);
        require_once 'MVC/Vista/coordinacion/edit.php';
    }

    // Actualizar coordinación
    public function update()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $coordinacion = new Coordinacion(
                $_POST['coord_id'],
                $_POST['coord_nombre'],
                $_POST['password'] ?? '', // Opcional
                $_POST['centro_formacion_id']
            );
            Coordinacion::update($coordinacion);
            header('Location: index.php?controller=coordinacion&action=index');
        }
    }

    // Eliminar coordinación
    public function delete()
    {
        AuthController::requireCoordinador();
        $coord_id = $_GET['id'];
        Coordinacion::delete($coord_id);
        header('Location: index.php?controller=coordinacion&action=index');
    }
}
?>
