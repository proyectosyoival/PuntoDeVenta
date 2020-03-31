<?php

include_once 'models/iva.php';

class IvaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO IVA (porcentaje) VALUES(:porcentaje)');
            $query->execute(['porcentaje' => $datos['porcentaje']]);
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

            $query = $this->db->connect()->query("SELECT*FROM iva");

            while($row = $query->fetch()){
                $item = new Iv();
                $item->id_iva = $row['id_iva'];
                $item->porcentaje = $row['porcentaje'];
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

        $query = $this->db->connect()->prepare("SELECT * FROM iva WHERE id_iva = :id_iva");
        try{
            $query->execute(['id_iva' => $id_iva]);

            while($row = $query->fetch()){
                $item->id_iva = $row['id_iva'];
                $item->porcentaje = $row['porcentaje'];
                $item->fecha_alta = $row['fecha_alta'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE iva SET porcentaje = :porcentaje WHERE id_iva = :id_iva");
        try{
            $query->execute([
                'id_iva'=> $item['id_iva'],
                'porcentaje'=> $item['porcentaje']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM iva WHERE id_iva = :id_iva");
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