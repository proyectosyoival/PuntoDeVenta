<?php

/**
 * 
 */
class Producto extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->productos = [];
	}

	function nuevo(){
		$this->view->render('producto/nuevo');
	}

	function render(){
		$productos = $this->model->getProducts();
		$this->view->productos = $productos;

		$this->view->render('producto/index');
	}

	function registraProducto(){
		$nombre				= $_POST['nombre'];				//Se registra en la tabla producto
		$descripcion		= $_POST['descripcion'];		//Se registra en la tabla producto
		$talla				= $_POST['talla'];				//Se registra en la tabla producto
		$tipoTela			= $_POST['tipotela'];			//Se registra en la tabla producto - se deberia de obtener de una tabla externa (tipo tela)
		$descuento			= $_POST['descuento'];			//Se registra en la tabla producto
		$estado				= $_POST['estado'];				//Se registra en la tabla producto
		$foto				= $_POST['foto'];				//Se registra en la tabla producto
		$fechaReg			= $_POST['fechareg'];			//Se genera de manera automática (automatico)
		$idPersona			= $_POST['idpersona'];			//Se obtiene de la session activa (automatco)
		$idCodigoDeBarras	= $_POST['idcodigodebarras'];	//Se obtiene de la tabla de codigos de barras
		$idPrecio			= $_POST['idprecio'];			//Se obtiene de la tabla de precio
		$idCategoria		= $_POST['idcategoria'];		//Se obtiene de la tabla de categoria
		$proveedor			= $_POST['proveedor'];			//Se registra en la tabla producto

		$mensaje = "";

		if($this->model->insert(['nombre' => $nombre, 'descripcion' => $descripcion, 'talla' => $talla, 'tipotela' => $tipoTela, 'descuento' => $descuento, 'estado' => $estado, 'foto' => $foto, 'fechareg' => $fechaReg, 'idpersona' => $idPersona, 'idcodigodebarras' => $idCodigoDeBarras, 'idprecio' => $idPrecio,'idcategoria' => $idCategoria,'proveedor' => $proveedor])){
			$mensaje = "El producto se agreogo correctamente!";
		}else{
			$mensaje = "El producto ya existe!";
		}

		$this->view->mensaje = $mensaje;
		$this->render();
	}


}

?>