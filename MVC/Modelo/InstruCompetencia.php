<?php
class InstruCompetencia
{
    private $inscomp_id;
    private $inst_id;
    private $prog_id;
    private $comp_id;
    private $inscomp_vigencia;

    public function __construct($inscomp_id, $inst_id, $prog_id, $comp_id, $inscomp_vigencia = null)
    {
        $this->inscomp_id = $inscomp_id;
        $this->inst_id = $inst_id;
        $this->prog_id = $prog_id;
        $this->comp_id = $comp_id;
        $this->inscomp_vigencia = $inscomp_vigencia;
    }

    // Getters
    public function getInscompId() { return $this->inscomp_id; }
    public function getInstId() { return $this->inst_id; }
    public function getProgId() { return $this->prog_id; }
    public function getCompId() { return $this->comp_id; }
    public function getInscompVigencia() { return $this->inscomp_vigencia; }

    // Setters
    public function setInscompId($inscomp_id) { $this->inscomp_id = $inscomp_id; }
    public function setInstId($inst_id) { $this->inst_id = $inst_id; }
    public function setProgId($prog_id) { $this->prog_id = $prog_id; }
    public function setCompId($comp_id) { $this->comp_id = $comp_id; }
    public function setInscompVigencia($inscomp_vigencia) { $this->inscomp_vigencia = $inscomp_vigencia; }

    // CRUD
    public static function save($relacion)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO instru_competencia (INSTRUCTOR_inst_id, COMPETXPROGRAMA_PROGRAMA_prog_id, COMPETXPROGRAMA_COMPETENCIA_comp_id, inscomp_vigencia)
                 VALUES (:inst_id, :prog_id, :comp_id, :vigencia)'
            );
            $insert->bindValue('inst_id', $relacion->getInstId());
            $insert->bindValue('prog_id', $relacion->getProgId());
            $insert->bindValue('comp_id', $relacion->getCompId());
            $insert->bindValue('vigencia', $relacion->getInscompVigencia());
            $insert->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en InstruCompetencia::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM instru_competencia');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new InstruCompetencia(
                    $row['inscomp_id'] ?? null,
                    $row['INSTRUCTOR_inst_id'] ?? null,
                    $row['COMPETXPROGRAMA_PROGRAMA_prog_id'] ?? null,
                    $row['COMPETXPROGRAMA_COMPETENCIA_comp_id'] ?? null,
                    $row['inscomp_vigencia'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en InstruCompetencia::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($inscomp_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM instru_competencia WHERE inscomp_id = :inscomp_id');
            $select->bindValue('inscomp_id', $inscomp_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new InstruCompetencia(
                    $row['inscomp_id'] ?? null,
                    $row['INSTRUCTOR_inst_id'] ?? null,
                    $row['COMPETXPROGRAMA_PROGRAMA_prog_id'] ?? null,
                    $row['COMPETXPROGRAMA_COMPETENCIA_comp_id'] ?? null,
                    $row['inscomp_vigencia'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en InstruCompetencia::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function delete($inscomp_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM instru_competencia WHERE inscomp_id = :inscomp_id');
            $delete->bindValue('inscomp_id', $inscomp_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en InstruCompetencia::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
