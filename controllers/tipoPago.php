<?php

/**
 *
 */
class tipoPago extends Controller{

	function __construct(){
		parent::__construct();
		$this->view->tipoPago = [];
	}

	function render(){
		$tipoPago = $this->model->getTipoPago();
		$this->view->tipoPago = $tipoPago;

		$this->view->render('tipoPago/index');
	}

	function nuevo(){
		$this->view->render('tipoPago/nuevo');
	}

	function registrarTipoPago(){
		$descripcionTipoPago = $_POST['descripcionTipoPago'];
		$mensaje = "";
		if ($this->model->insert(['descripcionTipoPago' => $descripcionTipoPago])) {
		}else{

		}
		$this->view->mensaje = $mensaje;
		$this-> render();
	}

	function verTipoPago($param = null){
		$id_tipo_pago = $param[0];
		$tipoPago = $this->model->getById($id_tipo_pago);

		$_SESSION['id_tipo_pago'] = $tipoPago->id_tipo_pago;
		$this->view->tipoPago = $tipoPago;
		$this->view->mensaje = "";
		$this->view->render('tipoPago/edit');
	}

	function actualizarTipoPago(){
		$id_tipo_pago = $_SESSION['id_tipo_pago'];
		$descripcionTipoPago = $_POST['descripcionTipoPago'];

		if ($this->model->update(['id_tipo_pago' => $id_tipo_pago, 'descripcionTipoPago' => $descripcionTipoPago])) {
			$tipoPago = new tipo_pago();
			$tipoPago->id_tipo_pago = $id_tipo_pago;
			$tipoPago->descripcionTipoPago = $descripcionTipoPago;

			$this->view->tipoPago = $tipoPago;
			$this->view->mensaje = "Tipo de pago actualizado correctamente";
		}else{
			$this->view->mensaje = "No se pudo actualizar el tipo de pago";
		}
		$this->view->render('tipoPago/edit');
	}

	function eliminarTipoPago($param = null){
			$id_tipo_pago = $param[0];

			if($this->model->delete($id_tipo_pago)){
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
