<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Asignación - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css">
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header class="header-sena">
            <h2>Crear Nueva Asignación</h2>
        </header>

        <div class="container">
            <div class="card">
            <div class="card-header">
                <h2>Formulario de Registro</h2>
            </div>
            
            <form action="index.php?controller=asignacion&action=store" method="POST">
                <div class="form-group">
                    <label for="asig_id">ID Asignación:</label>
                    <input type="number" id="asig_id" name="asig_id" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="inst_id">ID Instructor:</label>
                    <input type="number" id="inst_id" name="inst_id" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="asig_fecha_ini">Fecha y Hora de Inicio:</label>
                    <input type="datetime-local" id="asig_fecha_ini" name="asig_fecha_ini" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="asig_fecha_fin">Fecha y Hora de Finalización:</label>
                    <input type="datetime-local" id="asig_fecha_fin" name="asig_fecha_fin" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="fich_id">ID Ficha:</label>
                    <input type="number" id="fich_id" name="fich_id" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="amb_id">ID Ambiente:</label>
                    <input type="text" id="amb_id" name="amb_id" maxlength="5" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="comp_id">ID Competencia:</label>
                    <input type="number" id="comp_id" name="comp_id" class="form-control" required>
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-success">Guardar Asignación</button>
                    <a href="index.php?controller=asignacion&action=index" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer-sena">
        <p>&copy; <?php echo date('Y'); ?> SENA - Servicio Nacional de Aprendizaje</p>
    </footer>
</body>
</html>
