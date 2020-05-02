<?php

class TipoMovCaja extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->tipomovcaja = [];
        
        //echo "<p>Nuevo controlador Main</p>";
    }

    function nuevo(){
        $this->view->render('tipomovcaja/nuevo');
    }

    function render(){
        $tipomovcaja = $this->model->get();
        $this->view->tipomovcaja = $tipomovcaja;

        $this->view->render('tipomovcaja/index');
    }

    function registrarTipoMovCaja(){
        $nombreMovCaja = $_POST['nombreMovCaja'];
        $descripcionMovCaja = $_POST['descripcionMovCaja'];
        $mensaje = "";

        if($this->model->insert(['nombreMovCaja' => $nombreMovCaja, 'descripcionMovCaja' => $descripcionMovCaja])){
            // $mensaje = "IVA creado";
        }else{
            // $mensaje = "La matrícula ya existe";
        }
            $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verTipoMovCaja($param = null){
        $id_tipo_mov_caja = $param[0];
        $tipomovcaja = $this->model->getById($id_tipo_mov_caja);

        // session_start();
        $_SESSION['id_tipo_mov_caja'] = $tipomovcaja->id_tipo_mov_caja;
        $this->view->tipomovcaja = $tipomovcaja;
        $this->view->mensaje = "";
        $this->view->render('tipomovcaja/edit');
    }

    function actualizarTipoMovCaja(){
        // session_start();
        $id_tipo_mov_caja = $_SESSION['id_tipo_mov_caja'];
        // echo $id_iva;
        $nombreMovCaja = $_POST['nombreMovCaja'];
        $descripcionMovCaja = $_POST['descripcionMovCaja'];

        // unset($_SESSION['id_iva']);

        if($this->model->update(['id_tipo_mov_caja' => $id_tipo_mov_caja, 'nombreMovCaja' => $nombreMovCaja, 'descripcionMovCaja' => $descripcionMovCaja ])){
            // actualizar alumno exito
            $tipomovcaja = new TypeMovCaja();
            $tipomovcaja->id_tipo_mov_caja = $id_tipo_mov_caja;
            $tipomovcaja->nombreMovCaja = $nombreMovCaja;
            $tipomovcaja->descripcionMovCaja = $descripcionMovCaja;
            
            $this->view->tipomovcaja = $tipomovcaja;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('tipomovcaja/edit');
    }

    function eliminarTipoMovCaja($param = null){
        $id_rol = $param[0];

        if($this->model->delete($id_rol)){
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