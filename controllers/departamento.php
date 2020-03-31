<?php

class departamento extends Controller{

  function _construct(){
    parent::_construct();
    $this->view->departamento =[];
  }

  function render(){
    $departamento = $this->model->getDepartamento();
    $this->view->departamento = $departamento;
    $this->view->render('departamento/index');
  }
  function nuevo(){
    $this->view->render('departamento/nuevo');
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
