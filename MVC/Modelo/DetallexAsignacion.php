<?php
class DetallexAsignacion
{
    private $detalle_id;
    private $asig_id;
    private $fich_id;
    private $amb_id;
    private $comp_id;

    public function __construct($detalle_id, $asig_id, $fich_id, $amb_id, $comp_id)
    {
        $this->detalle_id = $detalle_id;
        $this->asig_id = $asig_id;
        $this->fich_id = $fich_id;
        $this->amb_id = $amb_id;
        $this->comp_id = $comp_id;
    }

    // Getters
    public function getDetalleId() { return $this->detalle_id; }
    public function getAsigId() { return $this->asig_id; }
    public function getFichId() { return $this->fich_id; }
    public function getAmbId() { return $this->amb_id; }
    public function getCompId() { return $this->comp_id; }

    // Setters
    public function setDetalleId($detalle_id) { $this->detalle_id = $detalle_id; }
    public function setAsigId($asig_id) { $this->asig_id = $asig_id; }
    public function setFichId($fich_id) { $this->fich_id = $fich_id; }
    public function setAmbId($amb_id) { $this->amb_id = $amb_id; }
    public function setCompId($comp_id) { $this->comp_id = $comp_id; }

    // CRUD
    public static function save($detalle)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO detalle_asignacion (ASIGNACION_asig_id, FICHA_fich_id, AMBIENTE_amb_id, COMPETENCIA_comp_id)
                 VALUES (:asig_id, :fich_id, :amb_id, :comp_id)'
            );
            $insert->bindValue('asig_id', $detalle->getAsigId());
            $insert->bindValue('fich_id', $detalle->getFichId());
            $insert->bindValue('amb_id', $detalle->getAmbId());
            $insert->bindValue('comp_id', $detalle->getCompId());
            $insert->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en DetallexAsignacion::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM detalle_asignacion');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new DetallexAsignacion(
                    $row['detalle_id'],
                    $row['ASIGNACION_asig_id'],
                    $row['FICHA_fich_id'],
                    $row['AMBIENTE_amb_id'],
                    $row['COMPETENCIA_comp_id']
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en DetallexAsignacion::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($detalle_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM detalle_asignacion WHERE detalle_id = :detalle_id');
            $select->bindValue('detalle_id', $detalle_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new DetallexAsignacion(
                    $row['detalle_id'],
                    $row['ASIGNACION_asig_id'],
                    $row['FICHA_fich_id'],
                    $row['AMBIENTE_amb_id'],
                    $row['COMPETENCIA_comp_id']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en DetallexAsignacion::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function delete($detalle_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM detalle_asignacion WHERE detalle_id = :detalle_id');
            $delete->bindValue('detalle_id', $detalle_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en DetallexAsignacion::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
