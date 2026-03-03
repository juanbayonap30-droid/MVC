<?php
class Asignacion
{
    private $asig_id;
    private $inst_id;
    private $asig_fecha_ini;
    private $asig_fecha_fin;
    private $fich_id;
    private $amb_id;
    private $comp_id;

    public function __construct($asig_id, $inst_id, $asig_fecha_ini, $asig_fecha_fin, $fich_id = null, $amb_id = null, $comp_id = null)
    {
        $this->asig_id = $asig_id;
        $this->inst_id = $inst_id;
        $this->asig_fecha_ini = $asig_fecha_ini;
        $this->asig_fecha_fin = $asig_fecha_fin;
        $this->fich_id = $fich_id;
        $this->amb_id = $amb_id;
        $this->comp_id = $comp_id;
    }

    // Getters
    public function getAsigId() { return $this->asig_id; }
    public function getInstId() { return $this->inst_id; }
    public function getAsigFechaIni() { return $this->asig_fecha_ini; }
    public function getAsigFechaFin() { return $this->asig_fecha_fin; }
    public function getFichId() { return $this->fich_id; }
    public function getAmbId() { return $this->amb_id; }
    public function getCompId() { return $this->comp_id; }

    // Setters
    public function setAsigId($asig_id) { $this->asig_id = $asig_id; }
    public function setInstId($inst_id) { $this->inst_id = $inst_id; }
    public function setAsigFechaIni($asig_fecha_ini) { $this->asig_fecha_ini = $asig_fecha_ini; }
    public function setAsigFechaFin($asig_fecha_fin) { $this->asig_fecha_fin = $asig_fecha_fin; }
    public function setFichId($fich_id) { $this->fich_id = $fich_id; }
    public function setAmbId($amb_id) { $this->amb_id = $amb_id; }
    public function setCompId($comp_id) { $this->comp_id = $comp_id; }

    // CRUD
    public static function save($asignacion)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO asignacion (INSTRUCTOR_inst_id, asig_fecha_ini, asig_fecha_fin, FICHA_fich_id, AMBIENTE_amb_id, COMPETENCIA_comp_id)
                 VALUES (:inst_id, :asig_fecha_ini, :asig_fecha_fin, :fich_id, :amb_id, :comp_id)'
            );
            $insert->bindValue('inst_id', $asignacion->getInstId());
            $insert->bindValue('asig_fecha_ini', $asignacion->getAsigFechaIni());
            $insert->bindValue('asig_fecha_fin', $asignacion->getAsigFechaFin());
            $insert->bindValue('fich_id', $asignacion->getFichId());
            $insert->bindValue('amb_id', $asignacion->getAmbId());
            $insert->bindValue('comp_id', $asignacion->getCompId());
            $insert->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en Asignacion::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM asignacion');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Asignacion(
                    $row['ASIG_ID'] ?? null,
                    $row['INSTRUCTOR_inst_id'] ?? null,
                    $row['asig_fecha_ini'] ?? null,
                    $row['asig_fecha_fin'] ?? null,
                    $row['FICHA_fich_id'] ?? null,
                    $row['AMBIENTE_amb_id'] ?? null,
                    $row['COMPETENCIA_comp_id'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Asignacion::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($asig_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM asignacion WHERE ASIG_ID = :asig_id');
            $select->bindValue('asig_id', $asig_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Asignacion(
                    $row['ASIG_ID'] ?? null,
                    $row['INSTRUCTOR_inst_id'] ?? null,
                    $row['asig_fecha_ini'] ?? null,
                    $row['asig_fecha_fin'] ?? null,
                    $row['FICHA_fich_id'] ?? null,
                    $row['AMBIENTE_amb_id'] ?? null,
                    $row['COMPETENCIA_comp_id'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Asignacion::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function searchByInstructor($inst_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM asignacion WHERE INSTRUCTOR_inst_id = :inst_id ORDER BY asig_fecha_ini DESC');
            $select->bindValue('inst_id', $inst_id);
            $select->execute();

            $lista = [];
            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Asignacion(
                    $row['ASIG_ID'] ?? null,
                    $row['INSTRUCTOR_inst_id'] ?? null,
                    $row['asig_fecha_ini'] ?? null,
                    $row['asig_fecha_fin'] ?? null,
                    $row['FICHA_fich_id'] ?? null,
                    $row['AMBIENTE_amb_id'] ?? null,
                    $row['COMPETENCIA_comp_id'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Asignacion::searchByInstructor() - " . $e->getMessage());
            return [];
        }
    }

    public static function getByFicha($fich_id)
    {
        try {
            $db = getDB();
            $query = "SELECT a.*, 
                             i.inst_nombres, i.inst_apellidos,
                             amb.amb_nombre,
                             c.comp_nombre_corto
                      FROM asignacion a
                      LEFT JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                      LEFT JOIN ambiente amb ON a.AMBIENTE_amb_id = amb.amb_id
                      LEFT JOIN competencia c ON a.COMPETENCIA_comp_id = c.comp_id
                      WHERE a.FICHA_fich_id = :fich_id
                      ORDER BY a.asig_fecha_ini";
            
            $select = $db->prepare($query);
            $select->bindValue('fich_id', $fich_id);
            $select->execute();

            return $select->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Asignacion::getByFicha() - " . $e->getMessage());
            return [];
        }
    }

    public static function update($asignacion)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE asignacion
                 SET INSTRUCTOR_inst_id = :inst_id,
                     asig_fecha_ini = :asig_fecha_ini,
                     asig_fecha_fin = :asig_fecha_fin,
                     FICHA_fich_id = :fich_id,
                     AMBIENTE_amb_id = :amb_id,
                     COMPETENCIA_comp_id = :comp_id
                 WHERE ASIG_ID = :asig_id'
            );
            $update->bindValue('inst_id', $asignacion->getInstId());
            $update->bindValue('asig_fecha_ini', $asignacion->getAsigFechaIni());
            $update->bindValue('asig_fecha_fin', $asignacion->getAsigFechaFin());
            $update->bindValue('fich_id', $asignacion->getFichId());
            $update->bindValue('amb_id', $asignacion->getAmbId());
            $update->bindValue('comp_id', $asignacion->getCompId());
            $update->bindValue('asig_id', $asignacion->getAsigId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Asignacion::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($asig_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM asignacion WHERE ASIG_ID = :asig_id');
            $delete->bindValue('asig_id', $asig_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Asignacion::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
