<?php
class CentroFormacion
{
    private $cent_id;
    private $cent_nombre;
    private $correo;
    private $password;

    public function __construct($cent_id, $cent_nombre, $correo = null, $password = null)
    {
        $this->cent_id = $cent_id;
        $this->cent_nombre = $cent_nombre;
        $this->correo = $correo;
        $this->password = $password;
    }

    // Getters
    public function getCentId() { return $this->cent_id; }
    public function getCentNombre() { return $this->cent_nombre; }
    public function getCorreo() { return $this->correo; }
    public function getPassword() { return $this->password; }

    // Setters
    public function setCentId($cent_id) { $this->cent_id = $cent_id; }
    public function setCentNombre($cent_nombre) { $this->cent_nombre = $cent_nombre; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setPassword($password) { $this->password = $password; }

    // CRUD
    public static function save($centro)
    {
        try {
            $db = getDB();
            $insert = $db->prepare(
                'INSERT INTO centro_formacion (cent_nombre, correo, password)
                 VALUES (:cent_nombre, :correo, :password)'
            );
            $insert->bindValue('cent_nombre', $centro->getCentNombre());
            $insert->bindValue('correo', $centro->getCorreo());
            $insert->bindValue('password', $centro->getPassword());
            $insert->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en CentroFormacion::save() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function all()
    {
        try {
            $db = getDB();
            $lista = [];
            $select = $db->query('SELECT * FROM centro_formacion');

            foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $lista[] = new CentroFormacion(
                    $row['cent_id'] ?? null,
                    $row['cent_nombre'] ?? '',
                    $row['correo'] ?? null,
                    $row['password'] ?? null
                );
            }
            return $lista;
        } catch (PDOException $e) {
            error_log("Error en CentroFormacion::all() - " . $e->getMessage());
            return [];
        }
    }

    public static function searchById($cent_id)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM centro_formacion WHERE cent_id = :cent_id');
            $select->bindValue('cent_id', $cent_id);
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new CentroFormacion(
                    $row['cent_id'] ?? null,
                    $row['cent_nombre'] ?? '',
                    $row['correo'] ?? null,
                    $row['password'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en CentroFormacion::searchById() - " . $e->getMessage());
            return null;
        }
    }

    public static function searchByNombre($nombre)
    {
        try {
            $db = getDB();
            $select = $db->prepare('SELECT * FROM centro_formacion WHERE cent_nombre LIKE :nombre LIMIT 1');
            $select->bindValue('nombre', '%' . $nombre . '%');
            $select->execute();

            $row = $select->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new CentroFormacion(
                    $row['cent_id'] ?? null,
                    $row['cent_nombre'] ?? '',
                    $row['correo'] ?? null,
                    $row['password'] ?? null
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error en CentroFormacion::searchByNombre() - " . $e->getMessage());
            return null;
        }
    }

    public static function update($centro)
    {
        try {
            $db = getDB();
            $update = $db->prepare(
                'UPDATE centro_formacion
                 SET cent_nombre = :cent_nombre,
                     correo = :correo,
                     password = :password
                 WHERE cent_id = :cent_id'
            );
            $update->bindValue('cent_nombre', $centro->getCentNombre());
            $update->bindValue('correo', $centro->getCorreo());
            $update->bindValue('password', $centro->getPassword());
            $update->bindValue('cent_id', $centro->getCentId());
            $update->execute();
        } catch (PDOException $e) {
            error_log("Error en CentroFormacion::update() - " . $e->getMessage());
            throw $e;
        }
    }

    public static function delete($cent_id)
    {
        try {
            $db = getDB();
            $delete = $db->prepare('DELETE FROM centro_formacion WHERE cent_id = :cent_id');
            $delete->bindValue('cent_id', $cent_id);
            $delete->execute();
        } catch (PDOException $e) {
            error_log("Error en CentroFormacion::delete() - " . $e->getMessage());
            throw $e;
        }
    }
}
?>
