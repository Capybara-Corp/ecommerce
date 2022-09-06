<?php


class login_model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function ingresar($nombre, $pass)
    {

        $tiene_acceso = false;
        try {
            $query = $this->db->connect()->prepare('SELECT passwd FROM usuarios WHERE nombre=:nombre');
            $query->bindValue(':nombre', $nombre);
            $query->execute();
            $paswordStr = "";
            while ($row = $query->fetch()) {
                $paswordStr = $row['password'];
            }
            if ($paswordStr == $pass) {
                $tiene_acceso = true;
            }
        } catch (PDOException $e) {
            var_dump($e);
        }
        return $tiene_acceso;

    }

    public function get()
    {

        $items = [];
        try {
            $query = $this->db->connect()->query('SELECT * FROM alumnos');

            while ($row = $query->fetch()) {
                $item = new Alumno();
                $item->matricula = $row['matricula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];

                array_push($items, $item);

            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getById($id)
    {
        $item = new Alumno();
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM alumnos WHERE matricula = :id');

            $query->execute(['id' => $id]);

            while ($row = $query->fetch()) {

                $item->matricula = $row['matricula'];
                $item->nombre = $row['nombre'];
                $item->apellido = $row['apellido'];
            }
            return $item;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function update($item)
    {
        $query = $this->db->connect()->prepare('UPDATE alumnos SET nombre = :nombre, apellido = :apellido WHERE matricula = :matricula');
        try {
            $query->execute([
                'matricula' => $item['matricula'],
                'nombre' => $item['nombre'],
                'apellido' => $item['apellido'],
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $query = $this->db->connect()->prepare('DELETE FROM alumnos WHERE matricula = :matricula');
        try {
            $query->execute([
                'matricula' => $id,
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
