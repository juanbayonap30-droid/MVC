<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructores - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/modal-modern.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Instructores</h2>
            <div class="header-actions">
                <a href="index.php?controller=instructor&action=create" class="btn btn-primary">+ Nuevo Instructor</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Lista de Instructores</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($instructores)): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <p>📋 No hay instructores registrados</p>
                                        <a href="index.php?controller=instructor&action=create" class="btn btn-primary">+ Crear Primer Instructor</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($instructores as $instructor): ?>
                                <tr>
                                    <td><?= htmlspecialchars($instructor->getInstId()) ?></td>
                                    <td><?= htmlspecialchars($instructor->getInstNombres()) ?></td>
                                    <td><?= htmlspecialchars($instructor->getInstApellidos()) ?></td>
                                    <td><?= htmlspecialchars($instructor->getInstCorreo()) ?></td>
                                    <td><?= htmlspecialchars($instructor->getInstTelefono()) ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <button onclick="verDetallesInstructor(
                                                '<?= htmlspecialchars($instructor->getInstId()) ?>',
                                                '<?= htmlspecialchars($instructor->getInstNombres()) ?>',
                                                '<?= htmlspecialchars($instructor->getInstApellidos()) ?>',
                                                '<?= htmlspecialchars($instructor->getInstCorreo()) ?>',
                                                '<?= htmlspecialchars($instructor->getInstTelefono()) ?>',
                                                '<?= htmlspecialchars($instructor->getCentroFormacionNombre() ?? 'Sin asignar') ?>'
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

    <!-- Modal de Detalles del Instructor -->
    <div id="instructorModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-title-section">
                        <div class="modal-icon">👨‍🏫</div>
                        <h2 class="modal-title">Detalles de la Solicitud: INST-<span id="modal-inst-id-title">001</span></h2>
                    </div>
                    <button class="modal-close" onclick="cerrarModal()">&times;</button>
                </div>
            </div>
            
            <div class="modal-body">
                <!-- Sección Tabla de Objetos -->
                <div class="objects-table-section">
                    <h3 class="section-title">Información del Instructor</h3>
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
                                <td>ID Instructor</td>
                                <td id="modal-inst-id">-</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Nombres</td>
                                <td id="modal-inst-nombres">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Apellidos</td>
                                <td id="modal-inst-apellidos">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Información de Detalles -->
                <div class="details-grid">
                    <div class="detail-card">
                        <div class="detail-label">Correo Electrónico</div>
                        <div class="detail-value" id="modal-inst-correo">-</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Teléfono</div>
                        <div class="detail-value" id="modal-inst-telefono">-</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Centro de Formación</div>
                        <div class="detail-value" id="modal-inst-centro">-</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Estado del Registro</div>
                        <div class="detail-value">Activo y Verificado</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Fecha de Registro</div>
                        <div class="detail-value"><?php echo date('d/m/Y'); ?></div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn btn-editar" onclick="editarInstructor()">Editar</button>
                <button class="modal-btn btn-eliminar" onclick="eliminarInstructor()">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/modal.js"></script>
    <script src="assets/js/sena-enhanced.js?v=<?php echo time(); ?>"></script>
</body>
</html>
