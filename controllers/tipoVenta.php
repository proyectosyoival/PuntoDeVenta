<?php

class tipoVenta extends Controller{

	function __construct(){
		parent::__construct();
		$this->view->tiposVenta = [];


	}

	function nuevo(){
		$this->view->render('tipoVenta/nuevo');
	}

	function render(){
		$tiposVenta = $this->model->getTipo_Venta();
		$this->view->tiposVenta = $tiposVenta;

		$this->view->render('tipoVenta/index');
	}

	function registrarTipo_Venta(){
		$descripcionTipoVenta = $_POST['descripcionTipoVenta'];
		$mensaje = "";

		if ($this->model->insert(['descripcionTipoVenta' => $descripcionTipoVenta])) {

		}else{

		}
		$this->view->mensaje = $mensaje;
		$this-> render();
	}

	function verTipo_Venta($param = null){
		$id_tipo_venta = $param[0];
		$tiposVenta = $this->model->getById($id_tipo_venta);

		$_SESSION['id_tipo_venta'] = $tiposVenta->id_tipo_venta;
		$this->view->tiposVenta = $tiposVenta;
		$this->view->mensaje = "";
		$this->view->render('tipoVenta/edit');
	}

	function actualizarTipo_Venta(){
		$id_tipo_venta = $_SESSION['id_tipo_venta'];
		$descripcionTipoVenta = $_POST['descripcionTipoVenta'];

		if ($this->model->update(['id_tipo_venta' => $id_tipo_venta, 'descripcionTipoVenta' => $descripcionTipoVenta])) {
			$tiposVenta = new tipo_venta();
			$tiposVenta->id_tipo_venta = $id_tipo_venta;
			$tiposVenta->descripcionTipoVenta = $descripcionTipoVenta;

			$this->view->tiposVenta = $tiposVenta;
			$this->view->mensaje = "Tipo de venta actualizado correctamente";
		}else{
			$this->view->mensaje = "No se pudo actualizar el tipo de venta";
		}
		$this->view->render('tipoVenta/edit');
	}

	function eliminarTipo_Venta($param = null){
			$id_tipo_venta = $param[0];

			if($this->model->delete($id_tipo_venta)){
					// $this->view->mensaje = "Alumno eliminado correctamente";
					$mensaje = 1;
			}else{
					// mensaje de error
					// $this->view->mensaje = "No se pudo eliminar el alumno";
					$mensaje = 0;
			}
			// $this->render();

			echo $mensaje;
	}

}

?>
