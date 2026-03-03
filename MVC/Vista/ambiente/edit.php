<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ambiente - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Ambiente</h2>
            <div class="header-actions">
                <a href="index.php?controller=ambiente&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos del Ambiente</h3>
                </div>

                <form action="index.php?controller=ambiente&action=update" method="POST" class="form">
                    <input type="hidden" name="amb_id" value="<?= htmlspecialchars($ambiente->getAmbId()) ?>">
                    
                    <div class="form-group">
                        <label for="amb_nombre">Nombre del Ambiente:</label>
                        <input type="text" id="amb_nombre" name="amb_nombre" 
                               value="<?= htmlspecialchars($ambiente->getAmbNombre()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="sede_id">ID Sede:</label>
                        <input type="number" id="sede_id" name="sede_id" 
                               value="<?= htmlspecialchars($ambiente->getSedeId()) ?>" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar Ambiente</button>
                        <a href="index.php?controller=ambiente&action=index" class="btn btn-secondary">Cancelar</a>
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