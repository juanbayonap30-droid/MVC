<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Ambiente - SENA</title>
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
        
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e0e0e0;
        }
        
        .info-box {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
        }
        
        .info-box p {
            margin: 0;
            color: #1565c0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Crear Nuevo Ambiente</h2>
            <div class="header-actions">
                <a href="index.php?controller=ambiente&action=index" class="btn btn-secondary">← Volver</a>
            </div>
        </header>

        <div class="container">
            <div class="form-card">
                <div class="form-header">
                    <h3>Información del Ambiente</h3>
                    <p>Complete los datos para registrar un nuevo ambiente de formación</p>
                </div>

                <div class="info-box">
                    <p><strong>Nota:</strong> El ID del ambiente debe ser único en el sistema</p>
                </div>

                <form action="index.php?controller=ambiente&action=store" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="amb_id">
                                ID Ambiente<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="amb_id" 
                                name="amb_id" 
                                placeholder="Ej: A101, B205, LAB01"
                                maxlength="5"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="amb_nombre">
                                Nombre del Ambiente<span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="amb_nombre" 
                                name="amb_nombre" 
                                placeholder="Ej: Laboratorio de Sistemas"
                                maxlength="45"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="sede_id">
                                ID Sede<span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="sede_id" 
                                name="sede_id" 
                                placeholder="Ingrese el ID de la sede"
                                min="1"
                                required>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Crear Ambiente</button>
                        <a href="index.php?controller=ambiente&action=index" class="btn btn-secondary">Cancelar</a>
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
            const ambId = document.getElementById('amb_id').value.trim();
            const ambNombre = document.getElementById('amb_nombre').value.trim();
            const sedeId = document.getElementById('sede_id').value;
            
            if (!ambId || !ambNombre || !sedeId) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios');
                return false;
            }
            
            if (ambId.length > 5) {
                e.preventDefault();
                alert('El ID del ambiente no puede tener más de 5 caracteres');
                return false;
            }
        });
        
        // Convertir ID a mayúsculas automáticamente
        document.getElementById('amb_id').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
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
