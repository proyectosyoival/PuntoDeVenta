<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Empleados</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>
  <?php include 'views/mensajes.php'; ?>
	<div class="container-fluid">
    <!-- <div class="alert alert-dismissible fade show col-md-4 text-center respuestaf" id="msj-error-login" role="alert" d" hidden="true">
      <strong><?php echo $error_eliminar?></strong>
      <button type="button" class="close" id="btn-cerrar" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="alert alert-dismissible fade show col-md-4 text-center respuestat" id="msj-error-login" role="alert" style="background-color: green" hidden="true">
      <strong><?php echo $exit_eliminar?></strong>
      <button type="button" class="close" id="btn-cerrar" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> -->
    <div class="text-left" id="respuesta"></div>
		<h1 class="text-left" id="h1-tab-titulo">EMPLEADOS</h1>
    <div>
      <a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>persona/nuevo"><span class="icon-plus"></span> Nuevo</a>
    </div>
        <hr>
		<!-- inicio de carvies -->
    <div class="row" id="cards">
        <div class="row row-cols-1 row-cols-md-3">
          <?php
                    include_once 'models/persona.php';
                    foreach($this->personas as $row){
                        $personas = new Personas();
                        $personas = $row; 
           ?>
            <div class="col mb-4">
                <div class="card">
                    <div class="card-header text-center" id="card-header2">
                    <?php 
                      if (empty($personas->foto)) { ?>
                         <a href="<?php echo constant('URL'); ?>img/empleados/<?php echo $personas->foto?>"><img src="<?php echo constant('URL'); ?>public/img/userlogin2.png" class="card-img-top text-center" title="SIN FOTO"></a>
                      <?php }else{ ?>
                          <a href="<?php echo constant('URL'); ?>img/empleados/<?php echo $personas->foto?>"><img src="<?php echo constant('URL'); ?>img/empleados/<?php echo $personas->foto?>" class="card-img-top text-center" title="<?php echo $personas->nombrePers;?>"></a>
                     <?php } ?>
                     <h5 class="text-center"><?php echo $personas->nombrePers." ".$personas->apellido;?></h5>
                     <button class="btn btn-primary" id="btn-vermas"type="button" data-toggle="collapse" data-target="#collapse<?php echo $personas->num_empleado;?>" aria-expanded="false" aria-controls="collapse<?php echo $personas->num_empleado;?>">
                      <span class="icon-plus"></span> Informacion
                    </button>
                   </div>
                    <div class="collapse" id="collapse<?php echo $personas->num_empleado;?>">
                      <div class="card-body" id="card-body">
                          <p class="text-center"><span class="label-card">Núm. empleado:</span><?php echo " ".$personas->num_empleado;?></p>
                          <p class="text-center"><span class="label-card">Fecha de nacimiento:</span><?php $fecha=$personas->fecha_nac; $date = date("d/m/Y", strtotime($fecha)); echo " ".$date;?></p>
                          <p class="text-center"><span class="label-card">Dirección:</span><?php echo " ".$personas->direccion;?></p>
                          <p class="text-center"><span class="label-card">Teléfono:</span><?php echo " ".$personas->telefono;?></p>
                          <p class="text-center"><span class="label-card">Usuario:</span><?php echo " ".$personas->usuario;?></p>
                          <?php
                    $id_rol=$personas->id_rol;
                    //sacar los nombres de la tabla de roles
                    $db= new Database();
                    $query = $db->connect()->prepare('SELECT * FROM rol WHERE id_rol=:id_rol');
                    $query->execute(['id_rol' => $id_rol]);
                    foreach ($query as $row) {
                      $nombreRol=$row['nombreRol'];           
                    } ?>
                    <p class="text-center"><span class="label-card">Rol:</span><?php echo " ".$nombreRol;?></p>
                    <p class="text-center"><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'persona/verPersona/' . $personas->id_persona; ?>" title="Editar"><span class="icon-pencil2"></span></a>
                      <a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $personas->id_persona;?>" data-function="persona/eliminarPersona"><span class="icon-bin" title="Eliminar"></span></a></p>
                    </div>
                    </div>
                </div>
            </div>
          <?php } ?>
        </div>
        <!-- fin cards -->
    </div>
	</div>
    <!-- Modal -->
    <!-- <div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" id="modal-header">
            <h5 class="modal-title text-center" id="exampleModalCenterTitle">Eliminar Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            ¿Estas seguro que desea eliminar el registro?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" id="btn-cancelar-modal" data-dismiss="modal" class="bEliminar" data-matricula="<?php echo $alumno->matricula; ?>">No</button>
            <a type="button" class="btn btn-danger" href="<?php echo constant('URL'); ?>controllers/logout.php">Eliminar</a>
          </div>
        </div>
      </div>
    </div> -->
    <!-- fin modal -->
    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
  </body>
  </html>
