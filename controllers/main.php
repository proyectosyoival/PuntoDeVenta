
<?php

class Main extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->menus = [];
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
    	$menus = $this->model->get();
        $this->view->menus = $menus;
    	$this->view->render('main/index');
    }

	function registrarMenu(){
        $porcentaje    = $_POST['porcentaje'];
        $mensaje = "";

        if($this->model->insert(['porcentaje' => $porcentaje])){
            $mensaje = "IVA creado";
        }else{
            // $mensaje = "La matrícula ya existe";
        }
            $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verMenu($param = null){
        $id_iva = $param[0];
        $iva = $this->model->getById($id_iva);

        // session_start();
        $_SESSION['id_iva'] = $iva->id_iva;
        $this->view->iva = $iva;
        $this->view->mensaje = "";
        $this->view->render('iva/edit');
    }

    function actualizarMenu(){
        // session_start();
        $id_iva = $_SESSION['id_iva'];
        // echo $id_iva;
        $porcentaje = $_POST['porcentaje'];

        // unset($_SESSION['id_iva']);

        if($this->model->update(['id_iva' => $id_iva, 'porcentaje' => $porcentaje] )){
            // actualizar alumno exito
            $iva = new Iv();
            $iva->id_iva = $id_iva;
            $iva->porcentaje = $porcentaje;
            
            $this->view->iva = $iva;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('iva/edit');
    }

    function eliminarMenu($param = null){
        $id_iva = $param[0];

        if($this->model->delete($id_iva)){
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