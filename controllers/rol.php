<?php

class Rol extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->roles = [];
        
        //echo "<p>Nuevo controlador Main</p>";
    }

    function nuevo(){
        $this->view->render('rol/nuevo');
    }

    function render(){
        $roles = $this->model->get();
        $this->view->roles = $roles;

        $this->view->render('rol/index');
    }

    function registrarRol(){
        $nombreRol = $_POST['nombreRol'];
        $descripcionRol = $_POST['descripcionRol'];
        $mensaje = "";

        if($this->model->insert(['nombreRol' => $nombreRol, 'descripcionRol' => $descripcionRol])){
            // $mensaje = "IVA creado";
        }else{
            // $mensaje = "La matrícula ya existe";
        }
            $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verRol($param = null){
        $id_rol = $param[0];
        $rol = $this->model->getById($id_rol);

        // session_start();
        $_SESSION['id_rol'] = $rol->id_rol;
        $this->view->rol = $rol;
        $this->view->mensaje = "";
        $this->view->render('rol/edit');
    }

    function actualizarRol(){
        // session_start();
        $id_rol = $_SESSION['id_rol'];
        // echo $id_iva;
        $nombreRol = $_POST['nombreRol'];
        $descripcionRol = $_POST['descripcionRol'];

        // unset($_SESSION['id_iva']);

        if($this->model->update(['id_rol' => $id_rol, 'nombreRol' => $nombreRol, 'descripcionRol' => $descripcionRol ])){
            // actualizar alumno exito
            $rol = new Roles();
            $rol->id_rol = $id_rol;
            $rol->nombreRol = $nombreRol;
            
            $this->view->rol = $rol;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('rol/edit');
    }

    function eliminarIva($param = null){
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