<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Relación - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: 500;
        }
        .alert-error {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33;
        }
        .alert-success {
            background-color: #efe;
            border: 1px solid #cfc;
            color: #3c3;
        }
    </style>
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Nueva Relación Competencia-Programa</h2>
            <div class="header-actions">
                <a href="index.php?controller=competenciaxprograma&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo htmlspecialchars($_SESSION['success']); 
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3>Asignar Competencia a Programa</h3>
                </div>

                <form action="index.php?controller=competenciaxprograma&action=store" method="POST" class="form">
                    <div class="form-group">
                        <label for="prog_id">Programa:</label>
                        <select id="prog_id" name="prog_id" required>
                            <option value="">Seleccione un programa</option>
                            <?php
                            require_once 'MVC/Modelo/Programa.php';
                            $programas = Programa::all();
                            foreach ($programas as $programa): ?>
                                <option value="<?= $programa->getProgId() ?>">
                                    <?= htmlspecialchars($programa->getProgNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comp_id">Competencia:</label>
                        <select id="comp_id" name="comp_id" required>
                            <option value="">Seleccione una competencia</option>
                            <?php
                            require_once 'MVC/Modelo/Competencia.php';
                            $competencias = Competencia::all();
                            foreach ($competencias as $competencia): ?>
                                <option value="<?= $competencia->getCompId() ?>">
                                    <?= htmlspecialchars($competencia->getCompNombre()) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Crear Relación</button>
                        <a href="index.php?controller=competenciaxprograma&action=index" class="btn btn-secondary">Cancelar</a>
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
        // Validación del formulario
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const progSelect = document.getElementById('prog_id');
            const compSelect = document.getElementById('comp_id');
            
            // Verificar que los selects tengan opciones
            console.log('Programas disponibles:', progSelect.options.length - 1);
            console.log('Competencias disponibles:', compSelect.options.length - 1);
            
            if (progSelect.options.length <= 1) {
                alert('No hay programas disponibles. Por favor, cree programas primero.');
            }
            
            if (compSelect.options.length <= 1) {
                alert('No hay competencias disponibles. Por favor, cree competencias primero.');
            }
            
            form.addEventListener('submit', function(e) {
                const progId = progSelect.value;
                const compId = compSelect.value;
                
                if (!progId || progId === '') {
                    e.preventDefault();
                    alert('Por favor seleccione un programa');
                    progSelect.focus();
                    return false;
                }
                
                if (!compId || compId === '') {
                    e.preventDefault();
                    alert('Por favor seleccione una competencia');
                    compSelect.focus();
                    return false;
                }
                
                console.log('Formulario válido. Enviando:', {
                    progId: progId,
                    compId: compId,
                    action: form.action
                });
                
                return true;
            });
        });
    </script>
</body>
</html>
