<?php 

/**
 * 
 */
class Precio extends Controller{
	
	function __construct(){
        parent::__construct();
        
        $this->view->menus = [];
        
    }

    function nuevo(){
       $this->view->render('precio/nuevo');
    }

    function render(){
        $precio = $this->model->getAllPrecios();
        $this->view->precios = $precio;
        $this->view->render('precio/index');
    }

    #EVITAREMOS ADICIONAR LA FUNCION DE INSERCION YA QUE ESTA SE HACE
	#DESDE EL APARTADO DE PRODUCTOS.

    function verPrecio($param = null){
        $id_precio = $param[0];
        $precio = $this->model->getPrecioById($id_precio);

        $_SESSION['id_precio'] = $precio->id_precio;
        $this->view->precio = $precio;
        $this->view->mensaje = "";
        $this->view->render('precio/edit');
    }

    function actualizarPrecio(){
        $id_precio = $_SESSION['id_precio'];
        $general = $_POST['precioGeneral'];
        $mayoreo = $_POST['precioMayoreo'];

        if($this->model->updatePrecio(['id_precio' => $id_precio, 'general' => $general, 'mayoreo' => $mayoreo] )){
            $precio = new Price();
            $precio->id_precio = $id_precio;
            $precio->general = $general;
            $precio->mayoreo = $mayoreo;

            $this->view->precio = $precio;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('precio/edit');
    }

    function eliminarPrecio($param = null){
        $id_precio = $param[0];

        if($this->model->deletePrecio($id_precio)){
            $mensaje = 1;
        }else{            
            $mensaje = 0;
        }        
        echo $mensaje;
    }
}

?>