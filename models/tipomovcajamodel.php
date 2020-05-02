<?php

include_once 'models/tipomovcaja.php';

class TipoMovCajaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO tipo_mov_caja (nombreMovCaja, descripcionMovCaja) VALUES(:nombreMovCaja, :descripcionMovCaja)');
            $query->execute(['nombreMovCaja' => $datos['nombreMovCaja'], 'descripcionMovCaja' => $datos['descripcionMovCaja']]);
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

            $query = $this->db->connect()->query("SELECT*FROM tipo_mov_caja");

            while($row = $query->fetch()){
                $item = new TypeMovCaja();
                $item->id_tipo_mov_caja = $row['id_tipo_mov_caja'];
                $item->nombreMovCaja = $row['nombreMovCaja'];
                $item->descripcionMovCaja = $row['descripcionMovCaja'];
                $item->fecha_alta = $row['fecha_alta'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id_tipo_mov_caja){
        $item = new TypeMovCaja();

        $query = $this->db->connect()->prepare("SELECT * FROM tipo_mov_caja WHERE id_tipo_mov_caja = :id_tipo_mov_caja");
        try{
            $query->execute(['id_tipo_mov_caja' => $id_tipo_mov_caja]);

            while($row = $query->fetch()){
                $item->id_tipo_mov_caja = $row['id_tipo_mov_caja'];
                $item->nombreMovCaja = $row['nombreMovCaja'];
                $item->descripcionMovCaja = $row['descripcionMovCaja'];
                $item->fecha_alta = $row['fecha_alta'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE tipo_mov_caja SET nombreMovCaja = :nombreMovCaja, descripcionMovCaja = :descripcionMovCaja WHERE id_tipo_mov_caja = :id_tipo_mov_caja");
        try{
            $query->execute([
                'id_tipo_mov_caja'=> $item['id_tipo_mov_caja'],
                'nombreMovCaja'=> $item['nombreMovCaja'],
                'descripcionMovCaja'=> $item['descripcionMovCaja'],
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM tipo_mov_caja WHERE id_tipo_mov_caja= :id_tipo_mov_caja");
        try{
            $query->execute([
                'id_tipo_mov_caja'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>