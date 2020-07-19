<?php

include_once 'models/tipoVenta.php';
/**
 *
 */
class tipoVentaModel extends Model{

	function __construct(){
		parent::__construct();
	}
	public function insert($datos){

		try {

			$query = $this->db->connect()->prepare('INSERT INTO tipo_venta (descripcionTipoVenta) VALUES (:descripcionTipoVenta)');
			$query->execute(['descripcionTipoVenta' => $datos['descripcionTipoVenta']]);
			return true;
		} catch (PDOException $e) {
			return false;
		}

	}

	public function getTipo_Venta(){
			$items = [];

			try{

					$query = $this->db->connect()->query("SELECT * FROM tipo_venta");

					while($row = $query->fetch()){
							$item = new tipo_venta();
							$item->id_tipo_venta = $row['id_tipo_venta'];
							$item->descripcionTipoVenta = $row['descripcionTipoVenta'];
							$item->fecha_alta = $row['fecha_alta'];

							array_push($items, $item);
					}

					return $items;
			}catch(PDOException $e){
					return [];
			}
	}

	public function getById($id_tipo_venta){
			$item = new tipo_venta();

			$query = $this->db->connect()->prepare("SELECT * FROM tipo_venta WHERE id_tipo_venta = :id_tipo_venta");
			try{
					$query->execute(['id_tipo_venta' => $id_tipo_venta]);

					while($row = $query->fetch()){
							$item->id_tipo_venta = $row['id_tipo_venta'];
							$item->descripcionTipoVenta = $row['descripcionTipoVenta'];
							$item->fecha_alta = $row['fecha_alta'];
					}

					return $item;
			}catch(PDOException $e){
					return null;
			}
	}

	public function update($item){
			$query = $this->db->connect()->prepare("UPDATE tipo_venta SET descripcionTipoVenta = :descripcionTipoVenta WHERE id_tipo_venta = :id_tipo_venta");
			try{
					$query->execute([
							'id_tipo_venta' => $item['id_tipo_venta'],
							'descripcionTipoVenta' => $item['descripcionTipoVenta'],
					]);
					return true;
			}catch(PDOException $e){
					return false;
			}
	}

	public function delete($id){
			$query = $this->db->connect()->prepare("DELETE FROM tipo_venta WHERE id_tipo_venta = :id_tipo_venta");
			try{
					$query->execute([
							'id_tipo_venta'=> $id,
					]);
					return true;
			}catch(PDOException $e){
					return false;
			}
		}
	}

?>
