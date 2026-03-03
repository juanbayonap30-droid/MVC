<?php
class Ficha
{
    private $fich_id;
    private $prog_id;
    private $inst_id_lider;
    private $fich_jornada;

    public function __construct($fich_id, $prog_id, $inst_id_lider, $fich_jornada)
    {
        $this->fich_id = $fich_id;
        $this->prog_id = $prog_id;
        $this->inst_id_lider = $inst_id_lider;
        $this->fich_jornada = $fich_jornada;
    }

    // Getters
    public function getFichId() { return $this->fich_id; }
    public function getProgId() { return $this->prog_id; }
    public function getInstIdLider() { return $this->inst_id_lider; }
    public function getFichJornada() { return $this->fich_jornada; }

    // Setters
    public function setFichId($fich_id) { $this->fich_id = $fich_id; }
    public function setProgId($prog_id) { $this->prog_id = $prog_id; }
    public function setInstIdLider($inst_id_lider) { $this->inst_id_lider = $inst_id_lider; }
    public function setFichJornada($fich_jornada) { $this->fich_jornada = $fich_jornada; }

    // CRUD
    public static function save($ficha)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO ficha (fich_id, PROGRAMA_prog_id, INSTRUCTOR_inst_id_lider, fich_jornada)
                 VALUES (:fich_id, :prog_id, :inst_id_lider, :fich_jornada)'
            );
            $insert->bindValue('fich_id', $ficha->getFichId());
            $insert->bindValue('prog_id', $ficha->getProgId());
            $insert->bindValue('inst_id_lider', $ficha->getInstIdLider());
            $insert->bindValue('fich_jornada', $ficha->getFichJornada());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en Ficha::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM ficha');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Ficha(
                    $row['fich_id'],
                    $row['PROGRAMA_prog_id'],
                    $row['INSTRUCTOR_inst_id_lider'],
                    $row['fich_jornada']
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Ficha::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($fich_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM ficha WHERE fich_id = :fich_id');
            $select->bindValue('fich_id', $fich_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Ficha(
                    $row['fich_id'],
                    $row['PROGRAMA_prog_id'],
                    $row['INSTRUCTOR_inst_id_lider'],
                    $row['fich_jornada']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Ficha::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function update($ficha)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE ficha
                 SET PROGRAMA_prog_id = :prog_id,
                     INSTRUCTOR_inst_id_lider = :inst_id_lider,
                     fich_jornada = :fich_jornada
                 WHERE fich_id = :fich_id'
            );
            $update->bindValue('prog_id', $ficha->getProgId());
            $update->bindValue('inst_id_lider', $ficha->getInstIdLider());
            $update->bindValue('fich_jornada', $ficha->getFichJornada());
            $update->bindValue('fich_id', $ficha->getFichId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Ficha::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($fich_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM ficha WHERE fich_id = :fich_id');
            $delete->bindValue('fich_id', $fich_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Ficha::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
