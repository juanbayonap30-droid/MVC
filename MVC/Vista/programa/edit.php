<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Programa - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Programa</h2>
            <div class="header-actions">
                <a href="index.php?controller=programa&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos del Programa</h3>
                </div>

                <form action="index.php?controller=programa&action=update" method="POST" class="form">
                    <input type="hidden" name="prog_codigo" value="<?= htmlspecialchars($programa->getProgCodigo()) ?>">
                    
                    <div class="form-group">
                        <label for="prog_denominacion">Denominación:</label>
                        <input type="text" id="prog_denominacion" name="prog_denominacion" 
                               value="<?= htmlspecialchars($programa->getProgDenominacion()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="tit_id">ID Título:</label>
                        <input type="number" id="tit_id" name="tit_id" 
                               value="<?= htmlspecialchars($programa->getTitId()) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="prog_tipo">Tipo de Programa:</label>
                        <select id="prog_tipo" name="prog_tipo" required>
                            <option value="Técnico" <?= $programa->getProgTipo() == 'Técnico' ? 'selected' : '' ?>>Técnico</option>
                            <option value="Tecnólogo" <?= $programa->getProgTipo() == 'Tecnólogo' ? 'selected' : '' ?>>Tecnólogo</option>
                            <option value="Especialización" <?= $programa->getProgTipo() == 'Especialización' ? 'selected' : '' ?>>Especialización</option>
                            <option value="Complementario" <?= $programa->getProgTipo() == 'Complementario' ? 'selected' : '' ?>>Complementario</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar Programa</button>
                        <a href="index.php?controller=programa&action=index" class="btn btn-secondary">Cancelar</a>
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