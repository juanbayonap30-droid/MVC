<?php
class CompetxPrograma
{
    private $compxprog_id;
    private $prog_id;
    private $comp_id;

    // ====================
    // Constructor
    // ====================
    public function __construct($compxprog_id, $comp_id, $prog_id)
    {
        $this->compxprog_id = $compxprog_id;
        $this->setProgId($prog_id);
        $this->setCompId($comp_id);
    }

    // ====================
    // Getters
    // ====================
    public function getCompxProgId()
    {
        return $this->compxprog_id;
    }
    
    public function getProgId()
    {
        return $this->prog_id;
    }

    public function getCompId()
    {
        return $this->comp_id;
    }

    // ====================
    // Setters
    // ====================
    public function setCompxProgId($compxprog_id)
    {
        $this->compxprog_id = $compxprog_id;
    }
    
    public function setProgId($prog_id)
    {
        $this->prog_id = $prog_id;
    }

    public function setCompId($comp_id)
    {
        $this->comp_id = $comp_id;
    }

    // ====================
    // CRUD / Consultas
    // ====================

    // Crear relación
    public static function save($relacion)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO competxprograma 
                (PROGRAMA_prog_id, COMPETENCIA_comp_id)
                VALUES (:prog_id, :comp_id)'
            );

            $insert->bindValue('prog_id', $relacion->getProgId());
            $insert->bindValue('comp_id', $relacion->getCompId());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en CompetxPrograma::save() - " . $e->getMessage());
            throw $e;
        }
    }

    // Listar todas las relaciones
    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT PROGRAMA_prog_id, COMPETENCIA_comp_id FROM competxprograma');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $compxprog_id = $row['PROGRAMA_prog_id'] . '-' . $row['COMPETENCIA_comp_id'];
                $lista[] = new CompetxPrograma(
                    $compxprog_id,
                    $row['COMPETENCIA_comp_id'],
                    $row['PROGRAMA_prog_id']
                );
            }

            return $lista;
        } catch (PDOException $e) {
            error_log("Error en CompetxPrograma::all() - " . $e->getMessage());
            return [];
        }
    }

    // Buscar por programa
    public static function searchByPrograma($prog_id)
    {
        $db = getDB();
        $select = $db->prepare(
            'SELECT PROGRAMA_prog_id, COMPETENCIA_comp_id 
             FROM competxprograma
             WHERE PROGRAMA_prog_id = :prog_id'
        );

        $select->bindValue('prog_id', $prog_id);
        $select->execute();

        $relaciones = [];
        foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $compxprog_id = $row['PROGRAMA_prog_id'] . '-' . $row['COMPETENCIA_comp_id'];
            $relaciones[] = new CompetxPrograma(
                $compxprog_id,
                $row['COMPETENCIA_comp_id'],
                $row['PROGRAMA_prog_id']
            );
        }

        return $relaciones;
    }

    // Buscar por competencia
    public static function searchByCompetencia($comp_id)
    {
        $db = getDB();
        $select = $db->prepare(
            'SELECT PROGRAMA_prog_id, COMPETENCIA_comp_id 
             FROM competxprograma
             WHERE COMPETENCIA_comp_id = :comp_id'
        );

        $select->bindValue('comp_id', $comp_id);
        $select->execute();

        $relaciones = [];
        foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $compxprog_id = $row['PROGRAMA_prog_id'] . '-' . $row['COMPETENCIA_comp_id'];
            $relaciones[] = new CompetxPrograma(
                $compxprog_id,
                $row['COMPETENCIA_comp_id'],
                $row['PROGRAMA_prog_id']
            );
        }

        return $relaciones;
    }

    // Eliminar relación (acepta ID compuesto "prog_id-comp_id")
    public static function delete($compxprog_id)
    {
        try {
            $db = getDB();
            // El ID viene como "prog_id-comp_id"
            $parts = explode('-', $compxprog_id);
            $prog_id = $parts[0];
            $comp_id = $parts[1];
            
            $delete = $db->prepare(
                'DELETE FROM competxprograma
                 WHERE PROGRAMA_prog_id = :prog_id
                 AND COMPETENCIA_comp_id = :comp_id'
            );

            $delete->bindValue('prog_id', $prog_id);
            $delete->bindValue('comp_id', $comp_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en CompetxPrograma::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
