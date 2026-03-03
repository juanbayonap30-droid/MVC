<?php
class TituloPrograma
{
    private $titpro_id;
    private $titpro_nombre;

    // Constructor
    public function __construct($titpro_id, $titpro_nombre)
    {
        $this->setTitproId($titpro_id);
        $this->setTitproNombre($titpro_nombre);
    }

    // ====================
    // Getters
    // ====================
    public function getTitproId()
    {
        return $this->titpro_id;
    }

    public function getTitproNombre()
    {
        return $this->titpro_nombre;
    }

    // ====================
    // Setters
    // ====================
    public function setTitproId($titpro_id)
    {
        $this->titpro_id = $titpro_id;
    }

    public function setTitproNombre($titpro_nombre)
    {
        $this->titpro_nombre = $titpro_nombre;
    }

    // ====================
    // CRUD
    // ====================

    // Crear
    public static function save($titulo)
    {
        $db = getDB();
        $insert = $db->prepare(
            'INSERT INTO titulo_programa (titpro_id, titpro_nombre)
             VALUES (:titpro_id, :titpro_nombre)'
        );

        $insert->bindValue('titpro_id', $titulo->getTitproId());
        $insert->bindValue('titpro_nombre', $titulo->getTitproNombre());
        $insert->execute();
    }

    // Listar todos
    public static function all()
    {
        $db = getDB();
        $lista = [];
        $select = $db->query('SELECT * FROM titulo_programa');

        foreach ($select->fetchAll() as $row) {
            $lista[] = new TituloPrograma(
                $row['titpro_id'],
                $row['titpro_nombre']
            );
        }

        return $lista;
    }

    // Buscar por ID
    public static function searchById($titpro_id)
    {
        $db = getDB();
        $select = $db->prepare(
            'SELECT * FROM titulo_programa WHERE titpro_id = :titpro_id'
        );
        $select->bindValue('titpro_id', $titpro_id);
        $select->execute();

        $row = $select->fetch();
        if ($row) {
            return new TituloPrograma(
                $row['titpro_id'],
                $row['titpro_nombre']
            );
        }
        return null;
    }

    // Actualizar
    public static function update($titulo)
    {
        $db = getDB();
        $update = $db->prepare(
            'UPDATE titulo_programa
             SET titpro_nombre = :titpro_nombre
             WHERE titpro_id = :titpro_id'
        );

        $update->bindValue('titpro_nombre', $titulo->getTitproNombre());
        $update->bindValue('titpro_id', $titulo->getTitproId());
        $update->execute();
    }

    // Eliminar
    public static function delete($titpro_id)
    {
        $db = getDB();
        $delete = $db->prepare(
            'DELETE FROM titulo_programa WHERE titpro_id = :titpro_id'
        );
        $delete->bindValue('titpro_id', $titpro_id);
        $delete->execute();
    }

    // ====================
    // BUSCAR (LIKE)
    // ====================
    public static function searchByNombre($titpro_nombre)
    {
        $db = getDB();
        $select = $db->prepare(
            'SELECT * FROM titulo_programa 
             WHERE titpro_nombre LIKE :titpro_nombre'
        );

        $select->bindValue('titpro_nombre', '%' . $titpro_nombre . '%');
        $select->execute();

        $titulos = [];
        foreach ($select->fetchAll() as $row) {
            $titulos[] = new TituloPrograma(
                $row['titpro_id'],
                $row['titpro_nombre']
            );
        }

        return $titulos;
    }
}
?>
