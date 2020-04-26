<?php

class Departamento extends Controller{

  public function _construct(){
    parent::_construct();
    $this->view->departamento =[];
  }
  function nuevo(){
    $this->view->render('departamento/nuevo');
  }

  function render(){
    $departamento = $this->model->getDepto();
    $this->view->departamento = $departamento;
    $this->view->render('departamento/index');
  }

  function registrarDepto(){
    $nombreDepa = $_POST['nombreDepa'];
    $estadoDepa = $_POST['estadoDepa'];
    $nomenclaturaDep = $_POST['nomenclaturaDep'];
    $mensaje = "";

    if ($this->model->insert(['nombreDepa' =>$nombreDepa, 'estadoDepa' => $estadoDepa, 'nomenclaturaDep' => $nomenclaturaDep])) {
      // echo "Departamento creado exitosamente";
    }else{
      $mensaje ="El departamento ya existe";
    }
    $this->view->mensaje = $mensaje;
    $this-> render();
  }

  function verDepartamento($param = null){
    $id_departamento = $param[0];
    $departamento = $this->model->getById($id_departamento);

    $_SESSION['id_departamento'] = $departamento->id_departamento;
    $this->view->departamento = $departamento;
    $this->view->mensaje = "";
    $this->view->render('departamento/edit');
  }
   function actualizarDepto(){

    $id_departamento = $_SESSION['id_departamento'];

    $nombreDepa = $_POST['nombreDepa'];
    $estadoDepa = $_POST['estadoDepa'];
    $nomenclaturaDep = $_POST['nomenclaturaDep'];

    if ($this->model->update(['id_departamento'=>$id_departamento, 'nombreDepa'=> $nombreDepa, 'estadoDepa' => $estadoDepa, 'nomenclaturaDep' => $nomenclaturaDep ])) {

      $departamento = new Depto();
      $departamento->id_departamento = $id_departamento;
      $departamento->nombreDepa = $nombreDepa;
      $departamento->estadoDepa = $estadoDepa;
      $departamento->nomenclaturaDep = $nomenclaturaDep;
      $this->view->departamento = $departamento;
      $this->view->mensaje = "Registro actualizado correctamente";
    }else {
      $this->view->mensaje = "No se pudo actualizar el registro correctamente";
    }
    $this->view->render('departamento/edit');
   }

   function deletDepto($param = null){
       $id_departamento = $param[0];

       if($this->model->delete($id_departamento)){
           $mensaje = 1;
       }else{
           $mensaje = 0;
       }
       echo $mensaje;
   }
}

?>
