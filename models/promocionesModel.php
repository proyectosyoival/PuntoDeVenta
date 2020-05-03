<?php

include_once 'models/promocion.php';

class PromocionesModel extends Model{

    public function __construct(){
      parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO promocion (nombrePromo, descripcionPromo, fecha_vigencia) VALUES(:$nombrePromo, :descripcionPromo, fecha_vigencia)');
            $query->execute(['nombrepromo' => $datos['nombrePromo'], 'descripcionPromo' => $datos['descripcionPromo'], 'fecha_vigencia' => ['fecha_vigencia']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
            return false;
        }

    }

    public function getPromo(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT*FROM promocion");

            while($row = $query->fetch()){
                $item = new Promo();
                $item->id_promocion = $row['id_promocion'];
                $item->nombrePromo = $row['nombrePromo'];
                $item->descripcionPromo = $row['descripcionPromo'];
                $item->fecha_vigencia = $row['fecha_vigencia'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id_promocion){
        $item = new Promo();

        $query = $this->db->connect()->prepare("SELECT * FROM promocion WHERE id_promocion = :id_promocion");
        try{
            $query->execute(['id_promocion' => $id_promocion]);

            while($row = $query->fetch()){
                $item->id_promocion = $row['id_promocion'];
                $item->nombrePromo = $row['nombrePromo'];
                $item->descripcionPromo = $row['descripcionPromo'];
                $item->fecha_vigencia = $row['fecha_vigencia'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE promocion SET nombrePromo = :nombrePromo, descripcionPromo = :descripcionPromo, fecha_vigencia = :fecha_vigencia WHERE id_promocion = :id_promocion");
        try{
            $query->execute([
                'id_promocion'=> $item['id_promocion'],
                'nombrePromo'=> $item['nombrePromo'],
                'descripcionPromo'=> $item['descripcionPromo'],
                'fecha_vigencia' => $item ['fecha_vigencia'],
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $query = $this->db->connect()->prepare("DELETE FROM promocion WHERE id_promocion = :id_promocion");
        try{
            $query->execute([
                'id_promocion'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>
