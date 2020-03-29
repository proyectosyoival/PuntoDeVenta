<?php

class departamento extends Controller{

  function __construct(){
    parent::__construct();
    $this->view->mensaje =[];
  }

  function render(){
  $this->view->render('departamento/index');
  }

  function nuevoDepartamento(){
    $nombreDepa = $_POST['nombreDepa'];
    $estadoDepa = $_POST['estadoDepa'];
    $fecha_alta = $_POST['fecha_alta'];

    $mensaje = "";

    if ($this->model->insert(['nombreDepa' =>$nombreDepa, 'estadoDepa' => $estadoDepa, 'fecha_alta' => $fecha_alta])) {
      echo "Departamento creado exitosamente";
    }else{
      $mensaje ="El departamento ya existe";
    }
    $this->view->mensaje = $mensaje;
    $this-> render();
  }
}

?>
