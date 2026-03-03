<?php
require_once 'MVC/Modelo/Competenciaxprograma.php';
require_once 'MVC/Controlador/AuthController.php';

class CompetenciaxprogramaController
{
    // Listar todas las relaciones
    public function index()
    {
        AuthController::requireCoordinador();
        try {
            $relaciones = CompetxPrograma::all();
            
            // Debug temporal
            error_log("CompetxPrograma::all() retornó: " . print_r($relaciones, true));
            error_log("Cantidad de relaciones: " . count($relaciones));
            
            if ($relaciones === null) {
                $relaciones = [];
            }
        } catch (Exception $e) {
            $relaciones = [];
            error_log("Error al listar relaciones: " . $e->getMessage());
            $_SESSION['error'] = 'Error al cargar las relaciones: ' . $e->getMessage();
        }
        require_once 'MVC/Vista/competenciaxprograma/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireCoordinador();
        require_once 'MVC/Vista/competenciaxprograma/create.php';
    }

    // Guardar nueva relación
    public function store()
    {
        AuthController::requireCoordinador();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar que los datos existan
                if (empty($_POST['prog_id']) || empty($_POST['comp_id'])) {
                    $_SESSION['error'] = 'Debe seleccionar un programa y una competencia';
                    header('Location: index.php?controller=competenciaxprograma&action=create');
                    exit;
                }
                
                $prog_id = $_POST['prog_id'];
                $comp_id = $_POST['comp_id'];
                
                // Verificar si la relación ya existe
                $db = getDB();
                $check = $db->prepare(
                    'SELECT COUNT(*) as count FROM competxprograma 
                     WHERE PROGRAMA_prog_id = :prog_id 
                     AND COMPETENCIA_comp_id = :comp_id'
                );
                $check->bindValue('prog_id', $prog_id);
                $check->bindValue('comp_id', $comp_id);
                $check->execute();
                $result = $check->fetch(PDO::FETCH_ASSOC);
                
                if ($result['count'] > 0) {
                    $_SESSION['error'] = 'Esta relación ya existe';
                    header('Location: index.php?controller=competenciaxprograma&action=create');
                    exit;
                }
                
                // Crear ID compuesto
                $compxprog_id = $prog_id . '-' . $comp_id;
                $relacion = new CompetxPrograma(
                    $compxprog_id,
                    $comp_id,
                    $prog_id
                );
                CompetxPrograma::save($relacion);
                $_SESSION['success'] = 'Relación creada exitosamente';
                header('Location: index.php?controller=competenciaxprograma&action=index');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al crear la relación: ' . $e->getMessage();
                error_log("Error en CompetenciaxprogramaController::store() - " . $e->getMessage());
                header('Location: index.php?controller=competenciaxprograma&action=create');
                exit;
            }
        }
    }

    // Eliminar relación
    public function delete()
    {
        AuthController::requireCoordinador();
        $id = $_GET['id'];
        CompetxPrograma::delete($id);
        header('Location: index.php?controller=competenciaxprograma&action=index');
        exit;
    }
}
?>
