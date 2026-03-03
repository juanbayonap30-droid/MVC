<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambientes - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/modal-modern.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Ambientes</h2>
            <div class="header-actions">
                <a href="index.php?controller=ambiente&action=create" class="btn btn-primary">+ Nuevo Ambiente</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Lista de Ambientes</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>ID Sede</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($ambientes)): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <p>🏢 No hay ambientes registrados</p>
                                        <a href="index.php?controller=ambiente&action=create" class="btn btn-primary">+ Crear Primer Ambiente</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($ambientes as $ambiente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($ambiente->getAmbId()) ?></td>
                                    <td><?= htmlspecialchars($ambiente->getAmbNombre()) ?></td>
                                    <td><?= htmlspecialchars($ambiente->getSedeId()) ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <button onclick="verDetallesAmbiente(
                                                '<?= htmlspecialchars($ambiente->getAmbId()) ?>',
                                                '<?= htmlspecialchars($ambiente->getAmbNombre()) ?>',
                                                '<?= htmlspecialchars($ambiente->getSedeId()) ?>'
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

    <!-- Modal de Detalles del Ambiente -->
    <div id="ambienteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-title-section">
                        <div class="modal-icon">🏢</div>
                        <h2 class="modal-title">Detalles de la Solicitud: AMB-<span id="modal-amb-id-title">001</span></h2>
                    </div>
                    <button class="modal-close" onclick="cerrarModal()">&times;</button>
                </div>
            </div>
            
            <div class="modal-body">
                <!-- Sección Tabla de Objetos -->
                <div class="objects-table-section">
                    <h3 class="section-title">Información del Ambiente</h3>
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
                                <td>ID Ambiente</td>
                                <td id="modal-amb-id">-</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td id="modal-amb-nombre">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>ID Sede</td>
                                <td id="modal-amb-sede">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Información de Detalles -->
                <div class="details-grid">
                    <div class="detail-card">
                        <div class="detail-label">Estado del Ambiente</div>
                        <div class="detail-value">Activo y Disponible</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Fecha de Registro</div>
                        <div class="detail-value"><?php echo date('d/m/Y'); ?></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Capacidad</div>
                        <div class="detail-value">Por definir</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Tipo</div>
                        <div class="detail-value">Aula de Formación</div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn btn-editar" onclick="editarAmbiente()">Editar</button>
                <button class="modal-btn btn-eliminar" onclick="eliminarAmbiente()">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/modal.js"></script>
</body>
</html>