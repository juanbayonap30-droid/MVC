<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinaciones - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/modal-modern.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Gestión de Coordinaciones</h2>
            <div class="header-actions">
                <a href="index.php?controller=coordinacion&action=create" class="btn btn-primary">+ Nueva Coordinación</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Lista de Coordinaciones</h3>
                </div>

                <?php if (empty($coordinaciones)): ?>
                    <div class="empty-state">
                        <p>No hay coordinaciones registradas</p>
                        <a href="index.php?controller=coordinacion&action=create" class="btn btn-primary">Crear Primera Coordinación</a>
                    </div>
                <?php else: ?>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE COORDINADOR</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($coordinaciones as $coordinacion): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($coordinacion->getCoordId()); ?></td>
                                        <td><?php echo htmlspecialchars($coordinacion->getCoordNombreCoordinador() ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($coordinacion->getCoordDescripcion() ?? 'N/A'); ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" onclick="verDetalles(<?php echo $coordinacion->getCoordId(); ?>, '<?php echo htmlspecialchars($coordinacion->getCoordNombreCoordinador() ?? 'N/A', ENT_QUOTES); ?>', '<?php echo htmlspecialchars($coordinacion->getCoordDescripcion() ?? 'N/A', ENT_QUOTES); ?>')">
                                                Ver Detalles
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <footer class="footer-sena">
            <p>&copy; 2026 SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>

    <!-- Modal para ver detalles -->
    <div id="modalDetalles" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>📋 Detalles de Coordinación</h3>
                <button class="modal-close" onclick="cerrarModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-info-item">
                    <div class="modal-info-label">ID</div>
                    <div class="modal-info-value" id="modal-id"></div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Nombre Coordinador</div>
                    <div class="modal-info-value" id="modal-nombre"></div>
                </div>
                <div class="modal-info-item">
                    <div class="modal-info-label">Descripción</div>
                    <div class="modal-info-value" id="modal-centro"></div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="btn-editar" class="btn btn-primary">Editar</a>
                <a href="#" id="btn-eliminar" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar esta coordinación?')">Eliminar</a>
            </div>
        </div>
    </div>

    <script src="assets/js/modal.js"></script>
    <script>
        function verDetalles(id, nombre, centro) {
            document.getElementById('modal-id').textContent = id;
            document.getElementById('modal-nombre').textContent = nombre;
            document.getElementById('modal-centro').textContent = centro;
            
            document.getElementById('btn-editar').href = 'index.php?controller=coordinacion&action=edit&id=' + id;
            document.getElementById('btn-eliminar').href = 'index.php?controller=coordinacion&action=delete&id=' + id;
            
            document.getElementById('modalDetalles').classList.add('active');
        }

        function cerrarModal() {
            document.getElementById('modalDetalles').classList.remove('active');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modalDetalles').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });
    </script>
</body>
</html>
