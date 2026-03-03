<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichas - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/modal-modern.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Fichas</h2>
            <div class="header-actions">
                <a href="index.php?controller=ficha&action=create" class="btn btn-primary">+ Nueva Ficha</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Lista de Fichas</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Ficha</th>
                                <th>ID Programa</th>
                                <th>Instructor Líder</th>
                                <th>Jornada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($fichas)): ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <p>📚 No hay fichas registradas</p>
                                        <a href="index.php?controller=ficha&action=create" class="btn btn-primary">+ Crear Primera Ficha</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php 
                                require_once 'MVC/Modelo/Instructor.php';
                                foreach ($fichas as $ficha): 
                                    $instructor = null;
                                    if ($ficha->getInstIdLider()) {
                                        $instructor = Instructor::searchById($ficha->getInstIdLider());
                                    }
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($ficha->getFichId()) ?></td>
                                    <td><?= htmlspecialchars($ficha->getProgId()) ?></td>
                                    <td><?= $instructor ? htmlspecialchars($instructor->getInstNombre()) : 'N/A' ?></td>
                                    <td><?= htmlspecialchars($ficha->getFichJornada()) ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <button onclick="verDetallesFicha(
                                                '<?= htmlspecialchars($ficha->getFichId()) ?>',
                                                '<?= htmlspecialchars($ficha->getProgId()) ?>',
                                                '<?= $instructor ? htmlspecialchars($instructor->getInstNombre()) : 'N/A' ?>',
                                                '<?= htmlspecialchars($ficha->getFichJornada()) ?>'
                                            )" class="btn btn-primary btn-sm">Ver Detalles</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <footer class="footer-sena">
            <p>&copy; <?php echo date('Y'); ?> SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>

    <!-- Modal de Detalles de la Ficha -->
    <div id="fichaModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-title-section">
                        <div class="modal-icon">📚</div>
                        <h2 class="modal-title">Detalles de la Solicitud: FICH-<span id="modal-fich-id-title">001</span></h2>
                    </div>
                    <button class="modal-close" onclick="cerrarModal()">&times;</button>
                </div>
            </div>
            
            <div class="modal-body">
                <!-- Sección Tabla de Objetos -->
                <div class="objects-table-section">
                    <h3 class="section-title">Información de la Ficha</h3>
                    <table class="objects-table">
                        <thead>
                            <tr>
                                <th>Campo</th>
                                <th>Valor</th>
                                <th>Estado</th>
                                <th>Verificado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ID Ficha</td>
                                <td id="modal-fich-id">-</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>ID Programa</td>
                                <td id="modal-prog-id">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Jornada</td>
                                <td id="modal-fich-jornada">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Información de Detalles -->
                <div class="details-grid">
                    <div class="detail-card">
                        <div class="detail-label">ID Instructor Líder</div>
                        <div class="detail-value" id="modal-inst-lider">-</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Estado de la Ficha</div>
                        <div class="detail-value">Activa y Verificada</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Fecha de Creación</div>
                        <div class="detail-value"><?php echo date('d/m/Y'); ?></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Modalidad</div>
                        <div class="detail-value">Presencial</div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn btn-editar" onclick="editarFicha()">Editar</button>
                <button class="modal-btn btn-eliminar" onclick="eliminarFicha()">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/modal.js"></script>
</body>
</html>
