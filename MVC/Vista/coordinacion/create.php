<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Coordinación - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <style>
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 700px;
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
        
        .form-group input {
            padding: 0.75rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #39A900;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.1);
        }
        
        .form-group input:hover {
            border-color: #39A900;
        }
        
        .form-group small {
            color: #666;
            font-size: 0.85rem;
            margin-top: 0.25rem;
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
            <h2>Nueva Coordinación</h2>
            <div class="header-actions">
                <a href="index.php?controller=coordinacion&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="form-card">
                <div class="form-header">
                    <h3>Registrar Nueva Coordinación</h3>
                    <p>Complete los datos para crear una nueva coordinación</p>
                </div>

                <div class="info-box">
                    <p><strong>Importante:</strong> La contraseña será utilizada para el inicio de sesión de esta coordinación</p>
                </div>

                <form action="index.php?controller=coordinacion&action=store" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="coord_id">
                                ID de Coordinación<span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="coord_id" 
                                name="coord_id" 
                                placeholder="Ingrese el ID"
                                min="1"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="coord_nombre">
                                Nombre de Coordinación<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="coord_nombre" 
                                name="coord_nombre" 
                                placeholder="Ej: Coordinación Sistemas"
                                maxlength="100"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="password">
                                Contraseña<span class="required">*</span>
                            </label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Contraseña de acceso"
                                minlength="6"
                                required>
                            <small>Mínimo 6 caracteres</small>
                        </div>

                        <div class="form-group">
                            <label for="centro_formacion_id">
                                Centro de Formación<span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="centro_formacion_id" 
                                name="centro_formacion_id" 
                                placeholder="ID del centro"
                                value="2"
                                min="1"
                                required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="index.php?controller=coordinacion&action=index" class="btn btn-secondary">Cancelar</a>
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
            const coordId = document.getElementById('coord_id').value;
            const coordNombre = document.getElementById('coord_nombre').value.trim();
            const password = document.getElementById('password').value;
            const centroId = document.getElementById('centro_formacion_id').value;
            
            if (!coordId || !coordNombre || !password || !centroId) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 6 caracteres');
                document.getElementById('password').focus();
                return false;
            }
        });
        
        // Agregar efectos visuales
        document.querySelectorAll('input').forEach(element => {
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
