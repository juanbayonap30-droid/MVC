<?php
class Usuario
{
    private $id;
    private $nombre;
    private $correo;
    private $password;
    private $rol;

    public function __construct($id, $nombre, $correo, $password, $rol)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->rol = $rol;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getCorreo() { return $this->correo; }
    public function getPassword() { return $this->password; }
    public function getRol() { return $this->rol; }

    // Buscar por nombre o correo (usado en login)
    public static function findByNombre($nombreOCorreo)
    {
        try {
            $db = getDB();
            
            // Buscar en instructor (usa inst_password)
            $sql = "SELECT inst_id as id, 
                           CONCAT(inst_nombres, ' ', inst_apellidos) as nombre, 
                           inst_correo as correo, 
                           inst_password as password, 
                           'instructor' as rol 
                    FROM instructor 
                    WHERE (inst_nombres LIKE :busqueda 
                       OR inst_apellidos LIKE :busqueda 
                       OR CONCAT(inst_nombres, ' ', inst_apellidos) LIKE :busqueda
                       OR inst_correo = :correo)
                       AND inst_password IS NOT NULL
                       AND inst_password != ''
                    LIMIT 1";
            
            $stmt = $db->prepare($sql);
            $stmt->bindValue('busqueda', '%' . $nombreOCorreo . '%');
            $stmt->bindValue('correo', $nombreOCorreo);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row && !empty($row['password'])) {
                return new Usuario($row['id'], $row['nombre'], $row['correo'], $row['password'], $row['rol']);
            }
            
            // Buscar en coordinacion (usa password)
            $sql = "SELECT coord_id as id, 
                           coord_nombre_coordinador as nombre, 
                           coord_correo as correo, 
                           password as password, 
                           'coordinador' as rol 
                    FROM coordinacion 
                    WHERE (coord_nombre_coordinador LIKE :busqueda
                       OR coord_correo = :correo)
                       AND password IS NOT NULL
                       AND password != ''
                    LIMIT 1";
            
            $stmt = $db->prepare($sql);
            $stmt->bindValue('busqueda', '%' . $nombreOCorreo . '%');
            $stmt->bindValue('correo', $nombreOCorreo);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row && !empty($row['password'])) {
                return new Usuario($row['id'], $row['nombre'], $row['correo'], $row['password'], $row['rol']);
            }
            
            // Buscar en centro_formacion (usa password)
            $sql = "SELECT cent_id as id, 
                           cent_nombre as nombre, 
                           correo as correo, 
                           password as password, 
                           'centro' as rol 
                    FROM centro_formacion 
                    WHERE (cent_nombre LIKE :busqueda
                       OR correo = :correo)
                       AND password IS NOT NULL
                       AND password != ''
                    LIMIT 1";
            
            $stmt = $db->prepare($sql);
            $stmt->bindValue('busqueda', '%' . $nombreOCorreo . '%');
            $stmt->bindValue('correo', $nombreOCorreo);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row && !empty($row['password'])) {
                return new Usuario($row['id'], $row['nombre'], $row['correo'], $row['password'], $row['rol']);
            }
            
            return null;
        } catch (PDOException $e) {
            error_log("Error en Usuario::findByNombre() - " . $e->getMessage());
            return null;
        }
    }

    // Crear usuario instructor
    public static function createInstructor($nombres, $apellidos, $correo, $telefono, $password)
    {
        try {
            $db = getDB();
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            $insert = $db->prepare(
                'INSERT INTO instructor (inst_nombres, inst_apellidos, inst_correo, inst_telefono, inst_password)
                 VALUES (:nombres, :apellidos, :correo, :telefono, :password)'
            );
            $insert->bindValue('nombres', $nombres);
            $insert->bindValue('apellidos', $apellidos);
            $insert->bindValue('correo', $correo);
            $insert->bindValue('telefono', $telefono);
            $insert->bindValue('password', $hashedPassword);
            $insert->execute();
            
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en Usuario::createInstructor() - " . $e->getMessage());
            throw $e;
        }
    }

    // Crear usuario coordinador
    public static function createCoordinador($nombre, $descripcion, $correo, $password)
    {
        try {
            $db = getDB();
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            $insert = $db->prepare(
                'INSERT INTO coordinacion (coord_nombre_coordinador, coord_descripcion, coord_correo, password)
                 VALUES (:nombre, :descripcion, :correo, :password)'
            );
            $insert->bindValue('nombre', $nombre);
            $insert->bindValue('descripcion', $descripcion);
            $insert->bindValue('correo', $correo);
            $insert->bindValue('password', $hashedPassword);
            $insert->execute();
            
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en Usuario::createCoordinador() - " . $e->getMessage());
            throw $e;
        }
    }

    // Verificar si existe un nombre
    public static function existsByNombre($nombre)
    {
        try {
            $db = getDB();
            
            // Verificar en instructor
            $select = $db->prepare('SELECT COUNT(*) as count FROM instructor WHERE inst_nombres = :nombre OR inst_apellidos = :nombre');
            $select->bindValue('nombre', $nombre);
            $select->execute();
            if ($select->fetch(PDO::FETCH_ASSOC)['count'] > 0) {
                return true;
            }
            
            // Verificar en coordinacion
            $select = $db->prepare('SELECT COUNT(*) as count FROM coordinacion WHERE coord_nombre_coordinador = :nombre');
            $select->bindValue('nombre', $nombre);
            $select->execute();
            if ($select->fetch(PDO::FETCH_ASSOC)['count'] > 0) {
                return true;
            }
            
            return false;
        } catch (PDOException $e) {
            error_log("Error en Usuario::existsByNombre() - " . $e->getMessage());
            return false;
        }
    }
}
?>
