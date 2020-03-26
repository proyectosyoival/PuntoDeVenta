<?php

/**
 * En esta tabla se define basicamente la implementacion de
 * los inventarios por medio de un a fecha de realización.
 */
class NuevoInventario extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->mensaje = "";
	}

	function render(){
		$this->view->render('inventario/index');
	}

	function registrarInventario(){
		//$idInventario 	= $_POST['idInventario'];
		$fecha		  	= $_POST['fecha'];
		$descripcion	= $_POST['descripcion'];
		$idStock		= $_POST['idStock'];

		$mensaje = "";

		if($this->model->insert(['fecha' => $fecha, 'descripcion' => $descripcion, 'idStock' => $idStock])){
			$mensaje = "Se ha registrado un nuevo Inventario exitosamente!";
		}else{
			$mensaje = "El Inventario ya existe!";
		}

		$this->view->mensaje = $mensaje;
		$this->render();
	}

}

?>