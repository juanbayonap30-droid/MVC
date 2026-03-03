<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Competencia - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Competencia</h2>
            <div class="header-actions">
                <a href="index.php?controller=competencia&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos de la Competencia</h3>
                </div>

                <form action="index.php?controller=competencia&action=update" method="POST" class="form">
                    <input type="hidden" name="comp_id" value="<?= htmlspecialchars($competencia->getCompId()) ?>">
                    
                    <div class="form-group">
                        <label for="comp_nombre_corto">Nombre Corto:</label>
                        <input type="text" id="comp_nombre_corto" name="comp_nombre_corto" 
                               value="<?= htmlspecialchars($competencia->getCompNombreCorto()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="comp_horas">Horas:</label>
                        <input type="number" id="comp_horas" name="comp_horas" 
                               value="<?= htmlspecialchars($competencia->getCompHoras()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="comp_nombre_unidad_competencia">Nombre de la Unidad de Competencia:</label>
                        <textarea id="comp_nombre_unidad_competencia" name="comp_nombre_unidad_competencia" 
                                  rows="4" required><?= htmlspecialchars($competencia->getCompNombreUnidadCompetencia()) ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar Competencia</button>
                        <a href="index.php?controller=competencia&action=index" class="btn btn-secondary">Cancelar</a>
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