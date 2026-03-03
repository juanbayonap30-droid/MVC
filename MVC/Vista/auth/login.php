<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - SENA</title>
    <link rel="stylesheet" href="assets/css/auth.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <img src="assets/images/logo-sena.png" alt="Logo SENA" style="width: 80px; height: 80px; object-fit: contain;">
                </div>
                <h1>Bienvenido</h1>
                <p>Sistema de Gestión Académica SENA</p>
            </div>

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

            <form action="index.php?controller=auth&action=authenticate" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="nombre">Nombre de Usuario</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Ingresa tu nombre o correo" 
                           value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                    <small>Ingresa tu nombre, apellido o correo electrónico</small>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn-primary">Iniciar Sesión</button>
            </form>

            <div class="auth-footer">
                <p>¿No tienes cuenta? <a href="index.php?controller=auth&action=register">Regístrate aquí</a></p>
                <p style="margin-top: 10px; font-size: 12px; color: #666;">
                    Usuarios de prueba:<br>
                    Coordinador: "Coordinacion Sistemas" / 123456<br>
                    Instructor: "Carlos" o "Laura" / 123456
                </p>
            </div>
        </div>
    </div>
</body>
</html>
