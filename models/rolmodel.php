<?php

include_once 'models/rol.php';

class RolModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO Rol (nombreRol, descripcionRoL) VALUES(:nombreRol, descripcionRol)');
            $query->execute(['nombreRol' => $datos['nombreRol'], 'descripcionRol' => $datos['descripcionRol']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            return false;
        }
        
    }
    
    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT*FROM rol");

            while($row = $query->fetch()){
                $item = new Roles();
                $item->id_rol = $row['id_rol'];
                $item->nombreRol = $row['nombreRol'];
                $item->descripcionRol = $row['descripcionRol'];
                $item->fecha_alta = $row['fecha_alta'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id_iva){
        $item = new Iv();

        $query = $this->db->connect()->prepare("SELECT * FROM rol WHERE id_rol = :id_rol");
        try{
            $query->execute(['id_iva' => $id_iva]);

            while($row = $query->fetch()){
                $item->id_rol = $row['id_rol'];
                $item->nombreRol = $row['nombreRol'];
                $item->descripcionRol = $row['descripcionRol'];
                $item->fecha_alta = $row['fecha_alta'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE rol SET nombreRol = :porcentaje, descripcionRol = :descripcionRol WHERE id_rol = :id_rol");
        try{
            $query->execute([
                'id_rol'=> $item['id_rol'],
                'nombreRol'=> $item['nombreRol'],
                'descripcionRol'=> $item['descripcionRol'],
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM rol WHERE id_rol= :id_rol");
        try{
            $query->execute([
                'id_iva'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>