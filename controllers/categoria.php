<?php

/**
 *
 */
class Categoria extends Controller{

	function __construct(){
		parent::__construct();
		$this->view->categorias = [];
	}

	function render(){
		$categorias = $this->model->getCategoria();
		$this->view->categorias = $categorias;

		$this->view->render('categoria/index');
	}

	function nuevo(){
		$this->view->render('categoria/nuevo');
	}

	function registrarCategoria(){
		$nombreCate = $_POST['nombreCate'];
		$descripcionCate = $_POST['descripcionCate'];
		$estadoCate = $_POST['estadoCate'];
		$mensaje = "";

		if ($this->model->insert(['nombreCate'=>$nombreCate, 'descripcionCate' => $descripcionCate, 'estadoCate' => $estadoCate])) {
		}else{

		}
		$this->view->mensaje = $mensaje;
		$this-> render();
	}

	function verCategoria($param = null){
		$id_categoria = $param[0];
		$rol = $this->model->getById($id_categoria);

		$_SESSION['id_categoria'] = $categorias;
		$this->view->categorias = $categorias;
		$this->view->mensaje = "";
		$this->view->render('categoria/edit');
	}

	function actualizarCate(){
		$id_categoria = $_SESSION['id_categoria'];
		$nombreCate = $_POST['nombreCate'];
		$descripcionCate = $_POST['descripcionCate'];
		$estadoCate =  $_POST['estadoCate'];

		if ($this->model->update(['id_categoria' => $id_categoria, 'descripcionCate' => $descripcionCate, 'estadoCate' => $estadoCate])) {
			$categorias = new Cate();
			$categorias->id_categoria = $id_categoria;
			$categorias->nombreCate = $nombreCate;
			$categorias->descripcionCate = $descripcionCate;
			$estadoCate->estadoCate = $estadoCate;

			$this->view->categorias = $categorias;
			$this->view->mensaje = "Categoria actualizada correctamente";
		}else{
			$this->view->mensaje = "No se pudo actualizar la categoria";
		}
		$this->view->render('categoria/edit');
	}

	function eliminarCate($param = null){
			$id_categoria = $param[0];

			if($this->model->delete($id_categoria)){
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
