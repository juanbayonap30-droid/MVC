<aside class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <img src="assets/images/logo-sena.png" alt="Logo SENA" style="width: 50px; height: 50px; object-fit: contain;">
        </div>
        <div class="sidebar-title">
            <h1>Asignación de<br>Transversales</h1>
            <p>SENA</p>
        </div>
    </div>
    
    <div class="sidebar-user">
        <div class="sidebar-user-icon">
            <?php 
            $rol = $_SESSION['user_rol'] ?? '';
            if ($rol === 'coordinador') {
                echo '👨‍💼';
            } elseif ($rol === 'centro') {
                echo '🏢';
            } else {
                echo '👨‍🏫';
            }
            ?>
        </div>
        <div class="sidebar-user-info">
            <p><strong><?php echo htmlspecialchars($_SESSION['user_nombre'] ?? 'Usuario'); ?></strong></p>
            <small style="opacity: 0.9;"><?php echo ucfirst($_SESSION['user_rol'] ?? 'Invitado'); ?></small>
        </div>
    </div>
    
    <nav class="sidebar-menu">
        <div class="sidebar-menu-label">MENÚ PRINCIPAL</div>
        <ul>
            <?php 
            $rol = $_SESSION['user_rol'] ?? '';
            ?>
            
            <?php if ($rol === 'centro'): ?>
                <!-- MENÚ CENTRO DE FORMACIÓN -->
                <li>
                    <a href="index.php?controller=coordinacion&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'coordinacion') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">🏢</span>
                        <span>Coordinaciones</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=ambiente&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'ambiente') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">📦</span>
                        <span>Ambientes</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=programa&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'programa') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">🎓</span>
                        <span>Programas</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=instructor&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'instructor') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">👨‍🏫</span>
                        <span>Instructores</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=competencia&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'competencia') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">⚙️</span>
                        <span>Competencias</span>
                    </a>
                </li>
            
            <?php elseif ($rol === 'coordinador'): ?>
                <!-- MENÚ COORDINADOR -->
                <li>
                    <a href="index.php?controller=competenciaxprograma&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'competenciaxprograma') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">🔗</span>
                        <span>Comp x Program</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=ficha&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'ficha') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">📁</span>
                        <span>Fichas</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=instructorxcompetencia&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'instructorxcompetencia') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">👨‍🏫</span>
                        <span>Instructor x Competencia</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=asignacion&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'asignacion') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">📅</span>
                        <span>Asignación (prog)</span>
                    </a>
                </li>
            
            <?php elseif ($rol === 'instructor'): ?>
                <!-- MENÚ INSTRUCTOR -->
                <li>
                    <a href="index.php?controller=asignacion&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'asignacion') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">📅</span>
                        <span>Mis Asignaciones</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?controller=instructor&action=profile" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'instructor' && isset($_GET['action']) && $_GET['action'] == 'profile') ? 'class="active"' : ''; ?>>
                        <span class="sidebar-menu-icon">👤</span>
                        <span>Mi Perfil</span>
                    </a>
                </li>
            
            <?php else: ?>
                <!-- MENÚ POR DEFECTO -->
                <li>
                    <a href="index.php?controller=asignacion&action=index">
                        <span class="sidebar-menu-icon">📅</span>
                        <span>Asignaciones</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
        
    </nav>
    
    <div class="sidebar-footer">
        <a href="index.php?controller=auth&action=logout">
            <span class="sidebar-menu-icon">🚪</span>
            <span>Cerrar Sesión</span>
        </a>
    </div>
</aside>
