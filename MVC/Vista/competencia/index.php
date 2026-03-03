<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competencias - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/modal-modern.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Competencias</h2>
            <div class="header-actions">
                <a href="index.php?controller=competencia&action=create" class="btn btn-primary">+ Nueva Competencia</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Lista de Competencias</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Corto</th>
                                <th>Horas</th>
                                <th>Unidad de Competencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($competencias)): ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <p>🎯 No hay competencias registradas</p>
                                        <a href="index.php?controller=competencia&action=create" class="btn btn-primary">+ Crear Primera Competencia</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($competencias as $competencia): ?>
                                <tr>
                                    <td><?= htmlspecialchars($competencia->getCompId()) ?></td>
                                    <td><?= htmlspecialchars($competencia->getCompNombreCorto()) ?></td>
                                    <td><?= htmlspecialchars($competencia->getCompHoras()) ?></td>
                                    <td><?= htmlspecialchars(substr($competencia->getCompNombreUnidadCompetencia(), 0, 50)) ?>...</td>
                                    <td>
                                        <div class="table-actions">
                                            <button onclick="verDetallesCompetencia(
                                                '<?= htmlspecialchars($competencia->getCompId()) ?>',
                                                '<?= htmlspecialchars($competencia->getCompNombreCorto()) ?>',
                                                '<?= htmlspecialchars($competencia->getCompHoras()) ?>',
                                                '<?= htmlspecialchars($competencia->getCompNombreUnidadCompetencia()) ?>'
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

    <!-- Modal de Detalles de la Competencia -->
    <div id="competenciaModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-title-section">
                        <div class="modal-icon">🎯</div>
                        <h2 class="modal-title">Detalles de la Solicitud: COMP-<span id="modal-comp-id-title">001</span></h2>
                    </div>
                    <button class="modal-close" onclick="cerrarModal()">&times;</button>
                </div>
            </div>
            
            <div class="modal-body">
                <!-- Sección Tabla de Objetos -->
                <div class="objects-table-section">
                    <h3 class="section-title">Información de la Competencia</h3>
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
                                <td>ID Competencia</td>
                                <td id="modal-comp-id">-</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Nombre Corto</td>
                                <td id="modal-comp-nombre-corto">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Horas</td>
                                <td id="modal-comp-horas">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Información de Detalles -->
                <div class="details-grid">
                    <div class="detail-card">
                        <div class="detail-label">Unidad de Competencia</div>
                        <div class="detail-value" id="modal-comp-unidad">-</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Estado de la Competencia</div>
                        <div class="detail-value">Activa y Vigente</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Fecha de Registro</div>
                        <div class="detail-value"><?php echo date('d/m/Y'); ?></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Tipo</div>
                        <div class="detail-value">Competencia Técnica</div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn btn-editar" onclick="editarCompetencia()">Editar</button>
                <button class="modal-btn btn-eliminar" onclick="eliminarCompetencia()">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/modal.js"></script>
</body>
</html>