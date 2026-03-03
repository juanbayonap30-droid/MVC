<?php
class Instructor
{
    private $inst_id;
    private $inst_nombres;
    private $inst_apellidos;
    private $inst_correo;
    private $inst_telefono;
    private $inst_password;

    public function __construct($inst_id, $inst_nombres, $inst_apellidos, $inst_correo, $inst_telefono, $inst_password = null)
    {
        $this->inst_id = $inst_id;
        $this->inst_nombres = $inst_nombres;
        $this->inst_apellidos = $inst_apellidos;
        $this->inst_correo = $inst_correo;
        $this->inst_telefono = $inst_telefono;
        $this->inst_password = $inst_password;
    }

    // Getters
    public function getInstId() { return $this->inst_id; }
    public function getInstNombre() { return $this->inst_nombres . ' ' . $this->inst_apellidos; }
    public function getInstNombres() { return $this->inst_nombres; }
    public function getInstApellidos() { return $this->inst_apellidos; }
    public function getInstCorreo() { return $this->inst_correo; }
    public function getInstTelefono() { return $this->inst_telefono; }
    public function getInstPassword() { return $this->inst_password; }

    // Setters
    public function setInstId($inst_id) { $this->inst_id = $inst_id; }
    public function setInstNombres($inst_nombres) { $this->inst_nombres = $inst_nombres; }
    public function setInstApellidos($inst_apellidos) { $this->inst_apellidos = $inst_apellidos; }
    public function setInstCorreo($inst_correo) { $this->inst_correo = $inst_correo; }
    public function setInstTelefono($inst_telefono) { $this->inst_telefono = $inst_telefono; }
    public function setInstPassword($inst_password) { $this->inst_password = $inst_password; }

    // CRUD
    public static function save($instructor)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO instructor (inst_id, inst_nombres, inst_apellidos, inst_correo, inst_telefono, inst_password)
                 VALUES (:inst_id, :inst_nombres, :inst_apellidos, :inst_correo, :inst_telefono, :inst_password)'
            );
            $insert->bindValue('inst_id', $instructor->getInstId());
            $insert->bindValue('inst_nombres', $instructor->getInstNombres());
            $insert->bindValue('inst_apellidos', $instructor->getInstApellidos());
            $insert->bindValue('inst_correo', $instructor->getInstCorreo());
            $insert->bindValue('inst_telefono', $instructor->getInstTelefono());
            $insert->bindValue('inst_password', $instructor->getInstPassword());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en Instructor::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM instructor');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Instructor(
                    $row['inst_id'],
                    $row['inst_nombres'],
                    $row['inst_apellidos'],
                    $row['inst_correo'],
                    $row['inst_telefono'],
                    $row['inst_password'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Instructor::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($inst_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM instructor WHERE inst_id = :inst_id');
            $select->bindValue('inst_id', $inst_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Instructor(
                    $row['inst_id'],
                    $row['inst_nombres'],
                    $row['inst_apellidos'],
                    $row['inst_correo'],
                    $row['inst_telefono'],
                    $row['inst_password'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Instructor::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function update($instructor)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE instructor
                 SET inst_nombres = :inst_nombres,
                     inst_apellidos = :inst_apellidos,
                     inst_correo = :inst_correo,
                     inst_telefono = :inst_telefono
                 WHERE inst_id = :inst_id'
            );
            $update->bindValue('inst_nombres', $instructor->getInstNombres());
            $update->bindValue('inst_apellidos', $instructor->getInstApellidos());
            $update->bindValue('inst_correo', $instructor->getInstCorreo());
            $update->bindValue('inst_telefono', $instructor->getInstTelefono());
            $update->bindValue('inst_id', $instructor->getInstId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Instructor::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($inst_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM instructor WHERE inst_id = :inst_id');
            $delete->bindValue('inst_id', $inst_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Instructor::delete() - " . $e->getMessage());
            throw $e;
        }
    }
    
    public static function updatePassword($inst_id, $newPassword)
    {
        try {
            $db = getDB();
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $update = $db->prepare('UPDATE instructor SET inst_password = :password WHERE inst_id = :inst_id');
            $update->bindValue('password', $hashedPassword);
            $update->bindValue('inst_id', $inst_id);
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Instructor::updatePassword() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
