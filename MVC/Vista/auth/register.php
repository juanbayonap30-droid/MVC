<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - SENA</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <img src="assets/images/logo-sena.png" alt="Logo SENA" style="width: 80px; height: 80px; object-fit: contain;">
                </div>
                <h1>Crear Cuenta</h1>
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

            <form action="index.php?controller=auth&action=store" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Juan Pérez" 
                           value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="correo@sena.edu.co"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol" required onchange="toggleTelefonoField()">
                        <option value="">Seleccione un rol</option>
                        <option value="coordinador">Coordinador</option>
                        <option value="instructor">Instructor</option>
                    </select>
                    <small>Coordinador: acceso completo | Instructor: solo asignaciones</small>
                </div>

                <div class="form-group" id="telefono-field" style="display: none;">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" placeholder="3001234567">
                    <small>Opcional para instructores</small>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required placeholder="Mínimo 6 caracteres">
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirmar Contraseña</label>
                    <input type="password" id="password_confirm" name="password_confirm" required placeholder="Repita la contraseña">
                </div>

                <button type="submit" class="btn-primary">Registrarse</button>
            </form>

            <div class="auth-footer">
                <p>¿Ya tienes cuenta? <a href="index.php?controller=auth&action=login">Inicia sesión aquí</a></p>
            </div>
        </div>
    </div>

    <script>
        function toggleTelefonoField() {
            const rol = document.getElementById('rol').value;
            const telefonoField = document.getElementById('telefono-field');
            
            if (rol === 'instructor') {
                telefonoField.style.display = 'block';
            } else {
                telefonoField.style.display = 'none';
                document.getElementById('telefono').value = '';
            }
        }
        
        // Mantener el rol seleccionado después de un error
        window.addEventListener('DOMContentLoaded', function() {
            const rolSelect = document.getElementById('rol');
            if (rolSelect.value) {
                toggleTelefonoField();
            }
        });
    </script>
</body>
</html>
