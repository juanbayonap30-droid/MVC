<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Editar Ficha</h2>
            <div class="header-actions">
                <a href="index.php?controller=ficha&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Modificar Datos de la Ficha</h3>
                </div>

                <form action="index.php?controller=ficha&action=update" method="POST" class="form">
                    <input type="hidden" name="fich_id" value="<?= htmlspecialchars($ficha->getFichId()) ?>">
                    
                    <div class="form-group">
                        <label for="prog_id">ID Programa:</label>
                        <select id="prog_id" name="prog_id" required>
                            <option value="">Seleccione un programa...</option>
                            <?php if (!empty($programas)): ?>
                                <?php foreach ($programas as $programa): ?>
                                    <option value="<?= htmlspecialchars($programa->getProgId()) ?>" 
                                            <?= $ficha->getProgId() == $programa->getProgId() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($programa->getProgId()) ?> - <?= htmlspecialchars($programa->getProgNombre()) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inst_id_lider">ID Instructor Líder:</label>
                        <select id="inst_id_lider" name="inst_id_lider" required>
                            <option value="">Seleccione un instructor...</option>
                            <?php if (!empty($instructores)): ?>
                                <?php foreach ($instructores as $instructor): ?>
                                    <option value="<?= htmlspecialchars($instructor->getInstId()) ?>"
                                            <?= $ficha->getInstIdLider() == $instructor->getInstId() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($instructor->getInstNombre()) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fich_jornada">Jornada:</label>
                        <select id="fich_jornada" name="fich_jornada" required>
                            <option value="Mañana" <?= $ficha->getFichJornada() == 'Mañana' ? 'selected' : '' ?>>Mañana</option>
                            <option value="Tarde" <?= $ficha->getFichJornada() == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                            <option value="Noche" <?= $ficha->getFichJornada() == 'Noche' ? 'selected' : '' ?>>Noche</option>
                            <option value="Mixta" <?= $ficha->getFichJornada() == 'Mixta' ? 'selected' : '' ?>>Mixta</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Actualizar Ficha</button>
                        <a href="index.php?controller=ficha&action=index" class="btn btn-secondary">Cancelar</a>
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