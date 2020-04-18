<?php

include_once 'models/categoria.php';
/**
 *
 */
class CategoriaModel extends Model{

	function __construct(){
		parent::__construct();
	}
	public function insert($datos){

		try {

			$query = $this->db->connect()->prepare('INSERT INTO categoria (nombreCate, descripcionCate, estadoCate) VALUES (:nombreCate, :descripcionCate, :estadoCate)');
			$query->execute(['nombreCate' => $datos['nombreCate'], 'descripcionCate' => $datos['descripcionCate'], 'estadoCate' =>$datos['estadoCate']]);
			return true;
		} catch (PDOException $e) {
			return false;
		}

	}

	public function getCategoria(){
			$items = [];

			try{

					$query = $this->db->connect()->query("SELECT*FROM categoria");

					while($row = $query->fetch()){
							$item = new Cate();
							$item->id_categoria = $row['id_categoria'];
							$item->nombreCate = $row['nombreCate'];
							$item->descripcionCate = $row['descripcionCate'];
							$item->estadoCate = $row['estadoCate'];
							$item->fecha_alta = $row['fecha_alta'];

							array_push($items, $item);
					}

					return $items;
			}catch(PDOException $e){
					return [];
			}
	}

	public function getById($id_categoria){
			$item = new Cate();

			$query = $this->db->connect()->prepare("SELECT * FROM categoria WHERE id_categoria = :id_categoria");
			try{
					$query->execute(['id_categoria' => $id_categoria]);

					while($row = $query->fetch()){
							$item->id_categoria = $row['id_categoria'];
							$item->nombreCate = $row['nombreCate'];
							$item->descripcionCate = $row['descripcionCate'];
							$item->estadoCate = $row['estadoCate'];
							$item->fecha_alta = $row['fecha_alta'];
					}

					return $item;
			}catch(PDOException $e){
					return null;
			}
	}

	public function update($item){
			$query = $this->db->connect()->prepare("UPDATE categoria SET nombreCate = :nombreCate, descripcionCate = :descripcionCate, estadoCate = :estadoCate WHERE id_categoria = :id_categoria");
			try{
					$query->execute([
							'id_categoria'=> $item['id_categoria'],
							'nombreCate'=> $item['nombreCate'],
							'descripcionCate'=> $item['descripcionCate'],
							'estadoCate' => $item['estadoCate'],
					]);
					return true;
			}catch(PDOException $e){
					return false;
			}
	}

	public function delete($id){
			$query = $this->db->connect()->prepare("DELETE FROM categoria WHERE id_categoria= :id_categoria");
			try{
					$query->execute([
							'id_categoria'=> $id,
					]);
					return true;
			}catch(PDOException $e){
					return false;
			}
		}
	}

?>
