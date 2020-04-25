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

    <div class="col-md-3">
      <label>Buscar:</label>
      <input type="search" name="">
    </div>
  </div>
  <div class="row">
    <div class="col-md-10">
      <hr>
      <table class="table table-hover text-center">
        <thead class="thead-tabla">
          <tr>
           <th><div>Código</div></th>
           <!--<th>Prodcuto</th>-->
           <th><div align="left">Descripcion</div></th>
           <th><div>Precio</div></th>
           <th><div>Existencia</div></th>
           <th><div>Proveedor</div></th>
           <th><div>Foto</div></th>
           <th><div>Editar</div></th>
           <th><div>Eliminar</div></th>
         </tr>
       </thead>
       <tbody id="tbody-general">
        <?php
        include_once 'models/producto.php';
        foreach($this->productos as $row){
          $producto = new Producto();
          $producto = $row; 
          ?>
          <tr id="fila-<?php echo $producto->id_producto; ?>">
            <td><div onclick="ShowModal(<?php echo $producto->id_producto; ?>)" ><?php echo $producto->id_producto; ?></div></td>
            <td><div align="left"><?php echo $producto->descripcionProd; ?></div></td>
            <td><div align="right">$<?php echo $producto->general; ?></div></td>
            <td><div><?php echo $producto->cantidad; ?></div></td>
            <td><div><?php echo $producto->proveedor; ?></div></td>
            <td><div><img src="<?php echo constant('URL'); ?>img/productos/<?php echo $producto->foto; ?>" class="img-responsive" width="50"  title="<?php echo $producto->descripcionProd; ?>"></div></td>
            <td><div><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'producto/editProduct/' . $producto->id_producto; ?>"><span class="icon-pencil2"></span></a></div></td>
            <td><div><a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $producto->id_producto;?>" data-function="producto/eliminarProducto"><span class="icon-bin" title="Eliminar"></span></a></div></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
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
<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>