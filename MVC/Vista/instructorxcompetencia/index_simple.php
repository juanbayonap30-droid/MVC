<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor por Competencia - SENA</title>
    <link rel="stylesheet" href="assets/css/sena-style.css">
</head>
<body>
    <h1>Test Vista Simple</h1>
    <p>Si ves esto, la vista funciona</p>
    
    <?php
    echo "<p>Relaciones: " . (isset($relaciones) ? count($relaciones) : 'NO DEFINIDO') . "</p>";
    
    if (isset($relaciones) && count($relaciones) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Instructor</th><th>Programa</th><th>Competencia</th></tr>";
        foreach ($relaciones as $rel) {
            echo "<tr>";
            echo "<td>" . $rel->getInscompId() . "</td>";
            echo "<td>" . $rel->getInstId() . "</td>";
            echo "<td>" . $rel->getProgId() . "</td>";
            echo "<td>" . $rel->getCompId() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay relaciones</p>";
    }
    ?>
</body>
</html>
