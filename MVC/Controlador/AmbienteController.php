<?php
require_once 'MVC/Modelo/Ambientes.php';
require_once 'MVC/Controlador/AuthController.php';

class AmbienteController
{
    // Listar todos los ambientes
    public function index()
    {
        AuthController::requireCoordinador();
        try {
            $ambientes = Ambiente::all();
            if ($ambientes === null) {
                $ambientes = [];
            }
        } catch (Exception $e) {
            $ambientes = [];
            error_log("Error al listar ambientes: " . $e->getMessage());
        }
        require_once 'MVC/Vista/ambiente/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/ambiente/create.php';
    }

    // Guardar nuevo ambiente
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ambiente = new Ambiente(
                $_POST['amb_id'],
                $_POST['amb_nombre'],
                $_POST['sede_id']
            );
            Ambiente::save($ambiente);
            header('Location: index.php?controller=ambiente&action=index');
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireCoordinador();
        $amb_id = $_GET['id'];
        $ambiente = Ambiente::searchById($amb_id);
        require_once 'MVC/Vista/ambiente/edit.php';
    }

    // Actualizar ambiente
    public function update()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ambiente = new Ambiente(
                $_POST['amb_id'],
                $_POST['amb_nombre'],
                $_POST['sede_id']
            );
            Ambiente::update($ambiente);
            header('Location: index.php?controller=ambiente&action=index');
        }
    }

    // Eliminar ambiente
    public function delete()
    {
        AuthController::requireCoordinador();
        $amb_id = $_GET['id'];
        Ambiente::delete($amb_id);
        header('Location: index.php?controller=ambiente&action=index');
    }
}
?>