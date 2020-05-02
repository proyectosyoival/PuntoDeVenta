<?php

include_once 'models/talla.php';

class TallaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO talla (nombreTalla, tipoTalla) VALUES(:nombreTalla, :tipoTalla)');
            $query->execute(['nombreTalla' => $datos['nombreTalla'], 'tipoTalla' => $datos['tipoTalla']]);
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

            $query = $this->db->connect()->query("SELECT*FROM talla");

            while($row = $query->fetch()){
                $item = new Size();
                $item->id_talla = $row['id_talla'];
                $item->nombreTalla = $row['nombreTalla'];
                $item->tipoTalla = $row['tipoTalla'];
                $item->fecha_alta = $row['fecha_alta'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id_talla){
        $item = new Size();

        $query = $this->db->connect()->prepare("SELECT * FROM talla WHERE id_talla = :id_talla");
        try{
            $query->execute(['id_talla' => $id_talla]);

            while($row = $query->fetch()){
                $item->id_talla = $row['id_talla'];
                $item->nombreTalla = $row['nombreTalla'];
                $item->tipoTalla = $row['tipoTalla'];
                $item->fecha_alta = $row['fecha_alta'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE talla SET nombreTalla = :nombreTalla, tipoTalla = :tipoTalla WHERE id_talla = :id_talla");
        try{
            $query->execute([
                'id_talla'=> $item['id_talla'],
                'nombreTalla'=> $item['nombreTalla'],
                'tipoTalla'=> $item['tipoTalla'],
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM talla WHERE id_talla= :id_talla");
        try{
            $query->execute([
                'id_talla'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>