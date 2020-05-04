<?php 
  include_once 'models/producto.php';
  if(!empty($this->productos)){
?>

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
      $producto = new Product();
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

<?php 
}else{
?>
<div class="col-md-10">
  <hr>
  <table class="table table-hover text-center">
    <thead class="thead-tabla">
      <tr>
       <th><div>La busqueda NO coincide con ningún producto de nuestra lista!</div></th>
     </tr>
   </thead>
   <tbody id="tbody-general">
      <tr>
        <td><div>Intente con algúna otra palabra!</div></td>
      </tr>    
  </tbody>
</table>
</div>
<?php 
}
?>