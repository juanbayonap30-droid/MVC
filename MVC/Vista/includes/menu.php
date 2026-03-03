<nav class="dashboard-nav">
    <ul>
        <li>
            <a href="index.php?controller=instructor&action=index" <?php echo (!isset($_GET['controller']) || $_GET['controller'] == 'instructor') ? 'class="active"' : ''; ?>>
                Instructores
            </a>
        </li>
        <li>
            <a href="index.php?controller=ficha&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'ficha') ? 'class="active"' : ''; ?>>
                Fichas
            </a>
        </li>
        <li>
            <a href="index.php?controller=asignacion&action=index" <?php echo (isset($_GET['controller']) && $_GET['controller'] == 'asignacion') ? 'class="active"' : ''; ?>>
                Asignaciones
            </a>
        </li>
    </ul>
</nav>
