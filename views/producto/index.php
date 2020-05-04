<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Productos</title>
</head>
<body>
  <?php require 'views/header.php'; ?>
  <?php require 'views/menu.php'; ?>

  <div class="container-fluid">
   <div id="respuesta" class="center">
   </div>
   <h1 class="text-left" id="h1-tab-titulo">PRODUCTO</h1>

   <div class="row">
     <div class="col-md-7">
      <a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>producto/nuevo"><span class="icon-plus"></span>Nuevo</a>
    </div>
    <div class="form-group row">
      <label class="col-md-3">Buscar:</label>
      <div class="col-md-9">
        <input type="search" name="caja_busqueda" id="caja_busqueda" class="form-control"></input>
      </div>
    </div>
  </div>

  <!--Inicia el contenedor de la busqueda dinámica -->
  <div class="row" id="datos">
    <!-- Aquí va la tabla de la busqueda dinámica -->
  </div>
  <!--Termina el contenedor de la busqueda dinámica -->

</div>
<!-- Modal -->
<div class="modal fade" id="masInformacionProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" id="modal-header">
        <h8 class="modal-title text-center" id="exampleModalCenterTitle">+Información</h8>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">

        <!--Inicia contenedor del modal -->
        <div id="modalContainer">
          <!-- EN ESTE DIV SE MUESTRA EL CONTENIDO DE LA PAG getViewProduct.php -->
        </div>
        <!--Termina contenedor del modal -->

      </div>
    </div>
  </div>
</div>
<!-- fin modal -->
<?php require 'views/footer.php'; ?>
<!-- <script src="<?php echo constant('URL'); ?>public/js/main.js"></script> -->
</body>
</html>
