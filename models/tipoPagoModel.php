<?php

include_once 'models/tipoPago.php';
/**
 *
 */
class tipoPagoModel extends Model{

	function __construct(){
		parent::__construct();
	}
	public function insert($datos){

		try {

			$query = $this->db->connect()->prepare('INSERT INTO tipo_pago (descripcionTipoPago) VALUES (:descripcionTipoPago)');
			$query->execute(['descripcionTipoPago' => $datos['descripcionTipoPago']]);
			return true;
		} catch (PDOException $e) {
			return false;
		}

	}

	public function getTipoPago(){
			$items = [];

			try{

					$query = $this->db->connect()->query("SELECT*FROM tipo_pago");

					while($row = $query->fetch()){
							$item = new tipo_pago();
							$item->id_tipo_pago = $row['id_tipo_pago'];
							$item->descripcionTipoPago = $row['descripcionTipoPago'];
							$item->fecha_alta = $row['fecha_alta'];

							array_push($items, $item);
					}

					return $items;
			}catch(PDOException $e){
					return [];
			}
	}

	public function getById($id_tipo_pago){
			$item = new tipo_pago();

			$query = $this->db->connect()->prepare("SELECT * FROM tipo_pago WHERE id_tipo_pago = :id_tipo_pago");
			try{
					$query->execute(['id_tipo_pago' => $id_tipo_pago]);

					while($row = $query->fetch()){
							$item->id_tipo_pago = $row['id_tipo_pago'];
							$item->descripcionTipoPago = $row['descripcionTipoPago'];
							$item->fecha_alta = $row['fecha_alta'];
					}

					return $item;
			}catch(PDOException $e){
					return null;
			}
	}

	public function update($item){
			$query = $this->db->connect()->prepare("UPDATE tipo_pago SET descripcionTipoPago = :descripcionTipoPago WHERE id_tipo_pago = :id_tipo_pago");
			try{
					$query->execute([
							'id_tipo_pago'=> $item['id_tipo_pago'],
							'descripcionTipoPago'=> $item['descripcionTipoPago'],
					]);
					return true;
			}catch(PDOException $e){
					return false;
			}
	}

	public function delete($id){
			$query = $this->db->connect()->prepare("DELETE FROM tipo_pago WHERE id_tipo_pago= :id_tipo_pago");
			try{
					$query->execute([
							'id_tipo_pago'=> $id,
					]);
					return true;
			}catch(PDOException $e){
					return false;
			}
		}
	}

?>
