<?php
class Programa
{
    private $prog_codigo;
    private $prog_denominacion;
    private $tit_id;
    private $prog_tipo;

    public function __construct($prog_codigo, $prog_denominacion, $tit_id, $prog_tipo)
    {
        $this->prog_codigo = $prog_codigo;
        $this->prog_denominacion = $prog_denominacion;
        $this->tit_id = $tit_id;
        $this->prog_tipo = $prog_tipo;
    }

    // Getters
    public function getProgCodigo() { return $this->prog_codigo; }
    public function getProgId() { return $this->prog_codigo; }
    public function getProgNombre() { return $this->prog_denominacion; }
    public function getProgDenominacion() { return $this->prog_denominacion; }
    public function getTitId() { return $this->tit_id; }
    public function getProgTipo() { return $this->prog_tipo; }

    // Setters
    public function setProgCodigo($prog_codigo) { $this->prog_codigo = $prog_codigo; }
    public function setProgDenominacion($prog_denominacion) { $this->prog_denominacion = $prog_denominacion; }
    public function setTitId($tit_id) { $this->tit_id = $tit_id; }
    public function setProgTipo($prog_tipo) { $this->prog_tipo = $prog_tipo; }

    // CRUD
    public static function save($programa)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO programa (prog_codigo, prog_denominacion, TIT_PROGRAM_titulo_id, prog_tipo)
                VALUES (:codigo, :denominacion, :tit_id, :tipo)'
            );
            $insert->bindValue('codigo', $programa->getProgCodigo());
            $insert->bindValue('denominacion', $programa->getProgDenominacion());
            $insert->bindValue('tit_id', $programa->getTitId());
            $insert->bindValue('tipo', $programa->getProgTipo());
            $insert->execute();
        } catch (PDOException $e) {
            error_log("Error en Programa::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM programa');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new Programa(
                    $row['prog_codigo'],
                    $row['prog_denominacion'],
                    $row['TIT_PROGRAM_titulo_id'] ?? null,
                    $row['prog_tipo'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en Programa::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchByCodigo($prog_codigo)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM programa WHERE prog_codigo = :codigo');
            $select->bindValue('codigo', $prog_codigo);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Programa(
                    $row['prog_codigo'],
                    $row['prog_denominacion'],
                    $row['TIT_PROGRAM_titulo_id'] ?? null,
                    $row['prog_tipo'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en Programa::searchByCodigo() - " . $e->getMessage());
            return null;
        }
    }
    
    // Alias para compatibilidad
    public static function searchById($prog_id)
    {
        return self::searchByCodigo($prog_id);
    }

    public static function update($programa)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE programa
                 SET prog_denominacion = :denominacion,
                     TIT_PROGRAM_titulo_id = :tit_id,
                     prog_tipo = :tipo
                 WHERE prog_codigo = :codigo'
            );
            $update->bindValue('denominacion', $programa->getProgDenominacion());
            $update->bindValue('tit_id', $programa->getTitId());
            $update->bindValue('tipo', $programa->getProgTipo());
            $update->bindValue('codigo', $programa->getProgCodigo());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en Programa::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($prog_codigo)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM programa WHERE prog_codigo = :codigo');
            $delete->bindValue('codigo', $prog_codigo);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en Programa::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
