<?php
class Competencia
{
    private $comp_id;
    private $comp_nombre_corto;
    private $comp_horas;
    private $comp_nombre_unidad_competencia;

    public function __construct($comp_id, $comp_nombre_corto, $comp_horas, $comp_nombre_unidad_competencia)
    {
        $this->comp_id = $comp_id;
        $this->comp_nombre_corto = $comp_nombre_corto;
        $this->comp_horas = $comp_horas;
        $this->comp_nombre_unidad_competencia = $comp_nombre_unidad_competencia;
    }

    // Getters
    public function getCompId() { return $this->comp_id; }
    public function getCompNombreCorto() { return $this->comp_nombre_corto; }
    public function getCompHoras() { return $this->comp_horas; }
    public function getCompNombreUnidadCompetencia() { return $this->comp_nombre_unidad_competencia; }
    
    // Alias para compatibilidad
    public function getCompNombre() { return $this->comp_nombre_corto; }

    // Setters
    public function setCompId($comp_id) { $this->comp_id = $comp_id; }
    public function setCompNombreCorto($comp_nombre_corto) { $this->comp_nombre_corto = $comp_nombre_corto; }
    public function setCompHoras($comp_horas) { $this->comp_horas = $comp_horas; }
    public function setCompNombreUnidadCompetencia($comp_nombre_unidad_competencia) { $this->comp_nombre_unidad_competencia = $comp_nombre_unidad_competencia; }

    // CRUD
    public static function save($competencia)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO competencia (comp_id, comp_nombre_corto, comp_horas, comp_nombre_unidad_competencia)
                 VALUES (:comp_id, :comp_nombre_corto, :comp_horas, :comp_nombre_unidad_competencia)'
            );
            $insert->bindValue('comp_id', $competencia->getCompId());
            $insert->bindValue('comp_nombre_corto', $competencia->getCompNombreCorto());
            $insert->bindValue('comp_horas', $competencia->getCompHoras());
            $insert->bindValue('comp_nombre_unidad_competencia', $competencia->getCompNombreUnidadCompetencia());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en Competencia::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM competencia');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Competencia(
                    $row['comp_id'] ?? null,
                    $row['comp_nombre_corto'] ?? '',
                    $row['comp_horas'] ?? 0,
                    $row['comp_nombre_unidad_competencia'] ?? ''
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Competencia::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($comp_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM competencia WHERE comp_id = :comp_id');
            $select->bindValue('comp_id', $comp_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Competencia(
                    $row['comp_id'] ?? null,
                    $row['comp_nombre_corto'] ?? '',
                    $row['comp_horas'] ?? 0,
                    $row['comp_nombre_unidad_competencia'] ?? ''
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Competencia::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function update($competencia)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE competencia
                 SET comp_nombre_corto = :comp_nombre_corto,
                     comp_horas = :comp_horas,
                     comp_nombre_unidad_competencia = :comp_nombre_unidad_competencia
                 WHERE comp_id = :comp_id'
            );
            $update->bindValue('comp_nombre_corto', $competencia->getCompNombreCorto());
            $update->bindValue('comp_horas', $competencia->getCompHoras());
            $update->bindValue('comp_nombre_unidad_competencia', $competencia->getCompNombreUnidadCompetencia());
            $update->bindValue('comp_id', $competencia->getCompId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Competencia::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($comp_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM competencia WHERE comp_id = :comp_id');
            $delete->bindValue('comp_id', $comp_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Competencia::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
