<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Coordinación - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Coordinación</h2>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos de Coordinación</h3>
                </div>

                <form action="index.php?controller=coordinacion&action=update" method="POST">
                    <input type="hidden" name="coord_id" value="<?php echo htmlspecialchars($coordinacion->getCoordId()); ?>">

                    <div class="form-group">
                        <label for="coord_id_display">ID de Coordinación</label>
                        <input type="text" class="form-control" id="coord_id_display" value="<?php echo htmlspecialchars($coordinacion->getCoordId()); ?>" disabled>
                    </div>

                    <div class="form-group">
                        <label for="coord_nombre">Nombre de Coordinación</label>
                        <input type="text" class="form-control" id="coord_nombre" name="coord_nombre" required value="<?php echo htmlspecialchars($coordinacion->getCoordNombre()); ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Nueva Contraseña (opcional)</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco para mantener la actual">
                        <small>Solo completa este campo si deseas cambiar la contraseña</small>
                    </div>

                    <div class="form-group">
                        <label for="centro_formacion_id">Centro de Formación</label>
                        <input type="number" class="form-control" id="centro_formacion_id" name="centro_formacion_id" required value="<?php echo htmlspecialchars($coordinacion->getCentroFormacionId()); ?>">
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="index.php?controller=coordinacion&action=index" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

        <footer class="footer-sena">
            <p>&copy; 2026 SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>
</body>
</html>
