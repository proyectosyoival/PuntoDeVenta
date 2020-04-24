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

	function verProducto($param = null){
		$id_producto = $param[0];
		$productoSelected = $this->model->getProductById($id_producto);

		$_SESSION['id_producto'] = $productoSelected->id_producto;
		$this->view->productoSelected = $productoSelected;
		$this->view->render('producto/getViewProduct');
	}

	function editProduct($param = null){
		$id_producto = $param[0];
		$productoSelected = $this->model->getProductById($id_producto);

		$_SESSION['id_producto'] = $productoSelected->id_producto;
		$this->view->productoSelected = $productoSelected;

		$tipostela = $this->model->getTipostelaForProduct();
		$this->view->tipostela = $tipostela;
		$categorias = $this->model->getCategoriesForProduct();
		$this->view->categorias = $categorias;

		$this->view->render('producto/edit');
	}

	function actualizarProducto(){
		//Traemos el valor del producto desde la session ya que en edit product se asignó.
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
		$idCodigoDeBarras	= $_POST['idcodigodebarras'];	//Se obtiene de la tabla de codigos de barras
		$codigoInterno		= $_POST['codigointerno'];
		$codigoExterno		= $_POST['codigoexterno'];
		$idPrecio			= $_POST['idprecio'];			//Se obtiene de la tabla de precio
		$precio				= $_POST['precio'];
		$cantidad			= $_POST['cantidad'];
		$idcategoria 		= $_POST['idcategoria'];	//Se obtiene de la tabla de categoria
		$proveedor			= $_POST['proveedor'];			//Se registra en la tabla producto
		$id_producto 		= $_SESSION['id_producto'];		//Se envia el id del producto seleccionado
		$id_stock			= $_POST['idstock'];


		//mandar variable correcta de foto
		$db = new Database();
		$query = $db->connect()->prepare('SELECT * FROM producto WHERE id_producto=:id_producto');
		$query->execute(['id_producto' => $id_producto]);
		foreach ($query as $row) {
			$fotoold = $row['foto'];
		}

        //Comprobacion de la foto
		$cfoto = $foto["name"];
        // si sube fotos con el mismo nombre
		if ($cfoto==$fotoold) {
			$nfoto=$fotoold;
        //si no sube fotos          
		}elseif ($foto["name"]=="") {
			$nfoto=$fotoold;
        // si sube foto diferente a la foto diferente a la guardada
		}elseif ($cfoto!=$fotoold && $foto["name"]!="") {
             // array_push($arrayupfotos, $foto, $comprobante);
			$this->subirfotos($foto);
			$nfoto=basename( $foto["name"]);
			@unlink('img/empleados/'.$fotoold);
             // echo "<br>".$cfoto."-".$fotoold."-".$ccomprobante."-".$comprobanteold;
        // si una foto es diferente pero comprobante es igual
		}


		if($this->model->updateProd(['id_producto' => $id_producto, 'nombreProd' => $nombreProd, 'descripcionProd' => $descripcionProd, 'talla' => $talla, 'idtipotela' => $idtipoTela, 'descuento' => $descuento, 'estadoProd' => $estadoProd, 'foto' => $nfoto, 'idPersona' => $idPersona, 'codigointerno' => $codigoInterno, 'codigoexterno' => $codigoExterno, 'precio' => $precio, 'cantidad' => $cantidad, 'idcategoria' => $idcategoria, 'proveedor' => $proveedor, 'id_codigo_de_barras' => $idCodigoDeBarras, 'id_precio' => $idPrecio, 'id_stock' => $id_stock])){
			//Actualizar el prodcuto con éxito
			$productoSelected = new Producto();
			$productoSelected->id_producto 			= $id_producto;
			$productoSelected->nombreProd			= $nombreProd;	
			$productoSelected->descripcionProd		= $descripcionProd;
			$productoSelected->talla				= $talla;
			$productoSelected->idtipotela 			= $idtipoTela;
			$productoSelected->descuento			= $descuento;
			$productoSelected->estadoProd			= $estadoProd;
			$productoSelected->foto 				= $nfoto;
			$productoSelected->idPersona 			= $idPersona;
			$productoSelected->codigointerno 		= $codigoInterno;
			$productoSelected->codigoexterno 		= $codigoExterno;
			$productoSelected->precio 				= $precio;
			$productoSelected->cantidad 			= $cantidad;
			$productoSelected->idcategoria 			= $idcategoria;
			$productoSelected->proveedor 			= $proveedor;
			$productoSelected->id_codigo_de_barras 	= $idCodigoDeBarras;
			$productoSelected->id_precio	 		= $idPrecio;
			$productoSelected->id_stock 			= $id_stock;
			$this->view->productoSelected = $productoSelected;
			$this->view->mensaje = "El producto se actualizo correctamente!";
		}else{
			$this->view->mensaje = "El producto NO se actualizo!";
		}
		$this->view->render('producto/edit');
	}

	public function subirfotos($foto){
		$arrayupfotos=array($foto);
		for ($i=0; $i <count($arrayupfotos) ; $i++) { 
                  //INICIA SUBIR IMAGEN AL SERVIDOR
			$target_dir = "img/productos/";
			$target_file = $target_dir . basename($arrayupfotos[$i]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($arrayupfotos[$i]["tmp_name"]);
				if($check !== false) {
					echo "El archivo es una imagen - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
	                        // echo "El archivo no es una imagen.";
					$uploadOk = 0;
				}
			}
                // Check if file already exists
			if (file_exists($target_file)) {
	                    // echo "Lo siento, el archivo ya existe.";
				$uploadOk = 0;
			}
                // Check file size
			if ($arrayupfotos[$i]["size"] > 2000000) {
	                    // echo "Lo siento, el archivo es muy grande.";
				$uploadOk = 0;
			}
                // Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	                    // echo "Lo siento, solo los archivos JPG, JPEG, PNG & GIF guardados.";
				$uploadOk = 0;
			}
                // Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			                    // echo "Lo siento, tu archivo no se pudo guardarx2.";
			                // if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($arrayupfotos[$i]["tmp_name"], $target_file)) {
					"The file ". basename($arrayupfotos[$i]["name"]). " has been uploaded.";
			                         //TERMINA SUBIR IMAGEN AL SERVIDOR
				} else {
			                        // echo "Lo siento, hubo un error al subir el archivo.";
				}
			}
		}
	}

}

?>