<?php

class Talla extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->tallas = [];
        
        //echo "<p>Nuevo controlador Main</p>";
    }

    function nuevo(){
        $this->view->render('talla/nuevo');
    }

    function render(){
        $tallas = $this->model->get();
        $this->view->tallas = $tallas;

        $this->view->render('talla/index');
    }

    function registrarTalla(){
        $nombreTalla = $_POST['nombreTalla'];
        $tipoTalla = $_POST['tipoTalla'];
        $mensaje = "";

        if($this->model->insert(['nombreTalla' => $nombreTalla, 'tipoTalla' => $tipoTalla])){
            // $mensaje = "IVA creado";
        }else{
            // $mensaje = "La matrícula ya existe";
        }
            $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verTalla($param = null){
        $id_talla = $param[0];
        $talla = $this->model->getById($id_talla);

        // session_start();
        $_SESSION['id_talla'] = $talla->id_talla;
        $this->view->talla = $talla;
        $this->view->mensaje = "";
        $this->view->render('talla/edit');
    }

    function actualizarTalla(){
        // session_start();
        $id_talla = $_SESSION['id_talla'];
        // echo $id_iva;
        $nombreTalla = $_POST['nombreTalla'];
        $tipoTalla = $_POST['tipoTalla'];

        // unset($_SESSION['id_iva']);

        if($this->model->update(['id_talla' => $id_talla, 'nombreTalla' => $nombreTalla, 'tipoTalla' => $tipoTalla ])){
            // actualizar alumno exito
            $talla = new Size();
            $talla->id_talla = $id_talla;
            $talla->nombreTalla = $nombreTalla;
            $talla->tipoTalla = $tipoTalla;
            
            $this->view->talla = $talla;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('talla/edit');
    }

    function eliminarTalla($param = null){
        $id_talla = $param[0];

        if($this->model->delete($id_talla)){
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