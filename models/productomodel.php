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

                //Insercion de los datos a la bd.
                $db = new  Database();
                $pdo = $this->db->connect();
                $pdo->beginTransaction();
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
                        //COMPROBAR EL NOMBRE DE FOTO Y COMPROBANTE SI VIENE VACIO
                        if ($foto['name']=="") {
                            $foto="";
                        }else{
                           $foto = basename($foto["name"]);
                       }

                        #Insertamos los codigos de barras.
                        $query = $pdo->prepare("INSERT INTO codigo_de_barras(codigo_interno, codigo_externo) VALUES(:codigointerno, :codigoexterno);");
                        $query->execute(['codigointerno' => $datos['codigointerno'], 'codigoexterno' => $datos['codigoexterno']]);
                        #Buscamos el id del codigo de barras que acabamos de insertar.
                        $query = $pdo->prepare("SELECT max(id_codigo_de_barras) FROM codigo_de_barras;");
                        $query->execute();
                            foreach ($query as $row) {
                            $id_cod_bar = $row[0]; #Este es el que utilizaremos para almacenarlo en la tabla Productos
                        }
                        #Traemos el ultimo (único) iva almacenado de la tabla IVA
                        $query = $pdo->prepare("SELECT max(id_iva) FROM iva;");
                        $query->execute();
                            foreach ($query as $row) {
                            $idIva = $row[0]; #Este es el que utilizaremos para almacenarlo en la tabla Precio
                        }
                        #Insertamos en la tabla Precio lo que son los campos de general(precio) y mayoreo
                        $query = $pdo->prepare("INSERT INTO precio(general, mayoreo, id_iva) VALUES(:precio, :mayoreo, :idIva);");
                        $query->execute(['precio' => $datos['precio'], 'mayoreo' => $datos['mayoreo'], 'idIva' => $idIva]);
                        #De la Tabla Precios traemos el ultimo id de los datos que se ingresan anteriormente.
                        $query = $pdo->prepare("SELECT max(id_precio) FROM precio;");
                        $query->execute();
                            foreach ($query as $row) {
                            $id_prec = $row[0]; #Este es el que utilizaremos para almacenarlo en la tabla Productos
                        }
                        #Ahora creamos el producto
                        $query = $pdo->prepare("INSERT INTO producto(descripcionProd, estadoProd, id_tipo_tela, proveedor, foto, descuento, id_persona, id_codigo_de_barras, id_precio, id_categoria, id_cat_tipo_prod, id_departamento) VALUES(:descripcionProd, :estadoProd, :idtipoTela, :proveedor, :foto, :descuento, :idPersona, :id_cod_bar, :id_prec, :idCategoria, :idCatTipoProd, :idDepartamento);");
                        $query->execute(['descripcionProd' => $datos['descripcionProd'], 'estadoProd' => $datos['estadoProd'], 'idtipoTela' => $datos['idtipotela'], 'proveedor' => $datos['proveedor'], 'foto' => $foto, 'descuento' => $datos['descuento'], 'idPersona' => $datos['idPersona'], 'id_cod_bar' => $id_cod_bar, 'id_prec' => $id_prec, 'idCategoria' => $datos['idcategoria'], 'idCatTipoProd' => $datos['idTipoProd'], 'idDepartamento' => $datos['idDepartamento']]);
                        #Los siguientes movimientos son los que ocupan el id del producto creado asi que lo recuperamos.
                        $query = $pdo->prepare("SELECT max(id_producto) FROM producto;");
                        $query->execute();
                            foreach ($query as $row) {
                            $idProd = $row[0]; #Este es el que utilizaremos para almacenarlo en las diferentes tablas (stock, prod_talla, prom_pro)
                        }
                        #Ya que tenemos el id del producto lo registramos en la tabla prod_talla junto con las tallas y su stock correspondiente al mismo tiempo.
                        $id_talla = $datos['id_talla'];
                        $cantidad = $datos['cantidad'];
                            for($i = 0; $i < count($cantidad); $i++)
                            {
                                    $query = $pdo->prepare("INSERT INTO prod_talla (id_producto, id_talla) VALUES(:idProd, :idTalla);");
                                    $query->execute(['idProd' => $idProd, 'idTalla' => $id_talla[$i]]);

                                    #Traemos el id del ultimo dato ingresado en la tabla prod_talla para vincularlo con stok
                                    $query = $pdo->prepare("SELECT max(id_prod_talla) FROM prod_talla;");
                                    $query->execute();
                                        foreach ($query as $row) {
                                        $idProdTalla = $row[0]; #Este es el que utilizaremos para vincluar prod_talla con stock
                                    }
                                    #Al macenamos la cantidad correspondiente en stock.
                                    $query = $pdo->prepare("INSERT INTO stock(cantidad, cantidad_real, id_prod_talla) VALUES(:cantidad, 0, :idProdTalla);");
                                    $query->execute(['cantidad' => $cantidad[$i], 'idProdTalla' => $idProdTalla]);
                            }            
                        #Ya solo queda insertar si es que el producto tiene promocion o no.
                        $query = $pdo->prepare("INSERT INTO prom_pro(id_promocion, id_producto) VALUES(:idPromocion, :idProd);");
                        $query->execute(['idPromocion' => $datos['id_promocion'], 'idProd' => $idProd]);
                        #>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><<CHECAR LA TRANSACTION
                       
                        $pdo->commit();
                        return true;
                } catch (PDOException $e) {
                    $pdo->rollback();
                    return false;
                }
            }

                //Buscador dinámico envia toda la lista de productos existentes al index.
            public function getProducts(){
              $items = [];

              try{


                $query = $this->db->connect()->query("CALL procGetAllProductos();");

                while($row = $query->fetch()){
                    $item = new Producto();
                            $item->id_producto          = $row[0];  //id_producto
                            $item->descripcionProd      = $row[1];  //descripcion
                            $item->estadoProd           = $row[2];  //estado
                            $item->tipo_tela            = $row[3];  //id_tipo_tela
                            $item->foto                 = $row[4];  //foto
                            $item->descuento            = $row[5];  //descuento
                            $item->fecha_reg            = $row[6];  //fecha_reg
                            $item->nombrePers           = $row[7];  //nombre persona quien registra
                            $item->apellido             = $row[8];  //apellido persona quien registra
                            $item->codigo_interno       = $row[9];  //codigo de barras interno
                            $item->codigo_externo       = $row[10]; //codigo de barras externo
                            $item->general              = $row[11]; //precio
                            $item->mayoreo              = $row[12]; //mayoreo
                            $item->cantidad             = $row[13]; //cantidad
                            $item->nombreCate           = $row[14]; //categoria
                            $item->proveedor            = $row[15]; //proveedor
                            $item->nombreTipoProd       = $row[16]; //trae el nombre del tipo de producto
                            $item->nombreDepa           = $row[17]; //trae el nombre del departamento
                            $item->nombreTalla          = $row[18]; //trae le nombre de la talla -- 32 - G -32D
                            $item->nombrePromo          = $row[19]; //trae el nombre de la promocion
                            $item->descripcionPromo     = $row[20]; //Trae la descripcion de la promocion en turno.
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
                            $item->tipo_tela            = $row[3];  //id_tipo_tela
                            $item->foto                 = $row[4];  //foto
                            $item->descuento            = $row[5];  //descuento
                            $item->fecha_reg            = $row[6];  //fecha_reg
                            $item->nombrePers           = $row[7];  //nombre persona quien registra
                            $item->apellido             = $row[8];  //apellido persona quien registra
                            $item->codigo_interno       = $row[9];  //codigo de barras interno
                            $item->codigo_externo       = $row[10]; //codigo de barras externo
                            $item->general              = $row[11]; //precio
                            $item->mayoreo              = $row[12]; //mayoreo
                            $item->cantidad             = $row[13]; //cantidad
                            $item->nombreCate           = $row[14]; //categoria
                            $item->proveedor            = $row[15]; //proveedor
                            $item->nombreTipoProd       = $row[16]; //trae el nombre del tipo de producto
                            $item->nombreDepa           = $row[17]; //trae el nombre del departamento
                            $item->nombreTalla          = $row[18]; //trae le nombre de la talla -- 32 - G -32D
                            $item->nombrePromo          = $row[19]; //trae el nombre de la promocion
                            $item->descripcionPromo     = $row[20]; //Trae la descripcion de la promocion en turno.
                            array_push($items, $item);
                        }
                        return $items;
                    }catch(PDOException $e){
                        return [];
                    }
                }

                #Traemos los datos de los tipos de Tallas
                public function getTallas($tipoTalla){
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

                #Ésta funciÓn se utiliza para mostrar la info completa del producto
                #asi como para seleccionarlo y editarlo
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
                            $item->tipo_tela            = $row[3];  //id_tipo_tela
                            $item->foto                 = $row[4];  //foto
                            $item->descuento            = $row[5];  //descuento
                            $item->fecha_reg            = $row[6];  //fecha_reg
                            $item->nombrePers           = $row[7];  //nombre persona quien registra
                            $item->apellido             = $row[8];  //apellido persona quien registra
                            $item->codigo_interno       = $row[9]; //codigo de barras interno
                            $item->codigo_externo       = $row[10]; //codigo de barras externo
                            $item->general              = $row[11]; //precio
                            $item->mayoreo              = $row[12]; //mayoreo
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
                            $item->nombreTalla          = $row[24]; //nombre de la talla 32-G-32A
                            $item->nombrePromo          = $row[25]; //nombre de la promocion - 2x1
                            $item->descripcionPromo     = $row[26]; //descripcion de la promocion
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
                    $query = $db->connect()->prepare('SELECT foto, id_codigo_de_barras, id_precio FROM producto WHERE id_producto= :id_producto');
                    $query->execute(['id_producto' => $idProducto]);
                    foreach ($query as $row) {
                        $foto                   = $row['foto'];
                        $id_codigo_de_barras    = $row['id_codigo_de_barras'];
                        $id_precio              = $row['id_precio'];
                    }
                #Llamamos el StoreProcedure para eliminar el producto y sus dependientes.
                    $query = $this->db->connect()->prepare("CALL procDeleteProducto(?,?,?)");
                    try {
                        $query->bindParam(1, $idProducto);
                        $query->bindParam(2, $id_codigo_de_barras);
                        $query->bindParam(3, $id_precio);
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
