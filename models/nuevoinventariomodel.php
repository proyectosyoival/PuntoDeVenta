<?php

/**
 * 
 */
class NuevoInventarioModel extends Model{
	
	public function __construct(){
		parent::__construct();
	}

	public function insert($data){
		try {
			$query = $this->db->connect()->prepare('INSERT INTO inventario(fecha, descripcion, id_stock) VALUES(:fecha, :descripcion, :idStock)');
			$query->execute(['fecha' => $datos['fecha'], 'descripcion' => $datos['descripcion'], 'id_stock' => $datos['idStock']]);
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

}

?>