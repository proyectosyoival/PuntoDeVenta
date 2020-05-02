<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PRECIO</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>
  <?php include 'views/mensajes.php'; ?>
  <div class="container-fluid">
    <div class="text-left" id="respuesta"></div>
    <h1 class="text-left" id="h1-tab-titulo">PRECIO</h1>
   <hr>
   <table class="table table-hover text-center">
    <thead class="thead-tabla">
      <tr>
       <th>Id</th>
       <th>General</th>
       <th>Mayoreo</th>
       <th>Fecha de registro</th>
       <th>Editar</th>
       <!---<th>Eliminar</th>-->
     </tr>
   </thead>
   <tbody id="tbody-general">
    <?php
    include_once 'models/precio.php';
    foreach($this->precios as $row){
      $precio = new Price();
      $precio = $row; 
      ?>
      <tr id="fila-<?php echo $precio->id_precio; ?>">
        <td><?php echo $precio->id_precio; ?></td>
        <td>$<?php echo $precio->general;?></td>
        <td>$
          <?php
          $precioMayoreo = $precio->mayoreo;
          if($precioMayoreo == null)
           echo "0";
         else
          echo $precioMayoreo;
        ?>                            
      </td>
      <td><?php $fecha=$precio->fecha_alta; $date = date("d/m/Y H:i:s", strtotime($fecha)); echo $date;?></td>
      <td><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'precio/verPrecio/' . $precio->id_precio; ?>"><span class="icon-pencil2"></span></a></td>
      <!--<td><a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $precio->id_precio;?>" data-function="precio/eliminarPrecio"><span class="icon-bin"></span></a></td>-->
    </tr>
  <?php } ?>
</tbody>
</table>
</div>
<?php require 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>