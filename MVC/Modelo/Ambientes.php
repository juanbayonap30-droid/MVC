<?php
class Ambiente
{
    private $amb_id;
    private $amb_nombre;
    private $sede_id;

    public function __construct($amb_id, $amb_nombre, $sede_id)
    {
        $this->amb_id = $amb_id;
        $this->amb_nombre = $amb_nombre;
        $this->sede_id = $sede_id;
    }

    // Getters
    public function getAmbId() { return $this->amb_id; }
    public function getAmbNombre() { return $this->amb_nombre; }
    public function getSedeId() { return $this->sede_id; }

    // Setters
    public function setAmbId($amb_id) { $this->amb_id = $amb_id; }
    public function setAmbNombre($amb_nombre) { $this->amb_nombre = $amb_nombre; }
    public function setSedeId($sede_id) { $this->sede_id = $sede_id; }

    // CRUD
    public static function save($ambiente)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO ambiente (amb_id, amb_nombre, SEDE_sede_id)
                 VALUES (:amb_id, :amb_nombre, :sede_id)'
            );
            $insert->bindValue('amb_id', $ambiente->getAmbId());
            $insert->bindValue('amb_nombre', $ambiente->getAmbNombre());
            $insert->bindValue('sede_id', $ambiente->getSedeId());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en Ambiente::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM ambiente');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Ambiente(
                    $row['amb_id'],
                    $row['amb_nombre'],
                    $row['SEDE_sede_id']
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Ambiente::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($amb_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM ambiente WHERE amb_id = :amb_id');
            $select->bindValue('amb_id', $amb_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Ambiente(
                    $row['amb_id'],
                    $row['amb_nombre'],
                    $row['SEDE_sede_id']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Ambiente::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function update($ambiente)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE ambiente
                 SET amb_nombre = :amb_nombre,
                     SEDE_sede_id = :sede_id
                 WHERE amb_id = :amb_id'
            );
            $update->bindValue('amb_nombre', $ambiente->getAmbNombre());
            $update->bindValue('sede_id', $ambiente->getSedeId());
            $update->bindValue('amb_id', $ambiente->getAmbId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Ambiente::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($amb_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM ambiente WHERE amb_id = :amb_id');
            $delete->bindValue('amb_id', $amb_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Ambiente::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
