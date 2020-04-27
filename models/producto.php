<?php 

/**
 * 
 */
class Product{
	
	public $id_producto;
	public $descripcionProd;
	public $estadoProd;
	public $talla;
	public $tipo_tela;
	public $proveedor;
	public $foto;
	public $descuento;
	public $fecha_reg;
	public $id_persona;
	public $id_codigo_de_barras;
	public $id_precio;
	public $id_categoria;
	public $id_cat_tipo_prod;
	public $id_departamento;

	//Campos extraidos por medio de las id de foraneos
	public $nombre_persona;
	public $apellido_persona;
	public $cantidad;
	public $codigo_interno;
	public $codigo_externo;
	public $general;
	public $nombre_categoria;	
	public $nombreDepa;
	public $nombreTipoProd;
}

?>