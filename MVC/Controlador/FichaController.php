<?php
require_once 'MVC/Modelo/Ficha.php';
require_once 'MVC/Modelo/Programa.php';
require_once 'MVC/Modelo/Instructor.php';
require_once 'MVC/Controlador/AuthController.php';

class FichaController
{
    // Listar todas las fichas
    public function index()
    {
        AuthController::requireCoordinador();
        try {
            $fichas = Ficha::all();
            if ($fichas === null) {
                $fichas = [];
            }
        } catch (Exception $e) {
            $fichas = [];
            error_log("Error al listar fichas: " . $e->getMessage());
        }
        require_once 'MVC/Vista/ficha/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        $programas = Programa::all();
        $instructores = Instructor::all();
        require_once 'MVC/Vista/ficha/create.php';
    }

    // Guardar nueva ficha
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ficha = new Ficha(
                $_POST['fich_id'],
                $_POST['prog_id'],
                $_POST['inst_id_lider'],
                $_POST['fich_jornada']
            );
            Ficha::save($ficha);
            header('Location: index.php?controller=ficha&action=index');
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireCoordinador();
        $fich_id = $_GET['id'];
        $ficha = Ficha::searchById($fich_id);
        $programas = Programa::all();
        $instructores = Instructor::all();
        require_once 'MVC/Vista/ficha/edit.php';
    }

    // Actualizar ficha
    public function update()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ficha = new Ficha(
                $_POST['fich_id'],
                $_POST['prog_id'],
                $_POST['inst_id_lider'],
                $_POST['fich_jornada']
            );
            Ficha::update($ficha);
            header('Location: index.php?controller=ficha&action=index');
        }
    }

    // Eliminar ficha
    public function delete()
    {
        AuthController::requireCoordinador();
        $fich_id = $_GET['id'];
        Ficha::delete($fich_id);
        header('Location: index.php?controller=ficha&action=index');
    }
}
?>
