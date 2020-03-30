<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Iva</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>
  <?php include 'views/mensajes.php'; ?>
	<div class="container-fluid">



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
