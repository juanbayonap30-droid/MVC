<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor por Competencia - SENA</title>
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
            <h2>Instructor por Competencia</h2>
            <div class="header-actions">
                <a href="index.php?controller=instructorxcompetencia&action=create" class="btn btn-primary">+ Nueva Asignacion</a>
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
                    <h3>Lista de Asignaciones</h3>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Instructor</th>
                                <th>Programa</th>
                                <th>Competencia</th>
                                <th>Vigencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($relaciones)): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <p>No hay asignaciones registradas</p>
                                        <a href="index.php?controller=instructorxcompetencia&action=create" class="btn btn-primary">+ Crear Primera Asignacion</a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php 
                                require_once 'MVC/Modelo/Instructor.php';
                                require_once 'MVC/Modelo/Programa.php';
                                require_once 'MVC/Modelo/Competencia.php';
                                foreach ($relaciones as $relacion): 
                                    $instructor = Instructor::searchById($relacion->getInstId());
                                    $programa = Programa::searchById($relacion->getProgId());
                                    $competencia = Competencia::searchById($relacion->getCompId());
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($relacion->getInscompId()) ?></td>
                                    <td><?= $instructor ? htmlspecialchars($instructor->getInstNombre()) : 'N/A' ?></td>
                                    <td><?= $programa ? htmlspecialchars($programa->getProgNombre()) : 'N/A' ?></td>
                                    <td><?= $competencia ? htmlspecialchars($competencia->getCompNombre()) : 'N/A' ?></td>
                                    <td><?= $relacion->getInscompVigencia() ? htmlspecialchars($relacion->getInscompVigencia()) : 'N/A' ?></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="index.php?controller=instructorxcompetencia&action=delete&id=<?= $relacion->getInscompId() ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Esta seguro de eliminar esta asignacion?')">Eliminar</a>
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
