<?php
// Diagnóstico simple para centro de formación
require_once 'config/database.php';

echo "<pre>";
echo "=== DIAGNÓSTICO DE CENTRO DE FORMACIÓN ===\n\n";

try {
    $db = getDB();
    
    // 1. Ver estructura de la tabla
    echo "1. ESTRUCTURA DE LA TABLA:\n";
    $columns = $db->query("SHOW COLUMNS FROM centro_formacion")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        echo "   - {$col['Field']} ({$col['Type']})\n";
    }
    
    echo "\n2. DATOS ACTUALES:\n";
    $data = $db->query("SELECT * FROM centro_formacion")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
        echo "   Centro ID: {$row['cent_id']}\n";
        echo "   Nombre: {$row['cent_nombre']}\n";
        echo "   Correo: " . ($row['correo'] ?? 'NULL') . "\n";
        echo "   Password: " . (empty($row['password']) ? 'VACÍO/NULL' : 'Configurado (' . strlen($row['password']) . ' chars)') . "\n";
        echo "   ---\n";
    }
    
    echo "\n3. INTENTANDO BUSCAR 'Comercio':\n";
    $sql = "SELECT cent_id, cent_nombre, correo, password 
            FROM centro_formacion 
            WHERE cent_nombre LIKE :busqueda";
    $stmt = $db->prepare($sql);
    $stmt->execute(['busqueda' => '%Comercio%']);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        echo "   ✅ Encontrado:\n";
        echo "   - ID: {$result['cent_id']}\n";
        echo "   - Nombre: {$result['cent_nombre']}\n";
        echo "   - Correo: " . ($result['correo'] ?? 'NULL') . "\n";
        echo "   - Password existe: " . (!empty($result['password']) ? 'SÍ' : 'NO') . "\n";
        
        if (!empty($result['password'])) {
            echo "\n4. PROBANDO VERIFICACIÓN DE CONTRASEÑA:\n";
            if (password_verify('123456', $result['password'])) {
                echo "   ✅ La contraseña '123456' es CORRECTA\n";
            } else {
                echo "   ❌ La contraseña '123456' NO coincide\n";
                echo "   Hash en BD: " . substr($result['password'], 0, 60) . "\n";
            }
        }
    } else {
        echo "   ❌ No se encontró ningún centro con 'Comercio' en el nombre\n";
    }
    
    echo "\n5. SOLUCIÓN:\n";
    echo "   Ejecuta este SQL en phpMyAdmin:\n\n";
    $hash = password_hash('123456', PASSWORD_BCRYPT);
    echo "   UPDATE centro_formacion \n";
    echo "   SET correo = 'comercio@sena.edu.co',\n";
    echo "       password = '{$hash}'\n";
    echo "   WHERE cent_id = 1;\n\n";
    echo "   UPDATE centro_formacion \n";
    echo "   SET correo = 'tecnologico@sena.edu.co',\n";
    echo "       password = '{$hash}'\n";
    echo "   WHERE cent_id = 2;\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

echo "</pre>";
?>
