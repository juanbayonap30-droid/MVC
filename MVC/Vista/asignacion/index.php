<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaciones - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/calendar.css?v=<?php echo time(); ?>">
    <script>
        // Definir funciones globalmente ANTES de que se renderice el HTML
        function openModal(date) {
            console.log('Abriendo modal para fecha:', date);
            const modal = document.getElementById('assignmentModal');
            const dateDisplay = document.getElementById('modal-date-display');
            const dateInput = document.getElementById('asig_fecha_ini');
            const dateEndInput = document.getElementById('asig_fecha_fin');
            
            if (modal) {
                modal.style.display = 'flex';
                console.log('Modal abierto');
            } else {
                console.error('No se encontró el modal');
                return;
            }
            
            if (dateDisplay) {
                dateDisplay.textContent = 'Fecha seleccionada: ' + date;
            }
            
            if (dateInput) {
                dateInput.value = date + 'T08:00';
                console.log('Fecha inicio:', dateInput.value);
            }
            
            if (dateEndInput) {
                dateEndInput.value = date + 'T17:00';
                console.log('Fecha fin:', dateEndInput.value);
            }
        }
        
        function closeModal() {
            console.log('Cerrando modal');
            const modal = document.getElementById('assignmentModal');
            if (modal) {
                modal.style.display = 'none';
            }
            const detailsModal = document.getElementById('assignmentDetailsModal');
            if (detailsModal) {
                detailsModal.style.display = 'none';
            }
        }
        
        function showAssignments(date, assignments) {
            console.log('Mostrando asignaciones para:', date, assignments);
            const modal = document.getElementById('assignmentDetailsModal');
            const dateDisplay = document.getElementById('details-date-display');
            const listContainer = document.getElementById('assignments-list');
            
            if (!modal || !listContainer) {
                console.error('No se encontró el modal de detalles');
                return;
            }
            
            if (dateDisplay) {
                dateDisplay.textContent = 'Asignaciones del ' + date;
            }
            
            // Obtener rol del usuario desde PHP
            const userRole = '<?php echo $_SESSION['user_rol'] ?? ''; ?>';
            const isInstructor = (userRole === 'instructor');
            
            // Construir lista de asignaciones
            let html = '';
            assignments.forEach(function(asig) {
                html += '<div class="assignment-item">';
                html += '<div class="assignment-info">';
                html += '<strong>Instructor:</strong> ' + (asig.instructor_nombre || 'Sin asignar') + '<br>';
                html += '<strong>Ficha:</strong> ' + (asig.fich_id || 'N/A') + '<br>';
                html += '<strong>Ambiente:</strong> ' + (asig.ambiente_nombre || 'N/A') + '<br>';
                html += '<strong>Competencia:</strong> ' + (asig.competencia_nombre || 'N/A') + '<br>';
                html += '<strong>Horario:</strong> ' + formatDateTime(asig.asig_fecha_ini) + ' - ' + formatDateTime(asig.asig_fecha_fin);
                html += '</div>';
                
                // Solo mostrar botones si NO es instructor
                if (!isInstructor) {
                    html += '<div class="assignment-actions">';
                    html += '<a href="index.php?controller=asignacion&action=edit&id=' + asig.asig_id + '" class="btn-edit">Editar</a>';
                    html += '<a href="index.php?controller=asignacion&action=delete&id=' + asig.asig_id + '" class="btn-delete" onclick="return confirm(\'¿Está seguro de eliminar esta asignación?\')">Eliminar</a>';
                    html += '</div>';
                }
                
                html += '</div>';
            });
            
            listContainer.innerHTML = html;
            modal.style.display = 'flex';
        }
        
        function formatDateTime(datetime) {
            if (!datetime) return 'N/A';
            const date = new Date(datetime);
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            return hours + ':' + minutes;
        }
    </script>
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Asignaciones</h2>
        </header>

        <div class="container">
            <?php
            // Obtener mes y año de la URL o usar actual
            $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
            $month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
            $fichaFilter = isset($_GET['ficha']) ? (int)$_GET['ficha'] : null;
            
            // Calcular mes anterior y siguiente
            $prevMonth = $month - 1;
            $prevYear = $year;
            if ($prevMonth < 1) {
                $prevMonth = 12;
                $prevYear--;
            }
            
            $nextMonth = $month + 1;
            $nextYear = $year;
            if ($nextMonth > 12) {
                $nextMonth = 1;
                $nextYear++;
            }
            ?>
            
            <!-- Filtro de Fichas -->
            <div class="filter-section">
                <div class="filter-header">
                    <h3>Filtrar por Ficha</h3>
                </div>
                <div class="filter-content">
                    <form method="GET" action="index.php">
                        <input type="hidden" name="controller" value="asignacion">
                        <input type="hidden" name="action" value="index">
                        <input type="hidden" name="year" value="<?= $year ?>">
                        <input type="hidden" name="month" value="<?= $month ?>">
                        <select name="ficha" class="filter-select" onchange="this.form.submit()">
                            <option value="">Todas las Fichas</option>
                            <?php
                            require_once 'MVC/Modelo/Ficha.php';
                            $fichas = Ficha::all();
                            foreach ($fichas as $ficha): ?>
                                <option value="<?= $ficha->getFichId() ?>" <?= $fichaFilter == $ficha->getFichId() ? 'selected' : '' ?>>
                                    Ficha <?= htmlspecialchars($ficha->getFichId()) ?> - <?= htmlspecialchars($ficha->getFichJornada()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="calendar-stats">
                <?php
                $totalAsignaciones = isset($asignaciones) && is_array($asignaciones) ? count($asignaciones) : 0;
                $asignacionesActivas = 0;
                $hoy = date('Y-m-d');
                
                if ($totalAsignaciones > 0) {
                    foreach ($asignaciones as $a) {
                        try {
                            $fechaIni = substr($a->getAsigFechaIni(), 0, 10);
                            $fechaFin = substr($a->getAsigFechaFin(), 0, 10);
                            if ($fechaIni <= $hoy && $fechaFin >= $hoy) {
                                $asignacionesActivas++;
                            }
                        } catch (Exception $e) {
                            continue;
                        }
                    }
                }
                ?>
                <div class="stat-card">
                    <h3>Total Asignaciones</h3>
                    <div class="stat-number"><?= $totalAsignaciones ?></div>
                </div>
                <div class="stat-card">
                    <h3>Asignaciones Activas</h3>
                    <div class="stat-number"><?= $asignacionesActivas ?></div>
                </div>
                <div class="stat-card">
                    <h3>Este Mes</h3>
                    <div class="stat-number">
                        <?php
                        $esteMes = 0;
                        if ($totalAsignaciones > 0) {
                            foreach ($asignaciones as $a) {
                                $fechaIni = substr($a->getAsigFechaIni(), 0, 7); // YYYY-MM
                                $mesActual = sprintf('%04d-%02d', $year, $month);
                                if ($fechaIni === $mesActual) {
                                    $esteMes++;
                                }
                            }
                        }
                        echo $esteMes;
                        ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Instructores Activos</h3>
                    <div class="stat-number">
                        <?php
                        $instructoresUnicos = [];
                        if ($totalAsignaciones > 0) {
                            foreach ($asignaciones as $a) {
                                $instructoresUnicos[$a->getInstId()] = true;
                            }
                        }
                        echo count($instructoresUnicos);
                        ?>
                    </div>
                </div>
            </div>

            <!-- Calendario -->
            <div class="calendar-container">
                <div class="calendar-header">
                    <h2 class="calendar-title">
                        <?php 
                        $monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                        echo $monthNames[$month - 1] . ' ' . $year;
                        ?>
                    </h2>
                    <div class="calendar-navigation">
                        <a href="?controller=asignacion&action=index&year=<?= $prevYear ?>&month=<?= $prevMonth ?><?= $fichaFilter ? '&ficha='.$fichaFilter : '' ?>" class="calendar-nav-btn">‹</a>
                        <a href="?controller=asignacion&action=index<?= $fichaFilter ? '&ficha='.$fichaFilter : '' ?>" class="calendar-today-btn">Hoy</a>
                        <a href="?controller=asignacion&action=index&year=<?= $nextYear ?>&month=<?= $nextMonth ?><?= $fichaFilter ? '&ficha='.$fichaFilter : '' ?>" class="calendar-nav-btn">›</a>
                    </div>
                </div>
                
                <div class="calendar-grid">
                    <!-- Encabezados de días -->
                    <div class="calendar-weekdays">
                        <div class="calendar-weekday">Dom</div>
                        <div class="calendar-weekday">Lun</div>
                        <div class="calendar-weekday">Mar</div>
                        <div class="calendar-weekday">Mié</div>
                        <div class="calendar-weekday">Jue</div>
                        <div class="calendar-weekday">Vie</div>
                        <div class="calendar-weekday">Sáb</div>
                    </div>
                    
                    <!-- Días del mes -->
                    <div class="calendar-days">
                        <?php
                        // Obtener información del mes
                        $firstDay = mktime(0, 0, 0, $month, 1, $year);
                        $daysInMonth = date('t', $firstDay);
                        $startingDayOfWeek = date('w', $firstDay);
                        $today = date('Y-m-d');
                        
                        // Preparar arrays para días de inicio y fin de asignaciones
                        $assignmentsByDay = [];
                        $startDays = [];
                        $endDays = [];
                        
                        if (isset($asignaciones) && is_array($asignaciones)) {
                            foreach ($asignaciones as $a) {
                                try {
                                    $fechaIni = $a->getAsigFechaIni();
                                    $fechaFin = $a->getAsigFechaFin();
                                    
                                    if ($fechaIni && $fechaFin) {
                                        // Aplicar filtro de ficha
                                        if ($fichaFilter && $a->getFichId() != $fichaFilter) {
                                            continue;
                                        }
                                        
                                        // Procesar fecha de inicio
                                        $assignDateIni = substr($fechaIni, 0, 10);
                                        list($yIni, $mIni, $dIni) = explode('-', $assignDateIni);
                                        
                                        // Procesar fecha de fin
                                        $assignDateFin = substr($fechaFin, 0, 10);
                                        list($yFin, $mFin, $dFin) = explode('-', $assignDateFin);
                                        
                                        // Obtener información adicional
                                        require_once 'MVC/Modelo/Instructor.php';
                                        require_once 'MVC/Modelo/Ambientes.php';
                                        require_once 'MVC/Modelo/Competencia.php';
                                        
                                        $instructor = Instructor::searchById($a->getInstId());
                                        $ambiente = Ambiente::searchById($a->getAmbId());
                                        $competencia = Competencia::searchById($a->getCompId());
                                        
                                        $assignmentData = [
                                            'asig_id' => $a->getAsigId(),
                                            'inst_id' => $a->getInstId(),
                                            'instructor_nombre' => $instructor ? $instructor->getInstNombre() : 'Sin asignar',
                                            'asig_fecha_ini' => $a->getAsigFechaIni(),
                                            'asig_fecha_fin' => $a->getAsigFechaFin(),
                                            'fich_id' => $a->getFichId(),
                                            'amb_id' => $a->getAmbId(),
                                            'ambiente_nombre' => $ambiente ? $ambiente->getAmbNombre() : 'N/A',
                                            'comp_id' => $a->getCompId(),
                                            'competencia_nombre' => $competencia ? $competencia->getCompNombre() : 'N/A'
                                        ];
                                        
                                        // Marcar día de inicio si es del mes actual
                                        if ((int)$yIni == $year && (int)$mIni == $month) {
                                            $dayNumIni = (int)$dIni;
                                            if (!isset($assignmentsByDay[$dayNumIni])) {
                                                $assignmentsByDay[$dayNumIni] = [];
                                            }
                                            $assignmentsByDay[$dayNumIni][] = $assignmentData;
                                            $startDays[$dayNumIni] = true;
                                        }
                                        
                                        // Marcar día de fin si es del mes actual
                                        if ((int)$yFin == $year && (int)$mFin == $month) {
                                            $dayNumFin = (int)$dFin;
                                            if (!isset($assignmentsByDay[$dayNumFin])) {
                                                $assignmentsByDay[$dayNumFin] = [];
                                            }
                                            // Solo agregar si no es el mismo día de inicio
                                            if ($dayNumFin != $dayNumIni || (int)$yFin != (int)$yIni || (int)$mFin != (int)$mIni) {
                                                $assignmentsByDay[$dayNumFin][] = $assignmentData;
                                            }
                                            $endDays[$dayNumFin] = true;
                                        }
                                    }
                                } catch (Exception $e) {
                                    error_log("Error procesando asignación: " . $e->getMessage());
                                    continue;
                                }
                            }
                        }
                        
                        // Espacios vacíos antes del primer día
                        for ($i = 0; $i < $startingDayOfWeek; $i++) {
                            echo '<div class="calendar-day empty"></div>';
                        }
                        
                        // Días del mes
                        for ($day = 1; $day <= $daysInMonth; $day++) {
                            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
                            $isToday = ($date === $today);
                            
                            $hasAssignments = isset($assignmentsByDay[$day]) && count($assignmentsByDay[$day]) > 0;
                            $isStartDay = isset($startDays[$day]);
                            $isEndDay = isset($endDays[$day]);
                            
                            $classes = 'calendar-day';
                            if ($isToday) $classes .= ' today';
                            if ($hasAssignments) $classes .= ' has-assignment';
                            
                            echo '<div class="' . $classes . '" data-date="' . $date . '"';
                            
                            // Si hay asignaciones, agregar evento para mostrar detalles
                            if ($hasAssignments) {
                                $assignmentsJson = htmlspecialchars(json_encode($assignmentsByDay[$day]), ENT_QUOTES, 'UTF-8');
                                echo ' onclick="showAssignments(\'' . $date . '\', ' . $assignmentsJson . ')"';
                            } else {
                                echo ' onclick="openModal(\'' . $date . '\')"';
                            }
                            
                            echo '>';
                            echo '<span class="day-number">' . $day . '</span>';
                            
                            // Mostrar puntos indicadores
                            if ($isStartDay || $isEndDay) {
                                echo '<div class="assignment-indicators">';
                                if ($isStartDay) {
                                    echo '<span class="indicator-dot start-dot" title="Inicio de asignación"></span>';
                                }
                                if ($isEndDay && $isStartDay && $isStartDay != $isEndDay) {
                                    echo '<span class="indicator-dot end-dot" title="Fin de asignación"></span>';
                                } elseif ($isEndDay && !$isStartDay) {
                                    echo '<span class="indicator-dot end-dot" title="Fin de asignación"></span>';
                                }
                                echo '</div>';
                            }
                            
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer-sena">
            <p>&copy; <?php echo date('Y'); ?> SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>

    <!-- Modal de Nueva Asignación -->
    <div id="assignmentModal" class="assignment-modal" style="display: none;">
        <div class="assignment-modal-content">
            <div class="assignment-modal-header">
                <h2>Nueva Asignación</h2>
                <p id="modal-date-display">Seleccione una fecha</p>
            </div>
            <form action="index.php?controller=asignacion&action=store" method="POST">
                <div class="assignment-modal-body">
                    <div class="form-group">
                        <label for="inst_id">Instructor:</label>
                        <select id="inst_id" name="inst_id" required>
                            <option value="">Seleccione un instructor</option>
                            <?php
                            require_once 'MVC/Modelo/Instructor.php';
                            $instructores = Instructor::all();
                            foreach ($instructores as $instructor): ?>
                                <option value="<?= $instructor->getInstId() ?>">
                                    <?= htmlspecialchars($instructor->getInstNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="asig_fecha_ini">Fecha Inicio:</label>
                            <input type="datetime-local" id="asig_fecha_ini" name="asig_fecha_ini" required>
                        </div>
                        <div class="form-group">
                            <label for="asig_fecha_fin">Fecha Fin:</label>
                            <input type="datetime-local" id="asig_fecha_fin" name="asig_fecha_fin" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fich_id">Ficha:</label>
                        <select id="fich_id" name="fich_id" required>
                            <option value="">Seleccione una ficha</option>
                            <?php foreach ($fichas as $ficha): ?>
                                <option value="<?= $ficha->getFichId() ?>">
                                    Ficha <?= htmlspecialchars($ficha->getFichId()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amb_id">Ambiente:</label>
                        <select id="amb_id" name="amb_id" required>
                            <option value="">Seleccione un ambiente</option>
                            <?php
                            require_once 'MVC/Modelo/Ambientes.php';
                            $ambientes = Ambiente::all();
                            foreach ($ambientes as $ambiente): ?>
                                <option value="<?= $ambiente->getAmbId() ?>">
                                    <?= htmlspecialchars($ambiente->getAmbNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comp_id">Competencia:</label>
                        <select id="comp_id" name="comp_id" required>
                            <option value="">Seleccione una competencia</option>
                            <?php
                            require_once 'MVC/Modelo/Competencia.php';
                            $competencias = Competencia::all();
                            foreach ($competencias as $competencia): ?>
                                <option value="<?= $competencia->getCompId() ?>">
                                    <?= htmlspecialchars($competencia->getCompNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="assignment-modal-footer">
                    <button type="button" onclick="closeModal()" class="modal-btn-cancel">Cancelar</button>
                    <button type="submit" class="modal-btn-save">Guardar Asignación</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Detalles de Asignaciones -->
    <div id="assignmentDetailsModal" class="assignment-modal" style="display: none;">
        <div class="assignment-modal-content">
            <div class="assignment-modal-header">
                <h2>Asignaciones del Día</h2>
                <p id="details-date-display">Fecha</p>
            </div>
            <div class="assignment-modal-body">
                <div id="assignments-list"></div>
            </div>
            <div class="assignment-modal-footer">
                <button type="button" onclick="closeModal()" class="modal-btn-cancel">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            const modal = document.getElementById('assignmentModal');
            if (event.target === modal) {
                closeModal();
            }
        }
        
        // Validar formulario antes de enviar
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado, configurando formulario...');
            const form = document.querySelector('#assignmentModal form');
            if (form) {
                console.log('Formulario encontrado');
                form.addEventListener('submit', function(e) {
                    console.log('Enviando formulario...');
                    const instId = document.getElementById('inst_id').value;
                    const fechaIni = document.getElementById('asig_fecha_ini').value;
                    const fechaFin = document.getElementById('asig_fecha_fin').value;
                    const fichId = document.getElementById('fich_id').value;
                    const ambId = document.getElementById('amb_id').value;
                    const compId = document.getElementById('comp_id').value;
                    
                    console.log('Datos del formulario:', {
                        instId, fechaIni, fechaFin, fichId, ambId, compId
                    });
                    
                    if (!instId || !fechaIni || !fechaFin || !fichId || !ambId || !compId) {
                        e.preventDefault();
                        alert('Por favor complete todos los campos');
                        console.error('Formulario incompleto');
                        return false;
                    }
                    
                    console.log('Formulario válido, enviando...');
                });
            } else {
                console.error('No se encontró el formulario');
            }
        });
    </script>
</body>
</html>
