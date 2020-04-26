<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tipos de movimientos de caja</title>
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
    <h1 class="text-left" id="h1-tab-titulo">TIPOS DE MOVIMIENTOS DE CAJA</h1>

    <div>
      <a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>tipomovcaja/nuevo"><span class="icon-plus"></span> Nuevo</a>
    </div>
        <hr>
    <table class="table table-hover text-center"><!-- agregar a la clase table-responsive si tabla es muy larga en columnas o el contenido de las filas e smuy larga -->
            <thead class="thead-tabla">
                <tr>
                  <!-- <th>Id</th> -->
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Fecha de registro</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                </tr>
            </thead>
            <tbody id="tbody-general">
                <?php
                    include_once 'models/tipomovcaja.php';
                    foreach($this->tipomovcaja as $row){
                        $tipomovcaja = new TypeMovCaja();
                        $tipomovcaja = $row; 
                ?>
                <tr id="fila-<?php echo $tipomovcaja->id_tipo_mov_caja; ?>">
                    <td><?php echo $tipomovcaja->nombreMovCaja;?></td>
                    <td><?php echo $tipomovcaja->descripcionMovCaja;?></td>
                    <td><?php $fecha=$tipomovcaja->fecha_alta; $date = date("d/m/Y H:i:s", strtotime($fecha)); echo $date;?></td>
                    <td><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'tipomovcaja/verTipoMovCaja/' . $tipomovcaja->id_tipo_mov_caja; ?>"><span class="icon-pencil2"></span></a></td>
                    <td><a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $tipomovcaja->id_tipo_mov_caja;?>" data-function="tipomovcaja/eliminarTipoMovCaja"><span class="icon-bin"></span></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
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
