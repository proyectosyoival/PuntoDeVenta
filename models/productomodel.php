<?php

include_once 'models/producto.php';

/**
 * 
 */
class ProductoModel extends Model{
	
	function __construct(){
		parent::__construct();
	}

	public function insert($datos){
		try {
			$query = $this->db->connect()->prepare("CALL procInsertNewProducto(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$query->bindParam(1, $datos['nombreProd']); 
            $query->bindParam(2, $datos['descripcionProd']);
            $query->bindParam(3, $datos['talla']);
            $query->bindParam(4, $datos['tipotela']);
            $query->bindParam(5, $datos['descuento']);
            $query->bindParam(6, $datos['estadoProd']);
            $query->bindParam(7, $datos['foto']);
            $query->bindParam(8, $datos['idPersona']);
            $query->bindParam(9, $datos['codigointerno']);
            $query->bindParam(10, $datos['codigoexterno']);
            $query->bindParam(11, $datos['precio']);
            $query->bindParam(12, $datos['cantidad']);
            $query->bindParam(13, $datos['idcategoria']);
            $query->bindParam(14, $datos['proveedor']);
            $query->execute();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	public function getProducts(){
		$items = [];

        try{

            $query = $this->db->connect()->query("CALL procGetAllProductos();");

            while($row = $query->fetch()){
                $item = new Producto();
                $item->id_producto 			= $row[0];	//id_producto
                $item->nombreProd  			= $row[1];	//nombre
                $item->descripcionProd 		= $row[2];	//descripcion
                $item->estadoProd			= $row[3];	//estado
                $item->talla  				= $row[4];	//talla
                $item->tipo_tela  			= $row[5];	//tipo_tela
                $item->foto       			= $row[6];	//foto
                $item->descuento 			= $row[7];	//descuento
                $item->fecha_reg  			= $row[8];	//fecha_reg
                $item->nombrePers			= $row[9];	//nombre persona quien registra
                $item->apellido				= $row[10];	//apellido persona quien registra
                $item->codigo_interno  		= $row[11];	//codigo de barras interno
                $item->codigo_externo  		= $row[12];	//codigo de barras externo
                $item->general  			= $row[13]; //precio
                $item->cantidad             = $row[14]; //cantidad
                $item->nombreCate	  		= $row[15]; //categoria
                $item->proveedor 	 		= $row[16];	//proveedor
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
	}

}

?>

<!-- SELECT p.id_producto, p.nombre, p.descripcion, p.estado, p.talla, p.tipo_tela, p.foto, p.descuento, p.fecha_reg, pa.nombre, pa.apellido, cb.codigo_interno, cb.codigo_externo, po.general, c.nombre, p.proveedor
FROM producto p
INNER JOIN persona pa
ON p.id_persona = pa.id_persona
INNER JOIN codigo_de_barras cb
ON cb.id_codigo_de_barras = p.id_codigo_de_barras
INNER JOIN precio po
ON p.id_precio = po.id_precio
INNER JOIN categoria c
ON c.id_categoria = p.id_categoria
ORDER BY p.id_producto ASC -->