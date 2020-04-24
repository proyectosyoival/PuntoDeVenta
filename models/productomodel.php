<?php

include_once 'models/producto.php';
include_once 'models/categoria.php';
include_once 'models/tipotela.php';
/**
 * 
 */
class ProductoModel extends Model{
	
	function __construct(){
		parent::__construct();
	}

	public function insert($datos){
		try {
            //Procedimiento para subir la imagen del producto.
            
            $foto = $datos['foto'];
            //Checar validacion
            if (empty($foto)) {
                echo "vacia";
                echo $foto;
            }

            $arrayupfotos=array();
            array_push($arrayupfotos, $foto);
            for ($i = 0; $i < count($arrayupfotos) ; $i++) { 
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
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
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
            //COMPROBAR EL NOMBRE DE FOTO Y COMPROBANTE SI VIENE VACIO
            if ($foto['name']=="") {
                $foto="";
            }else{
                 $foto = basename($foto["name"]);
            }            

            //Insercion de los datos a la bd.
			$query = $this->db->connect()->prepare("CALL procInsertNewProducto(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$query->bindParam(1, $datos['nombreProd']); 
            $query->bindParam(2, $datos['descripcionProd']);
            $query->bindParam(3, $datos['talla']);
            $query->bindParam(4, $datos['idtipotela']);
            $query->bindParam(5, $datos['descuento']);
            $query->bindParam(6, $datos['estadoProd']);
            $query->bindParam(7, $foto);
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
                $item->tipo_tela  			= $row[5];	//id_tipo_tela
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

    public function getTipostelaForProduct(){
        $items = [];

        try {

            $query = $this->db->connect()->query("CALL procGetAllTipostela();");

            while ($row = $query->fetch()) {
                $item = new Categoria();
                $item->id_tipo_tela     = $row[0]; //id_categoria
                $item->nombreTipoTela   = $row[1]; //nombreCate
                array_push($items, $item);
            }
            
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }   

    public function getCategoriesForProduct(){
        $items = [];

        try {

            $query = $this->db->connect()->query("CALL procGetAllCategorias();");

            while ($row = $query->fetch()) {
                $item = new Categoria();
                $item->id_categoria     = $row[0]; //id_categoria
                $item->nombreCate       = $row[1]; //nombreCate
                array_push($items, $item);
            }
            
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getProductById($id_producto){
      $item = new Producto();

        $query = $this->db->connect()->prepare("CALL procGetSelectedProduct(?);");
        $query->bindParam(1, $id_producto);
        $query->execute();

        try{

            while($row = $query->fetch()){
                $item->id_producto          = $row[0];  //id_producto
                $item->nombreProd           = $row[1];  //nombre
                $item->descripcionProd      = $row[2];  //descripcion
                $item->estadoProd           = $row[3];  //estado
                $item->talla                = $row[4];  //talla
                $item->tipo_tela            = $row[5];  //id_tipo_tela
                $item->foto                 = $row[6];  //foto
                $item->descuento            = $row[7];  //descuento
                $item->fecha_reg            = $row[8];  //fecha_reg
                $item->nombrePers           = $row[9];  //nombre persona quien registra
                $item->apellido             = $row[10]; //apellido persona quien registra
                $item->codigo_interno       = $row[11]; //codigo de barras interno
                $item->codigo_externo       = $row[12]; //codigo de barras externo
                $item->general              = $row[13]; //precio
                $item->cantidad             = $row[14]; //cantidad
                $item->nombreCate           = $row[15]; //categoria
                $item->proveedor            = $row[16]; //proveedor
                $item->id_codigo_de_barras  = $row[17]; //id del codigoo de barras
                $item->id_precio            = $row[18]; //id del precio
                $item->id_stock             = $row[19]; //id del stock
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function updateProd($datos){

        //Insercion de los datos a la bd.
        try{
            $query = $this->db->connect()->prepare("CALL procUpdateProducto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1, $datos['nombreProd']); 
            $query->bindParam(2, $datos['descripcionProd']);
            $query->bindParam(3, $datos['talla']);
            $query->bindParam(4, $datos['idtipotela']);
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
            $query->bindParam(15, $datos['id_producto']);
            $query->bindParam(16, $datos['id_codigo_de_barras']);
            $query->bindParam(17, $datos['id_precio']);
            $query->bindParam(18, $datos['id_stock']);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }


    }

}

?>