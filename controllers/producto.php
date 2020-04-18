<?php

/**
 * 
 */
class Producto extends Controller{
	
	function __construct(){
		parent::__construct();
		$this->view->productos 	= [];
		$this->view->tipostela 	= [];
		$this->view->categorias = [];
	}

	function nuevo(){
		$tipostela = $this->model->getTipostelaForProduct();
		$this->view->tipostela = $tipostela;
		$categorias = $this->model->getCategoriesForProduct();
		$this->view->categorias = $categorias;

		$this->view->render('producto/nuevo');
	}

	function render(){
		$productos = $this->model->getProducts();
		$this->view->productos = $productos;

		$this->view->render('producto/index');
	}

	function registrarProducto(){
		$nombreProd			= $_POST['nombreProd'];				//Se registra en la tabla producto
		$descripcionProd	= $_POST['descripcionProd'];		//Se registra en la tabla producto
		$talla				= $_POST['talla'];				//Se registra en la tabla producto
		$idtipoTela			= $_POST['idtipotela'];			//Se registra en la tabla producto - se deberia de obtener de una tabla externa (tipo tela)
		$descuento			= $_POST['descuento'];			//Se registra en la tabla producto
		$estadoProd			= $_POST['estadoProd'];				//Se registra en la tabla producto
		$foto				= $_FILES["foto"];				//Se registra en la tabla producto
		//$fechaReg			= $_POST['fechareg'];			//Se genera de manera automática (automatico)
		
		//Recuperamos la session de la persona que esta logeada.
		$idPersona			= $_SESSION['idPersona'];		//Se obtiene de la session activa (automatco)
		
		//$idCodigoDeBarras	= $_POST['idcodigodebarras'];	//Se obtiene de la tabla de codigos de barras
		$codigoInterno		= $_POST['codigointerno'];
		$codigoExterno		= $_POST['codigoexterno'];
		//$idPrecio			= $_POST['idprecio'];			//Se obtiene de la tabla de precio
		$precio				= $_POST['precio'];
		$cantidad			= $_POST['cantidad'];
		$idcategoria 		= $_POST['idcategoria'];	//Se obtiene de la tabla de categoria
		$proveedor			= $_POST['proveedor'];			//Se registra en la tabla producto

		$mensaje = "";

		if($this->model->insert(['nombreProd' => $nombreProd, 'descripcionProd' => $descripcionProd, 'talla' => $talla, 'idtipotela' => $idtipoTela, 'descuento' => $descuento, 'estadoProd' => $estadoProd, 'foto' => $foto, 'idPersona' => $idPersona, 'codigointerno' => $codigoInterno, 'codigoexterno' => $codigoExterno, 'precio' => $precio, 'cantidad' => $cantidad, 'idcategoria' => $idcategoria, 'proveedor' => $proveedor])){
			$mensaje = "El producto se agreogo correctamente!";
		}else{
			$mensaje = "El producto ya existe!";
		}

		$this->view->mensaje = $mensaje;
		$this->render();
	}


}

?>