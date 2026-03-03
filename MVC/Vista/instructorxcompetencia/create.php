<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Asignación - SENA</title>
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
        
        .form-group select,
        .form-group input[type="date"] {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            background: white;
        }
        
        .form-group select:focus,
        .form-group input[type="date"]:focus {
            outline: none;
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.1);
        }
        
        .form-group select:hover,
        .form-group input[type="date"]:hover {
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
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .info-box {
            background: #e8f5e9;
            border-left: 4px solid #39A900;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
        }
        
        .info-box p {
            margin: 0;
            color: #2e7d32;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Nueva Asignación Instructor-Competencia</h2>
            <div class="header-actions">
                <a href="index.php?controller=instructorxcompetencia&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php 
                    echo htmlspecialchars($_SESSION['success']); 
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php 
                    echo htmlspecialchars($_SESSION['error']); 
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="form-card">
                <div class="form-header">
                    <h3>Asignar Competencia a Instructor</h3>
                    <p>Complete el formulario para crear una nueva asignación</p>
                </div>

                <div class="info-box">
                    <p><strong>Nota:</strong> La combinación de Programa y Competencia debe existir previamente en "Comp x Program"</p>
                </div>

                <form action="index.php?controller=instructorxcompetencia&action=store" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="inst_id">
                                Instructor<span class="required">*</span>
                            </label>
                            <select id="inst_id" name="inst_id" required>
                                <option value="">Seleccione un instructor</option>
                                <?php
                                require_once 'MVC/Modelo/Instructor.php';
                                $instructores = Instructor::all();
                                foreach ($instructores as $instructor): ?>
                                    <option value="<?= $instructor->getInstId() ?>">
                                        <?= htmlspecialchars($instructor->getInstNombre()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prog_id">
                                Programa<span class="required">*</span>
                            </label>
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
                            <label for="comp_id">
                                Competencia<span class="required">*</span>
                            </label>
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

                        <div class="form-group">
                            <label for="inscomp_vigencia">
                                Fecha de Vigencia (Opcional)
                            </label>
                            <input type="date" id="inscomp_vigencia" name="inscomp_vigencia">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Crear Asignación</button>
                        <a href="index.php?controller=instructorxcompetencia&action=index" class="btn btn-secondary">Cancelar</a>
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
        // Validar formulario antes de enviar
        document.querySelector('form').addEventListener('submit', function(e) {
            const instId = document.getElementById('inst_id').value;
            const progId = document.getElementById('prog_id').value;
            const compId = document.getElementById('comp_id').value;
            
            if (!instId || !progId || !compId) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
        });
        
        // Agregar efecto de ripple a los selects
        document.querySelectorAll('select, input[type="date"]').forEach(element => {
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
