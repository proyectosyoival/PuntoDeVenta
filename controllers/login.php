
<?php

class Login extends Controller{

    function __construct(){
        parent::__construct();
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $this->view->render('login/index');
    }
    
    function checkLogin(){
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $mensaje = "";

        if($this->model->selectlogin(['usuario' => $usuario, 'contrasena' => $contrasena])){
        echo "Nuevo alumno creado";
        }else{
            $mensaje = "La matrícula ya existe";
        }

        $this->view->mensaje = $mensaje;
        $this->render();
    }
}

?>