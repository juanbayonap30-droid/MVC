<?php
require_once 'MVC/Modelo/Asignacion.php';
require_once 'MVC/Controlador/AuthController.php';

class AsignacionController
{
    // Listar todas las asignaciones
    public function index()
    {
        AuthController::requireAuth();
        try {
            $rol = $_SESSION['user_rol'] ?? '';
            
            // Si es instructor, solo mostrar sus asignaciones
            if ($rol === 'instructor') {
                $instId = $_SESSION['user_id'] ?? null;
                if ($instId) {
                    $asignaciones = Asignacion::searchByInstructor($instId);
                } else {
                    $asignaciones = [];
                }
            } else {
                // Coordinadores y centros ven todas las asignaciones
                $asignaciones = Asignacion::all();
            }
            
            if ($asignaciones === null) {
                $asignaciones = [];
            }
        } catch (Exception $e) {
            $asignaciones = [];
            error_log("Error al listar asignaciones: " . $e->getMessage());
        }
        require_once 'MVC/Vista/asignacion/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        AuthController::requireAuth();
        require_once 'MVC/Vista/asignacion/create.php';
    }

    // Guardar nueva asignación
    public function store()
    {
        AuthController::requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asignacion = new Asignacion(
                null, // El ID se genera automáticamente
                $_POST['inst_id'],
                $_POST['asig_fecha_ini'],
                $_POST['asig_fecha_fin'],
                $_POST['fich_id'] ?? null,
                $_POST['amb_id'] ?? null,
                $_POST['comp_id'] ?? null
            );
            Asignacion::save($asignacion);
            header('Location: index.php?controller=asignacion&action=index');
            exit;
        }
    }

    // Mostrar formulario de edición
    public function edit()
    {
        AuthController::requireAuth();
        $asig_id = $_GET['id'];
        $asignacion = Asignacion::searchById($asig_id);
        require_once 'MVC/Vista/asignacion/edit.php';
    }

    // Actualizar asignación
    public function update()
    {
        AuthController::requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asignacion = new Asignacion(
                $_POST['asig_id'],
                $_POST['inst_id'],
                $_POST['asig_fecha_ini'],
                $_POST['asig_fecha_fin'],
                $_POST['fich_id'],
                $_POST['amb_id'],
                $_POST['comp_id']
            );
            Asignacion::update($asignacion);
            header('Location: index.php?controller=asignacion&action=index');
            exit;
        }
    }

    // Eliminar asignación
    public function delete()
    {
        AuthController::requireAuth();
        $asig_id = $_GET['id'];
        Asignacion::delete($asig_id);
        header('Location: index.php?controller=asignacion&action=index');
        exit;
    }

    // Obtener todas las asignaciones en formato JSON
    public function getAll()
    {
        AuthController::requireAuth();
        header('Content-Type: application/json');
        try {
            $asignaciones = Asignacion::allWithInstructorInfo();
            $data = array_map(function($a) {
                return [
                    'id' => $a->getAsigId(),
                    'instructor_id' => $a->getInstId(),
                    'instructor_nombre' => isset($a->instructor_nombre) ? $a->instructor_nombre : 'Sin asignar',
                    'fecha_ini' => $a->getAsigFechaIni(),
                    'fecha_fin' => $a->getAsigFechaFin(),
                    'ficha_id' => $a->getFichId(),
                    'ambiente_id' => $a->getAmbId(),
                    'competencia_id' => $a->getCompId()
                ];
            }, $asignaciones);
            echo json_encode($data);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }

    // Obtener estado de competencias para una ficha
    public function getCompetenciasStatus()
    {
        AuthController::requireAuth();
        header('Content-Type: application/json');
        try {
            $fichaId = isset($_GET['ficha_id']) ? $_GET['ficha_id'] : null;
            
            if (!$fichaId) {
                echo json_encode(['error' => 'ID de ficha requerido']);
                exit;
            }

            // Obtener la ficha
            require_once 'MVC/Modelo/Ficha.php';
            $ficha = Ficha::searchById($fichaId);
            
            if (!$ficha) {
                echo json_encode(['error' => 'Ficha no encontrada']);
                exit;
            }

            // Obtener el programa de la ficha
            $programaId = $ficha->getProgId();

            // Obtener competencias del programa
            require_once 'MVC/Modelo/Competenciaxprograma.php';
            require_once 'MVC/Modelo/Competencia.php';
            
            $relaciones = CompetxPrograma::searchByPrograma($programaId);
            $competencias = [];

            if (empty($relaciones)) {
                echo json_encode([
                    'ficha_id' => $fichaId,
                    'programa_id' => $programaId,
                    'competencias' => []
                ]);
                exit;
            }

            $asignaciones = Asignacion::allWithInstructorInfo();
            $hoy = new DateTime();

            foreach ($relaciones as $relacion) {
                $competencia = Competencia::searchById($relacion->getCompId());
                if ($competencia) {
                    $compId = $competencia->getCompId();
                    
                    // Verificar si la competencia ha sido vista
                    $vistas = 0;
                    $enProgreso = 0;
                    
                    foreach ($asignaciones as $a) {
                        if ($a->getFichId() == $fichaId && $a->getCompId() == $compId) {
                            try {
                                $fechaIni = new DateTime($a->getAsigFechaIni());
                                $fechaFin = new DateTime($a->getAsigFechaFin());
                                
                                if ($fechaFin < $hoy) {
                                    $vistas++;
                                } elseif ($fechaIni <= $hoy && $fechaFin >= $hoy) {
                                    $enProgreso++;
                                }
                            } catch (Exception $e) {
                                continue;
                            }
                        }
                    }

                    $estado = 'no-vista';
                    if ($vistas > 0) {
                        $estado = 'vista';
                    } elseif ($enProgreso > 0) {
                        $estado = 'en-progreso';
                    }

                    $competencias[] = [
                        'id' => $compId,
                        'nombre' => $competencia->getCompNombre(),
                        'estado' => $estado
                    ];
                }
            }

            echo json_encode([
                'ficha_id' => $fichaId,
                'programa_id' => $programaId,
                'competencias' => $competencias
            ]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }
}
?>