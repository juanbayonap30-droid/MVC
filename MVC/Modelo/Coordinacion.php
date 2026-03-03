<?php
class Coordinacion
{
    private $coord_id;
    private $coord_descripcion;
    private $coord_nombre_coordinador;
    private $coord_correo;
    private $coord_password;

    public function __construct($coord_id, $coord_descripcion, $coord_nombre_coordinador, $coord_correo, $coord_password = null)
    {
        $this->coord_id = $coord_id;
        $this->coord_descripcion = $coord_descripcion;
        $this->coord_nombre_coordinador = $coord_nombre_coordinador;
        $this->coord_correo = $coord_correo;
        $this->coord_password = $coord_password;
    }

    // Getters
    public function getCoordId() { return $this->coord_id; }
    public function getCoordDescripcion() { return $this->coord_descripcion; }
    public function getCoordNombreCoordinador() { return $this->coord_nombre_coordinador; }
    public function getCoordCorreo() { return $this->coord_correo; }
    public function getCoordPassword() { return $this->coord_password; }

    // Setters
    public function setCoordId($coord_id) { $this->coord_id = $coord_id; }
    public function setCoordDescripcion($coord_descripcion) { $this->coord_descripcion = $coord_descripcion; }
    public function setCoordNombreCoordinador($coord_nombre_coordinador) { $this->coord_nombre_coordinador = $coord_nombre_coordinador; }
    public function setCoordCorreo($coord_correo) { $this->coord_correo = $coord_correo; }
    public function setCoordPassword($coord_password) { $this->coord_password = $coord_password; }

    // CRUD
    public static function save($coordinacion)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO coordinacion (coord_id, coord_descripcion, coord_nombre_coordinador, coord_correo, coord_password)
                 VALUES (:coord_id, :coord_descripcion, :coord_nombre_coordinador, :coord_correo, :coord_password)'
            );
            $insert->bindValue('coord_id', $coordinacion->getCoordId());
            $insert->bindValue('coord_descripcion', $coordinacion->getCoordDescripcion());
            $insert->bindValue('coord_nombre_coordinador', $coordinacion->getCoordNombreCoordinador());
            $insert->bindValue('coord_correo', $coordinacion->getCoordCorreo());
            $insert->bindValue('coord_password', $coordinacion->getCoordPassword());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en Coordinacion::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM coordinacion');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Coordinacion(
                    $row['coord_id'],
                    $row['coord_descripcion'],
                    $row['coord_nombre_coordinador'],
                    $row['coord_correo'],
                    $row['coord_password'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Coordinacion::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($coord_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM coordinacion WHERE coord_id = :coord_id');
            $select->bindValue('coord_id', $coord_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Coordinacion(
                    $row['coord_id'],
                    $row['coord_descripcion'],
                    $row['coord_nombre_coordinador'],
                    $row['coord_correo'],
                    $row['coord_password'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Coordinacion::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function update($coordinacion)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE coordinacion
                 SET coord_descripcion = :coord_descripcion,
                     coord_nombre_coordinador = :coord_nombre_coordinador,
                     coord_correo = :coord_correo
                 WHERE coord_id = :coord_id'
            );
            $update->bindValue('coord_descripcion', $coordinacion->getCoordDescripcion());
            $update->bindValue('coord_nombre_coordinador', $coordinacion->getCoordNombreCoordinador());
            $update->bindValue('coord_correo', $coordinacion->getCoordCorreo());
            $update->bindValue('coord_id', $coordinacion->getCoordId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Coordinacion::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($coord_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM coordinacion WHERE coord_id = :coord_id');
            $delete->bindValue('coord_id', $coord_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Coordinacion::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
