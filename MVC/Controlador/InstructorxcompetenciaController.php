<?php
require_once 'MVC/Modelo/InstruCompetencia.php';
require_once 'MVC/Controlador/AuthController.php';

class InstructorxcompetenciaController
{
    // Listar todas las relaciones
    public function index()
    {
        AuthController::requireCoordinador();
        
        // Debug
        error_log("InstructorxcompetenciaController::index() - Iniciando");
        
        try {
            $relaciones = InstruCompetencia::all();
            error_log("Relaciones obtenidas: " . count($relaciones));
            
            if ($relaciones === null) {
                $relaciones = [];
                error_log("Relaciones era null, se convirtió a array vacío");
            }
        } catch (Exception $e) {
            $relaciones = [];
            error_log("Error al listar relaciones: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $_SESSION['error'] = 'Error al cargar las asignaciones: ' . $e->getMessage();
        }
        
        error_log("Cargando vista con " . count($relaciones) . " relaciones");
        require_once 'MVC/Vista/instructorxcompetencia/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/instructorxcompetencia/create.php';
    }

    // Guardar nueva relación
    public function store()
    {
        AuthController::requireCoordinador();
        
        // Log para depuración
        error_log("InstructorxcompetenciaController::store() - Iniciando");
        error_log("POST data: " . print_r($_POST, true));
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar que los datos existan
                if (empty($_POST['inst_id']) || empty($_POST['prog_id']) || empty($_POST['comp_id'])) {
                    throw new Exception('Faltan datos requeridos');
                }
                
                $vigencia = !empty($_POST['inscomp_vigencia']) ? $_POST['inscomp_vigencia'] : null;
                
                $relacion = new InstruCompetencia(
                    null,
                    $_POST['inst_id'],
                    $_POST['prog_id'],
                    $_POST['comp_id'],
                    $vigencia
                );
                
                error_log("Guardando relación: inst_id=" . $_POST['inst_id'] . ", prog_id=" . $_POST['prog_id'] . ", comp_id=" . $_POST['comp_id']);
                InstruCompetencia::save($relacion);
                
                $_SESSION['success'] = 'Asignación creada exitosamente';
                error_log("Asignación creada exitosamente");
                header('Location: index.php?controller=instructorxcompetencia&action=index');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al crear la asignación: ' . $e->getMessage();
                error_log("Error en InstructorxcompetenciaController::store() - " . $e->getMessage());
                header('Location: index.php?controller=instructorxcompetencia&action=create');
                exit;
            }
        } else {
            error_log("Método no es POST: " . $_SERVER['REQUEST_METHOD']);
            header('Location: index.php?controller=instructorxcompetencia&action=create');
            exit;
        }
    }

    // Eliminar relación
    public function delete()
    {
        AuthController::requireCoordinador();
        $id = $_GET['id'];
        InstruCompetencia::delete($id);
        header('Location: index.php?controller=instructorxcompetencia&action=index');
        exit;
    }
}
?>
