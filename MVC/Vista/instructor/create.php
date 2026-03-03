<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Instructor - SENA</title>
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
            <h2>Crear Nuevo Instructor</h2>
            <div class="header-actions">
                <a href="index.php?controller=instructor&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="form-card">
                <div class="form-header">
                    <h3>Formulario de Registro</h3>
                    <p>Complete los datos para registrar un nuevo instructor</p>
                </div>

                <div class="info-box">
                    <p><strong>Nota:</strong> El ID del instructor debe ser único y corresponder al documento de identidad</p>
                </div>

                <form action="index.php?controller=instructor&action=store" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="inst_id">
                                ID Instructor<span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="inst_id" 
                                name="inst_id" 
                                placeholder="Número de documento"
                                min="1"
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="inst_nombres">
                                Nombres<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="inst_nombres" 
                                name="inst_nombres" 
                                placeholder="Ej: Juan Carlos"
                                maxlength="45" 
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="inst_apellidos">
                                Apellidos<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="inst_apellidos" 
                                name="inst_apellidos" 
                                placeholder="Ej: Pérez García"
                                maxlength="45" 
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="inst_correo">
                                Correo Electrónico<span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="inst_correo" 
                                name="inst_correo" 
                                placeholder="ejemplo@sena.edu.co"
                                maxlength="45" 
                                required>
                        </div>
                        
                        <div class="form-group">
                            <label for="inst_telefono">
                                Teléfono<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="inst_telefono" 
                                name="inst_telefono" 
                                placeholder="3001234567"
                                maxlength="10" 
                                pattern="[0-9]{10}"
                                title="Ingrese 10 dígitos"
                                required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Guardar Instructor</button>
                        <a href="index.php?controller=instructor&action=index" class="btn btn-secondary">Cancelar</a>
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
            const instId = document.getElementById('inst_id').value;
            const nombres = document.getElementById('inst_nombres').value.trim();
            const apellidos = document.getElementById('inst_apellidos').value.trim();
            const correo = document.getElementById('inst_correo').value.trim();
            const telefono = document.getElementById('inst_telefono').value.trim();
            
            if (!instId || !nombres || !apellidos || !correo || !telefono) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
            
            if (telefono.length !== 10 || !/^\d+$/.test(telefono)) {
                e.preventDefault();
                alert('El teléfono debe tener exactamente 10 dígitos');
                document.getElementById('inst_telefono').focus();
                return false;
            }
        });
        
        // Solo permitir números en teléfono
        document.getElementById('inst_telefono').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
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
