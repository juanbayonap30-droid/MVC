<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sena-style-enhanced.css?v=<?php echo time(); ?>">
    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--sena-verde) 0%, var(--sena-verde-oscuro) 100%);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 30px;
            color: white;
            box-shadow: 0 8px 24px rgba(57, 169, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 4s ease-in-out infinite;
        }

        .profile-header-content {
            display: flex;
            align-items: center;
            gap: 30px;
            position: relative;
            z-index: 1;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border: 4px solid rgba(255,255,255,0.3);
        }

        .profile-info h1 {
            margin: 0 0 10px 0;
            font-size: 2rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .profile-info p {
            margin: 0;
            opacity: 0.95;
            font-size: 1.1rem;
        }

        .profile-stats {
            display: flex;
            gap: 30px;
            margin-top: 20px;
        }

        .profile-stat {
            background: rgba(255,255,255,0.2);
            padding: 12px 24px;
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .profile-stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            display: block;
        }

        .profile-stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .profile-section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .profile-section h3 {
            color: var(--sena-verde-oscuro);
            margin: 0 0 25px 0;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-section h3::before {
            content: '';
            width: 4px;
            height: 24px;
            background: var(--sena-verde);
            border-radius: 2px;
        }

        .info-row {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(57, 169, 0, 0.1) 0%, rgba(57, 169, 0, 0.05) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 15px;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 1rem;
            color: #333;
            font-weight: 500;
        }

        .edit-button {
            background: none;
            border: none;
            color: var(--sena-verde);
            cursor: pointer;
            font-size: 20px;
            padding: 5px;
            transition: all 0.3s ease;
        }

        .edit-button:hover {
            transform: scale(1.2);
            color: var(--sena-verde-oscuro);
        }

        .password-section {
            grid-column: 1 / -1;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group-modern {
            margin-bottom: 0;
        }

        .form-group-modern label {
            display: block;
            color: var(--sena-verde-oscuro);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-group-modern input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-group-modern input:focus {
            border-color: var(--sena-verde);
            box-shadow: 0 0 0 4px rgba(57, 169, 0, 0.1);
            background: white;
            outline: none;
        }

        .form-actions-modern {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-header-content {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                flex-direction: column;
                gap: 15px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .password-section {
                grid-column: 1;
            }
        }
    </style>
</head>
<body>
    <?php include 'MVC/Vista/includes/sidebar.php'; ?>
    
    <div class="main-content">
        <div class="profile-container">
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

            <!-- Header del Perfil -->
            <div class="profile-header">
                <div class="profile-header-content">
                    <div class="profile-avatar">
                        <img src="assets/images/logo-sena.png" alt="Logo SENA" style="width: 80px; height: 80px; object-fit: contain;">
                    </div>
                    <div class="profile-info">
                        <h1><?= htmlspecialchars($instructor->getInstNombre()) ?></h1>
                        <p>📧 <?= htmlspecialchars($instructor->getInstCorreo()) ?></p>
                        <div class="profile-stats">
                            <div class="profile-stat">
                                <span class="profile-stat-value">ID: <?= htmlspecialchars($instructor->getInstId()) ?></span>
                                <span class="profile-stat-label">Identificación</span>
                            </div>
                            <div class="profile-stat">
                                <span class="profile-stat-value">📞 <?= htmlspecialchars($instructor->getInstTelefono()) ?></span>
                                <span class="profile-stat-label">Teléfono</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="index.php?controller=instructor&action=updateProfile" method="POST">
                <div class="profile-grid">
                    <!-- Información Personal -->
                    <div class="profile-section">
                        <h3>Información Personal</h3>
                        
                        <div class="form-row">
                            <div class="form-group-modern">
                                <label for="inst_nombres">Nombres</label>
                                <input type="text" id="inst_nombres" name="inst_nombres" 
                                       value="<?= htmlspecialchars($instructor->getInstNombres()) ?>" required>
                            </div>
                            <div class="form-group-modern">
                                <label for="inst_apellidos">Apellidos</label>
                                <input type="text" id="inst_apellidos" name="inst_apellidos" 
                                       value="<?= htmlspecialchars($instructor->getInstApellidos()) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group-modern">
                                <label for="inst_correo">Correo Electrónico</label>
                                <input type="email" id="inst_correo" name="inst_correo" 
                                       value="<?= htmlspecialchars($instructor->getInstCorreo()) ?>" required>
                            </div>
                            <div class="form-group-modern">
                                <label for="inst_telefono">Teléfono</label>
                                <input type="tel" id="inst_telefono" name="inst_telefono" 
                                       value="<?= htmlspecialchars($instructor->getInstTelefono()) ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Vista de Información (Solo lectura visual) -->
                    <div class="profile-section">
                        <h3>Resumen de Datos</h3>
                        
                        <div class="info-row">
                            <div class="info-icon">👤</div>
                            <div class="info-content">
                                <div class="info-label">Nombre Completo</div>
                                <div class="info-value"><?= htmlspecialchars($instructor->getInstNombre()) ?></div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">📧</div>
                            <div class="info-content">
                                <div class="info-label">Correo Electrónico</div>
                                <div class="info-value"><?= htmlspecialchars($instructor->getInstCorreo()) ?></div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">📱</div>
                            <div class="info-content">
                                <div class="info-label">Teléfono de Contacto</div>
                                <div class="info-value"><?= htmlspecialchars($instructor->getInstTelefono()) ?></div>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">🆔</div>
                            <div class="info-content">
                                <div class="info-label">ID de Instructor</div>
                                <div class="info-value"><?= htmlspecialchars($instructor->getInstId()) ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Cambiar Contraseña -->
                    <div class="profile-section password-section">
                        <h3>🔒 Cambiar Contraseña (Opcional)</h3>
                        
                        <div class="form-row">
                            <div class="form-group-modern">
                                <label for="current_password">Contraseña Actual</label>
                                <input type="password" id="current_password" name="current_password" 
                                       placeholder="Dejar en blanco si no desea cambiar">
                            </div>
                            <div class="form-group-modern">
                                <label for="new_password">Nueva Contraseña</label>
                                <input type="password" id="new_password" name="new_password" 
                                       placeholder="Mínimo 6 caracteres">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group-modern">
                                <label for="confirm_password">Confirmar Nueva Contraseña</label>
                                <input type="password" id="confirm_password" name="confirm_password" 
                                       placeholder="Repetir nueva contraseña">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions-modern">
                    <a href="index.php?controller=asignacion&action=index" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                </div>
            </form>
        </div>

        <footer class="footer-sena">
            <p>&copy; <?php echo date('Y'); ?> SENA - Servicio Nacional de Aprendizaje</p>
        </footer>
    </div>

    <script src="assets/js/sena-enhanced.js?v=<?php echo time(); ?>"></script>
    <script>
        // Validar que las contraseñas coincidan
        document.querySelector('form').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const currentPassword = document.getElementById('current_password').value;
            
            if (newPassword || confirmPassword || currentPassword) {
                if (!currentPassword) {
                    e.preventDefault();
                    alert('Debe ingresar su contraseña actual para cambiarla');
                    return false;
                }
                
                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('Las contraseñas nuevas no coinciden');
                    return false;
                }
                
                if (newPassword.length < 6) {
                    e.preventDefault();
                    alert('La nueva contraseña debe tener al menos 6 caracteres');
                    return false;
                }
            }
        });

        // Actualizar resumen en tiempo real
        const updateSummary = () => {
            const nombres = document.getElementById('inst_nombres').value;
            const apellidos = document.getElementById('inst_apellidos').value;
            const correo = document.getElementById('inst_correo').value;
            const telefono = document.getElementById('inst_telefono').value;

            document.querySelectorAll('.info-value')[0].textContent = `${nombres} ${apellidos}`;
            document.querySelectorAll('.info-value')[1].textContent = correo;
            document.querySelectorAll('.info-value')[2].textContent = telefono;
        };

        document.getElementById('inst_nombres').addEventListener('input', updateSummary);
        document.getElementById('inst_apellidos').addEventListener('input', updateSummary);
        document.getElementById('inst_correo').addEventListener('input', updateSummary);
        document.getElementById('inst_telefono').addEventListener('input', updateSummary);
    </script>
</body>
</html>
