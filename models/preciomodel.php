<?php 

include_once 'models/precio.php';

/**
 * 
 */
class PrecioModel extends Model{
	
	public function __construct(){
		parent::__construct();
	}

	#EVITAREMOS ADICIONAR LA FUNCION DE INSERCION YA QUE ESTA SE HACE
	#DESDE EL APARTADO DE PRODUCTOS.

	public function getAllPrecios(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT * FROM precio");

            while($row = $query->fetch()){
                $item = new Price();
                $item->id_precio = $row['id_precio'];
                $item->general = $row['general'];
                $item->mayoreo = $row['mayoreo'];
                $item->fecha_alta = $row['fecha_alta'];

                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getPrecioById($id_precio){
        $item = new Price();

        $query = $this->db->connect()->prepare("SELECT * FROM precio WHERE id_precio = :id_precio");
        try{
            $query->execute(['id_precio' => $id_precio]);

            while($row = $query->fetch()){
                $item->id_precio = $row['id_precio'];
                $item->general = $row['general'];
                $item->mayoreo = $row['mayoreo'];
                $item->fecha_alta = $row['fecha_alta'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function updatePrecio($item){
        $query = $this->db->connect()->prepare("UPDATE precio SET general = :general, mayoreo = :mayoreo WHERE id_precio = :id_precio");
        try{
            $query->execute([
                'id_precio'=> $item['id_precio'],
                'general'=> $item['general'],
                'mayoreo'=> $item['mayoreo']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
	}

	public function eliminarPrecio($id){
        $query = $this->db->connect()->prepare("DELETE FROM precio WHERE id_precio = :id_precio");
        try{
            $query->execute([
                'id_precio'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>