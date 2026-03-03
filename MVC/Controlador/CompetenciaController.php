<?php
require_once 'MVC/Modelo/Competencia.php';
require_once 'MVC/Controlador/AuthController.php';

class CompetenciaController
{
    // Listar todas las competencias
    public function index()
    {
        AuthController::requireCoordinador();
        try {
            $competencias = Competencia::all();
            if ($competencias === null) {
                $competencias = [];
            }
        } catch (Exception $e) {
            $competencias = [];
            error_log("Error al listar competencias: " . $e->getMessage());
        }
        require_once 'MVC/Vista/competencia/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/competencia/create.php';
    }

    // Guardar nueva competencia
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $competencia = new Competencia(
                $_POST['comp_id'],
                $_POST['comp_nombre_corto'],
                $_POST['comp_horas'],
                $_POST['comp_nombre_unidad_competencia']
            );
            Competencia::save($competencia);
            header('Location: index.php?controller=competencia&action=index');
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireCoordinador();
        $comp_id = $_GET['id'];
        $competencia = Competencia::searchById($comp_id);
        require_once 'MVC/Vista/competencia/edit.php';
    }

    // Actualizar competencia
    public function update()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $competencia = new Competencia(
                $_POST['comp_id'],
                $_POST['comp_nombre_corto'],
                $_POST['comp_horas'],
                $_POST['comp_nombre_unidad_competencia']
            );
            Competencia::update($competencia);
            header('Location: index.php?controller=competencia&action=index');
        }
    }

    // Eliminar competencia
    public function delete()
    {
        AuthController::requireCoordinador();
        $comp_id = $_GET['id'];
        Competencia::delete($comp_id);
        header('Location: index.php?controller=competencia&action=index');
    }
}
?>