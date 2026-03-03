<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/modal-modern.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Programas</h2>
            <div class="header-actions">
                <a href="index.php?controller=programa&action=create" class="btn btn-primary">+ Nuevo Programa</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Lista de Programas</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Denominación</th>
                                <th>ID Título</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($programas)): ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <p>📚 No hay programas registrados</p>
                                        <a href="index.php?controller=programa&action=create" class="btn btn-primary">+ Crear Primer Programa</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($programas as $programa): ?>
                                <tr>
                                    <td><?= htmlspecialchars($programa->getProgCodigo()) ?></td>
                                    <td><?= htmlspecialchars($programa->getProgDenominacion()) ?></td>
                                    <td><?= htmlspecialchars($programa->getTitId()) ?></td>
                                    <td><?= htmlspecialchars($programa->getProgTipo()) ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <button onclick="verDetallesPrograma(
                                                '<?= htmlspecialchars($programa->getProgCodigo()) ?>',
                                                '<?= htmlspecialchars($programa->getProgDenominacion()) ?>',
                                                '<?= htmlspecialchars($programa->getTitId()) ?>',
                                                '<?= htmlspecialchars($programa->getProgTipo()) ?>'
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

    <!-- Modal de Detalles del Programa -->
    <div id="programaModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-content">
                    <div class="modal-title-section">
                        <div class="modal-icon">📚</div>
                        <h2 class="modal-title">Detalles de la Solicitud: PROG-<span id="modal-prog-codigo-title">001</span></h2>
                    </div>
                    <button class="modal-close" onclick="cerrarModal()">&times;</button>
                </div>
            </div>
            
            <div class="modal-body">
                <!-- Sección Tabla de Objetos -->
                <div class="objects-table-section">
                    <h3 class="section-title">Información del Programa</h3>
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
                                <td>Código</td>
                                <td id="modal-prog-codigo">-</td>
                                <td><span class="status-badge status-active">Activo</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Denominación</td>
                                <td id="modal-prog-denominacion">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                            <tr>
                                <td>Tipo</td>
                                <td id="modal-prog-tipo">-</td>
                                <td><span class="status-badge status-active">Válido</span></td>
                                <td>✅</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Información de Detalles -->
                <div class="details-grid">
                    <div class="detail-card">
                        <div class="detail-label">ID Título</div>
                        <div class="detail-value" id="modal-prog-titulo">-</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Estado del Programa</div>
                        <div class="detail-value">Activo y Vigente</div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Fecha de Registro</div>
                        <div class="detail-value"><?php echo date('d/m/Y'); ?></div>
                    </div>
                    <div class="detail-card">
                        <div class="detail-label">Modalidad</div>
                        <div class="detail-value">Presencial</div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="modal-btn btn-editar" onclick="editarPrograma()">Editar</button>
                <button class="modal-btn btn-eliminar" onclick="eliminarPrograma()">Eliminar</button>
            </div>
        </div>
    </div>

    <script src="assets/js/modal.js"></script>
</body>
</html>