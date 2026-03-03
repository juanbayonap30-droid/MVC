<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Instructor - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Instructor</h2>
            <div class="header-actions">
                <a href="index.php?controller=instructor&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos del Instructor</h3>
                </div>

                <form action="index.php?controller=instructor&action=update" method="POST" class="form">
                    <input type="hidden" name="inst_id" value="<?= htmlspecialchars($instructor->getInstId()) ?>">
                    
                    <div class="form-group">
                        <label for="inst_nombres">Nombres:</label>
                        <input type="text" id="inst_nombres" name="inst_nombres" 
                               value="<?= htmlspecialchars($instructor->getInstNombres()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="inst_apellidos">Apellidos:</label>
                        <input type="text" id="inst_apellidos" name="inst_apellidos" 
                               value="<?= htmlspecialchars($instructor->getInstApellidos()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="inst_correo">Correo Electrónico:</label>
                        <input type="email" id="inst_correo" name="inst_correo" 
                               value="<?= htmlspecialchars($instructor->getInstCorreo()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="inst_telefono">Teléfono:</label>
                        <input type="tel" id="inst_telefono" name="inst_telefono" 
                               value="<?= htmlspecialchars($instructor->getInstTelefono()) ?>" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar Instructor</button>
                        <a href="index.php?controller=instructor&action=index" class="btn btn-secondary">Cancelar</a>
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