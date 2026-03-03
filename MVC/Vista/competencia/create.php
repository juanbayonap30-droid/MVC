<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Competencia - SENA</title>
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
        
        .form-group input,
        .form-group textarea {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
            font-family: inherit;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.1);
        }
        
        .form-group input:hover,
        .form-group textarea:hover {
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
            <h2>Crear Nueva Competencia</h2>
            <div class="header-actions">
                <a href="index.php?controller=competencia&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="form-card">
                <div class="form-header">
                    <h3>Información de la Competencia</h3>
                    <p>Complete los datos para registrar una nueva competencia</p>
                </div>

                <div class="info-box">
                    <p><strong>Nota:</strong> El ID de la competencia debe ser único en el sistema</p>
                </div>

                <form action="index.php?controller=competencia&action=store" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="comp_id">
                                ID Competencia<span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="comp_id" 
                                name="comp_id" 
                                placeholder="Ingrese el ID de la competencia"
                                min="1"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="comp_nombre_corto">
                                Nombre Corto<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="comp_nombre_corto" 
                                name="comp_nombre_corto" 
                                placeholder="Ej: Programación Web"
                                maxlength="100"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="comp_horas">
                                Horas<span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="comp_horas" 
                                name="comp_horas" 
                                placeholder="Número de horas"
                                min="1"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="comp_nombre_unidad_competencia">
                                Nombre de la Unidad de Competencia<span class="required">*</span>
                            </label>
                            <textarea 
                                id="comp_nombre_unidad_competencia" 
                                name="comp_nombre_unidad_competencia" 
                                placeholder="Descripción completa de la unidad de competencia"
                                rows="4" 
                                required></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Crear Competencia</button>
                        <a href="index.php?controller=competencia&action=index" class="btn btn-secondary">Cancelar</a>
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
            const compId = document.getElementById('comp_id').value;
            const nombreCorto = document.getElementById('comp_nombre_corto').value.trim();
            const horas = document.getElementById('comp_horas').value;
            const nombreUnidad = document.getElementById('comp_nombre_unidad_competencia').value.trim();
            
            if (!compId || !nombreCorto || !horas || !nombreUnidad) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
            
            if (parseInt(horas) < 1) {
                e.preventDefault();
                alert('Las horas deben ser mayor a 0');
                return false;
            }
        });
        
        // Agregar efectos visuales
        document.querySelectorAll('input, textarea').forEach(element => {
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