<?php

class Promociones extends Controller{

  function __construct(){
      parent::__construct();
      $this->view->promocion = [];

      //echo "<p>Nuevo controlador Main</p>";
  }

  function nuevo(){
      $this->view->render('promociones/nuevo');
  }

  function render(){
      $promocion = $this->model->getPromo();
      $this->view->promocion= $promocion;

      $this->view->render('promociones/index');
  }

  function registrarPromo(){
      $nombrePromo = $_POST['nombrePromo'];
      $descripcionPromo = $_POST['descripcionPromo'];
      $fecha_vigencia = $_POST['fecha_vigencia'];
      $mensaje = "";

      if($this->model->insert(['nombrePromo' => $nombrePromo, 'descripcionPromo' => $descripcionPromo, 'fecha_vigencia' => $fecha_vigencia])){
          // $mensaje = "IVA creado";
      }else{
          // $mensaje = "La matrícula ya existe";
      }
          $this->view->mensaje = $mensaje;
          $this->render();
  }

  function verPromocion($param = null){
      $id_promocion = $param[0];
      $promocion = $this->model->getById($id_promocion);

      // session_start();
      $_SESSION['id_promocion'] = $promocion->id_promocion;
      $this->view->promocion = $promocion;
      $this->view->mensaje = "";
      $this->view->render('promociones/edit');
  }

  function actualizarPromo(){
      // session_start();
      $id_promocion = $_SESSION['id_promocion'];
  		$nombrePromo = $_POST['nombrePromo'];
  		// echo $nombreCate;
  		$descripcionPromo = $_POST['descripcionPromo'];
  		$fecha_vigencia =  $_POST['fecha_vigencia'];
      // unset($_SESSION['id_iva']);

      if($this->model->update(['id_promocion' => $id_promocion, 'nombrePromo' => $nombrePromo, 'descripcionPromo' => $descripcionPromo, 'fecha_vigencia' => $fecha_vigencia ])){
          // actualizar alumno exito
          $promocion = new Promo();
          $promocion->id_promocion = $id_promocion;
          $promocion->nombrePromo = $nombrePromo;
          $promocion->descripcionPromo = $descripcionPromo;
          $promocion->fecha_vigencia = $fecha_vigencia;

          $this->view->promocion = $promocion;
          $this->view->mensaje = "Registro actualizado correctamente";
      }else{
          // mensaje de error
          $this->view->mensaje = "No se pudo actualizar el registro";
      }
      $this->view->render('promociones/edit');
  }

  function eliminarPromo($param = null){
      $id_promocion = $param[0];

      if($this->model->delete($id_promocion)){
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
