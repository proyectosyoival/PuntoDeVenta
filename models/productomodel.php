<?php

include_once 'models/producto.php';
include_once 'models/categoria.php';
include_once 'models/tipotela.php';
include_once 'models/tipoProducto.php';
include_once 'models/departamento.php';
include_once 'models/talla.php';
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
                    //echo "vacia";
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
     $query = $this->db->connect()->prepare("CALL procInsertNewProducto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
     $query->bindParam(1, $datos['descripcionProd']);
     $query->bindParam(2, $datos['talla']);
     $query->bindParam(3, $datos['idtipotela']);
     $query->bindParam(4, $datos['descuento']);
     $query->bindParam(5, $datos['estadoProd']);
     $query->bindParam(6, $foto);
     $query->bindParam(7, $datos['idPersona']);
     $query->bindParam(8, $datos['codigointerno']);
     $query->bindParam(9, $datos['codigoexterno']);
     $query->bindParam(10, $datos['precio']);
     $query->bindParam(11, $datos['cantidad']);
     $query->bindParam(12, $datos['idcategoria']);
     $query->bindParam(13, $datos['proveedor']);
     $query->bindParam(14, $datos['idTipoProd']);
     $query->bindParam(15, $datos['idDepartamento']);
     $query->execute();
     return true;
 } catch (PDOException $e) {
   return false;
}
}

#Buscador dinámico envia toda la lista de productos existentes al index.
public function getProducts(){
  $items = [];

  try{


    $query = $this->db->connect()->query("CALL procGetAllProductos();");

    while($row = $query->fetch()){
        $item = new Producto();
                $item->id_producto          = $row[0];  //id_producto
                $item->descripcionProd      = $row[1];  //descripcion
                $item->estadoProd           = $row[2];  //estado
                $item->talla                = $row[3];  //talla
                $item->tipo_tela            = $row[4];  //id_tipo_tela
                $item->foto                 = $row[5];  //foto
                $item->descuento            = $row[6];  //descuento
                $item->fecha_reg            = $row[7];  //fecha_reg
                $item->nombrePers           = $row[8];  //nombre persona quien registra
                $item->apellido             = $row[9];  //apellido persona quien registra
                $item->codigo_interno       = $row[10]; //codigo de barras interno
                $item->codigo_externo       = $row[11]; //codigo de barras externo
                $item->general              = $row[12]; //precio
                $item->cantidad             = $row[13]; //cantidad
                $item->nombreCate           = $row[14]; //categoria
                $item->proveedor            = $row[15]; //proveedor
                $item->nombreTipoProd       = $row[16]; //trae el nombre del tipo de producto
                $item->nombreDepa           = $row[17]; //trae el nombre del departamento
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    #Buscador dinámico envia los productos buscados en index.
    public function getSearchProducts($searchProd){
        $items = [];

        try{

           $query = $this->db->connect()->prepare("CALL procGetSearchProduct(?);");
           $query->bindParam(1, $searchProd);
           $query->execute();

           while($row = $query->fetch()){
            $item = new Producto();
                $item->id_producto          = $row[0];  //id_producto
                $item->descripcionProd      = $row[1];  //descripcion
                $item->estadoProd           = $row[2];  //estado
                $item->talla                = $row[3];  //talla
                $item->tipo_tela            = $row[4];  //id_tipo_tela
                $item->foto                 = $row[5];  //foto
                $item->descuento            = $row[6];  //descuento
                $item->fecha_reg            = $row[7];  //fecha_reg
                $item->nombrePers           = $row[8];  //nombre persona quien registra
                $item->apellido             = $row[9];  //apellido persona quien registra
                $item->codigo_interno       = $row[10]; //codigo de barras interno
                $item->codigo_externo       = $row[11]; //codigo de barras externo
                $item->general              = $row[12]; //precio
                $item->cantidad             = $row[13]; //cantidad
                $item->nombreCate           = $row[14]; //categoria
                $item->proveedor            = $row[15]; //proveedor
                $item->nombreTipoProd       = $row[16]; //trae el nombre del tipo de producto
                $item->nombreDepa           = $row[17]; //trae el nombre del departamento
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getTallas($tipoTalla){
    #Traemos los datos de los tipos de Tallas
        $items = [];
        try {

            $db = new Database();               
            $query = $db->connect()->prepare('SELECT id_talla, nombreTalla FROM talla WHERE tipoTalla LIKE :tipoTalla');
            $query->execute(['tipoTalla' => $tipoTalla]);
            
            while ($row = $query->fetch()) {
                $item = new Size();
                $item->id_talla       = $row[0];
                $item->nombreTalla    = $row[1];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getTiposProdForProduct(){
        $items = [];

        try {

            $query = $this->db->connect()->query("CALL procGetAllTiposProd();");

            while ($row = $query->fetch()) {
                $item = new TipoProduct();
                $item->id_cat_tipo_prod     = $row[0]; //id_catalogo tipo de producto
                $item->nombreTipoProd       = $row[1]; //nomvre del tipo de producto
                $item->nomenclaturaTipoProd = $row[2]; //nomenclatura del tipo de producto 001 etc.
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getDepartamentForProduct(){
        $items = [];

        try {
            $query = $this->db->connect()->query("CALL procGetAllDepartamentos();");

            while ($row = $query->fetch()) {
                $item = new Depto();
                $item->id_departamento  = $row[0]; //id del departamento
                $item->nombreDepa       = $row[1]; //nombre del departamento
                $item->nomenclaturaDep  = $row[3]; //nomenclatura del departamento C = CABALLERO, D = DAMA... etc.
                array_push($items, $item);
            }

            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getTipostelaForProduct(){
        $items = [];

        try {

            $query = $this->db->connect()->query("CALL procGetAllTipostela();");

            while ($row = $query->fetch()) {
                $item = new Cate();
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
                $item = new Cate();
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
                $item->descripcionProd      = $row[1];  //descripcion
                $item->estadoProd           = $row[2];  //estado
                $item->talla                = $row[3];  //talla
                $item->tipo_tela            = $row[4];  //id_tipo_tela
                $item->foto                 = $row[5];  //foto
                $item->descuento            = $row[6];  //descuento
                $item->fecha_reg            = $row[7];  //fecha_reg
                $item->nombrePers           = $row[8];  //nombre persona quien registra
                $item->apellido             = $row[9]; //apellido persona quien registra
                $item->codigo_interno       = $row[10]; //codigo de barras interno
                $item->codigo_externo       = $row[11]; //codigo de barras externo
                $item->general              = $row[12]; //precio
                $item->cantidad             = $row[13]; //cantidad
                $item->nombreCate           = $row[14]; //categoria
                $item->proveedor            = $row[15]; //proveedor
                $item->id_codigo_de_barras  = $row[16]; //id del codigoo de barras
                $item->id_precio            = $row[17]; //id del precio
                $item->id_stock             = $row[18]; //id del stock
                $item->id_cat_tipo_prod     = $row[19]; //id del cat tipo de producto
                $item->nombreTipoProd       = $row[20]; //nombre del tipo de producto -> PANTALON, CHAMARRA, ETC.
                $item->id_departamento      = $row[21]; //id del departamento
                $item->nombreDepa           = $row[22]; //nombre del deapartamento -> DAMA, CABALLERO
                $item->nomenclaturaDep      = $row[23]; //nomenclatura del departamento D = DAMA, C = CABALLERO... ETC.
            }
            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function updateProd($datos){

        //Insercion de los datos a la bd.
        try{
            $query = $this->db->connect()->prepare("CALL procUpdateProducto(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->bindParam(1,  $datos['id_producto']);
            $query->bindParam(2,  $datos['descripcionProd']);
            $query->bindParam(3,  $datos['talla']);
            $query->bindParam(4,  $datos['idtipotela']);
            $query->bindParam(5,  $datos['descuento']);
            $query->bindParam(6,  $datos['estadoProd']);
            $query->bindParam(7,  $datos['foto']);
            $query->bindParam(8,  $datos['idPersona']);
            $query->bindParam(9,  $datos['id_codigo_de_barras']);
            $query->bindParam(10, $datos['codigointerno']);
            $query->bindParam(11, $datos['codigoexterno']);
            $query->bindParam(12, $datos['id_precio']);
            $query->bindParam(13, $datos['precio']);
            $query->bindParam(14, $datos['id_stock']);
            $query->bindParam(15, $datos['cantidad']);
            $query->bindParam(16, $datos['idcategoria']);
            $query->bindParam(17, $datos['proveedor']);
            $query->bindParam(18, $datos['idTipoProd']);
            $query->bindParam(19, $datos['idDepartamento']);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }


    }

    public function deleteProduct($idProducto){
        #Traemos el dato para poder eliminar la foto del producto
        $db = new Database();
        $query = $db->connect()->prepare('SELECT foto, id_codigo_de_barras, id_precio, id_stock FROM producto WHERE id_producto= :id_producto');
        $query->execute(['id_producto' => $idProducto]);
        foreach ($query as $row) {
            $foto                   = $row['foto'];
            $id_codigo_de_barras    = $row['id_codigo_de_barras'];
            $id_precio              = $row['id_precio'];
            $id_stock               = $row['id_stock'];
        }
        #Llamamos el StoreProcedure para eliminar el producto y sus dependientes.
        $query = $this->db->connect()->prepare("CALL procDeleteProducto(?,?,?,?)");
        try {
            $query->bindParam(1, $idProducto);
            $query->bindParam(2, $id_codigo_de_barras);
            $query->bindParam(3, $id_precio);
            $query->bindParam(4, $id_stock);
            $query->execute();

            #Si se eliminaron todos los datos correctamente entonces si borramos la imagen.
             @unlink('img/productos/'.$foto);

            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

}

?>
