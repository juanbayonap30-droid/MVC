<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ficha - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <style>
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #39A900;
        }
        
        .form-header h3 {
            color: #39A900;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .form-header p {
            color: #666;
            font-size: 0.95rem;
        }
        
        .ficha-id-badge {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            margin-bottom: 1rem;
            border: 2px solid #39A900;
        }
        
        .form-grid {
            display: grid;
            gap: 1.5rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-group label .required {
            color: #e74c3c;
            margin-left: 4px;
        }
        
        .form-group select {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
        }
        
        .form-group select:focus {
            outline: none;
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.1);
        }
        
        .form-group select:hover {
            border-color: #39A900;
        }
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e0e0e0;
        }
        
        .info-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
        }
        
        .info-box p {
            margin: 0;
            color: #856404;
            font-size: 0.9rem;
        }
    </style>
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
            <div class="form-card">
                <div class="form-header">
                    <h3>Modificar Datos de la Ficha</h3>
                    <p>Actualice la información de la ficha de formación</p>
                    <div class="ficha-id-badge">
                        Ficha: <?= htmlspecialchars($ficha->getFichId()) ?>
                    </div>
                </div>

                <div class="info-box">
                    <p><strong>Nota:</strong> El ID de la ficha no puede ser modificado</p>
                </div>

                <form action="index.php?controller=ficha&action=update" method="POST">
                    <input type="hidden" name="fich_id" value="<?= htmlspecialchars($ficha->getFichId()) ?>">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="prog_id">
                                Programa<span class="required">*</span>
                            </label>
                            <select id="prog_id" name="prog_id" required>
                                <option value="">Seleccione un programa</option>
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
                            <label for="inst_id_lider">
                                Instructor Líder<span class="required">*</span>
                            </label>
                            <select id="inst_id_lider" name="inst_id_lider" required>
                                <option value="">Seleccione un instructor</option>
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
                            <label for="fich_jornada">
                                Jornada<span class="required">*</span>
                            </label>
                            <select id="fich_jornada" name="fich_jornada" required>
                                <option value="">Seleccione una jornada</option>
                                <option value="Diurna" <?= $ficha->getFichJornada() == 'Diurna' ? 'selected' : '' ?>>Diurna</option>
                                <option value="Nocturna" <?= $ficha->getFichJornada() == 'Nocturna' ? 'selected' : '' ?>>Nocturna</option>
                                <option value="Mixta" <?= $ficha->getFichJornada() == 'Mixta' ? 'selected' : '' ?>>Mixta</option>
                                <option value="Fin de Semana" <?= $ficha->getFichJornada() == 'Fin de Semana' ? 'selected' : '' ?>>Fin de Semana</option>
                            </select>
                        </div>
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

    <script src="assets/js/sena-enhanced.js?v=<?php echo time(); ?>"></script>
    <script>
        // Validar formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const progId = document.getElementById('prog_id').value;
            const instId = document.getElementById('inst_id_lider').value;
            const jornada = document.getElementById('fich_jornada').value;
            
            if (!progId || !instId || !jornada) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
        });
        
        // Agregar efectos visuales
        document.querySelectorAll('select').forEach(element => {
            element.addEventListener('focus', function() {
                this.style.transform = 'scale(1.01)';
            });
            
            element.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>