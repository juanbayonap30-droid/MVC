<?php
require_once 'MVC/Modelo/Programa.php';
require_once 'MVC/Controlador/AuthController.php';

class ProgramaController
{
    // Listar todos los programas
    public function index()
    {
        AuthController::requireCoordinador();
        try {
            $programas = Programa::all();
            if ($programas === null) {
                $programas = [];
            }
        } catch (Exception $e) {
            $programas = [];
            error_log("Error al listar programas: " . $e->getMessage());
        }
        require_once 'MVC/Vista/programa/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/programa/create.php';
    }

    // Guardar nuevo programa
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $programa = new Programa(
                $_POST['prog_codigo'],
                $_POST['prog_denominacion'],
                $_POST['tit_id'],
                $_POST['prog_tipo']
            );
            Programa::save($programa);
            header('Location: index.php?controller=programa&action=index');
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireCoordinador();
        $prog_codigo = $_GET['id'];
        $programa = Programa::searchByCodigo($prog_codigo);
        require_once 'MVC/Vista/programa/edit.php';
    }

    // Actualizar programa
    public function update()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $programa = new Programa(
                $_POST['prog_codigo'],
                $_POST['prog_denominacion'],
                $_POST['tit_id'],
                $_POST['prog_tipo']
            );
            Programa::update($programa);
            header('Location: index.php?controller=programa&action=index');
        }
    }

    // Eliminar programa
    public function delete()
    {
        AuthController::requireCoordinador();
        $prog_codigo = $_GET['id'];
        Programa::delete($prog_codigo);
        header('Location: index.php?controller=programa&action=index');
    }
}
?>