<?php

class Iva extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->iva = [];
        
        //echo "<p>Nuevo controlador Main</p>";
    }

    function nuevo(){
        $this->view->render('iva/nuevo');
    }

    function render(){
        $iva = $this->model->get();
        $this->view->iva = $iva;

        $this->view->render('iva/index');
    }

    function registrarIva(){
        $porcentaje    = $_POST['porcentaje'];
        $fecha_alta  = date('d/m/Y H:i:s');

        $mensaje = "";

        if($this->model->insert(['porcentaje' => $porcentaje, 'fecha_alta' => $fecha_alta])){
            $mensaje = "IVA creado";
        }else{
            // $mensaje = "La matrícula ya existe";
        }
            $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verIva($param = null){
        $idAlumno = $param[0];
        $alumno = $this->model->getById($idAlumno);

        session_start();
        $_SESSION['id_iva'] = $iva->id_iva;
        $this->view->iva = $iva;
        $this->view->mensaje = "";
        $this->view->render('iva/index');
    }

    function actualizarAlumno(){
        session_start();
        $id_iva = $_SESSION['id_iva'];
        $porcentaje    = $_POST['porcentaje'];

        unset($_SESSION['id_iva']);

        if($this->model->update(['id_iva' => $id_iva, 'porcentaje' => $porcentaje] )){
            // actualizar alumno exito
            $iva = new Iva();
            $iva->id_iva = $id_iva;
            $iva->porcentaje = $porcentaje;
            
            $this->view->iva = $iva;
            // $this->view->mensaje = "Alumno actualizado correctamente";
        }else{
            // mensaje de error
            // $this->view->mensaje = "No se pudo actualizar el alumno";
        }
        $this->view->render('iva/index');
    }

    function eliminarIva($param = null){
        $id_iva = $param[0];

        if($this->model->delete($id_iva)){
            // $this->view->mensaje = "Alumno eliminado correctamente";
            $mensaje = "Iva eliminado correctamente";
        }else{
            // mensaje de error
            // $this->view->mensaje = "No se pudo eliminar el alumno";
            $mensaje = "No se pudo eliminar el Iva";
        }
        // $this->render();
        
        echo $mensaje;
    }
}

?>