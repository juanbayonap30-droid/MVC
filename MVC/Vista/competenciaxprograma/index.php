<?php
// Habilitar errores temporalmente para debug
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competencias por Programa - SENA</title>
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
            <h2>Competencias por Programa</h2>
            <div class="header-actions">
                <a href="index.php?controller=competenciaxprograma&action=create" class="btn btn-primary">+ Nueva Relación</a>
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
                    <h3>Lista de Relaciones</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Competencia</th>
                                <th>Programa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($relaciones)): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <p>🔗 No hay relaciones registradas</p>
                                        <a href="index.php?controller=competenciaxprograma&action=create" class="btn btn-primary">+ Crear Primera Relación</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php 
                                require_once 'MVC/Modelo/Competencia.php';
                                require_once 'MVC/Modelo/Programa.php';
                                foreach ($relaciones as $relacion): 
                                    $competencia = Competencia::searchById($relacion->getCompId());
                                    $programa = Programa::searchById($relacion->getProgId());
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($relacion->getCompxProgId()) ?></td>
                                    <td><?= $competencia ? htmlspecialchars($competencia->getCompNombre()) : 'N/A' ?></td>
                                    <td><?= $programa ? htmlspecialchars($programa->getProgNombre()) : 'N/A' ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="index.php?controller=competenciaxprograma&action=delete&id=<?= $relacion->getCompxProgId() ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('¿Está seguro de eliminar esta relación?')">Eliminar</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <footer class="footer-sena">
            <p>&copy; <?php echo date('Y'); ?> SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>
    <script src="assets/js/sena-enhanced.js?v=<?php echo time(); ?>"></script>
</body>
</html>
