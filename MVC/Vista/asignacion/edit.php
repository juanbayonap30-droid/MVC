<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignación - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Asignación</h2>
            <div class="header-actions">
                <a href="index.php?controller=asignacion&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos de la Asignación</h3>
                </div>

                <form action="index.php?controller=asignacion&action=update" method="POST" class="form">
                    <input type="hidden" name="asig_id" value="<?= htmlspecialchars($asignacion->getAsigId()) ?>">
                    
                    <div class="form-group">
                        <label for="inst_id">Instructor:</label>
                        <select id="inst_id" name="inst_id" required>
                            <option value="">Seleccione un instructor</option>
                            <?php
                            require_once 'MVC/Modelo/Instructor.php';
                            $instructores = Instructor::all();
                            foreach ($instructores as $instructor): ?>
                                <option value="<?= $instructor->getInstId() ?>" 
                                    <?= $asignacion->getInstId() == $instructor->getInstId() ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($instructor->getInstNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="asig_fecha_ini">Fecha Inicio:</label>
                        <input type="datetime-local" id="asig_fecha_ini" name="asig_fecha_ini" 
                               value="<?= htmlspecialchars(substr($asignacion->getAsigFechaIni(), 0, 16)) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="asig_fecha_fin">Fecha Fin:</label>
                        <input type="datetime-local" id="asig_fecha_fin" name="asig_fecha_fin" 
                               value="<?= htmlspecialchars(substr($asignacion->getAsigFechaFin(), 0, 16)) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="fich_id">Ficha:</label>
                        <select id="fich_id" name="fich_id" required>
                            <option value="">Seleccione una ficha</option>
                            <?php
                            require_once 'MVC/Modelo/Ficha.php';
                            $fichas = Ficha::all();
                            foreach ($fichas as $ficha): ?>
                                <option value="<?= $ficha->getFichId() ?>"
                                    <?= $asignacion->getFichId() == $ficha->getFichId() ? 'selected' : '' ?>>
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
                                <option value="<?= $ambiente->getAmbId() ?>"
                                    <?= $asignacion->getAmbId() == $ambiente->getAmbId() ? 'selected' : '' ?>>
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
                                <option value="<?= $competencia->getCompId() ?>"
                                    <?= $asignacion->getCompId() == $competencia->getCompId() ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($competencia->getCompNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar Asignación</button>
                        <a href="index.php?controller=asignacion&action=index" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

        <footer class="footer-sena">
            <p>&copy; <?php echo date('Y'); ?> SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>
</body>
</html>