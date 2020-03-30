<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iva</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <?php require 'views/menu.php'; ?>

<div class="container-fluid">
     <div id="respuesta" class="center">
     </div>
     <h1 class="text-left" id="h1-tab-titulo">PRODUCTO</h1>

     <div>
        <a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>producto/nuevo"><span class="icon-plus"></span> Nuevo</a>
    </div>
<hr>
<table class="table table-hover text-center">
    <thead class="thead-tabla">
        <tr>
           <!--<th>Id</th>-->
           <th>Prodcuto</th>
           <th>Descripcion</th>
           <th>Estado</th>
           <th>Talla</th>
           <th>Tela</th>
           <th>Foto</th>
           <th>Descuento</th>
           <th>Fecha Registro</th>
           <th>Registró</th>
           <th>Cod Barras Int</th>
           <th>Cod Barras Ext</th>
           <th>Precio</th>
           <th>Proveedor</th>
           <th>Editar</th>
           <th>Eliminar</th>
       </tr>
   </thead>
   <tbody id="tbody-general">
    <?php
    include_once 'models/producto.php';
    foreach($this->productos as $row){
        $prodcuto = new Producto();
        $producto = $row; 
        ?>
        <tr id="fila-<?php echo $producto->id_producto; ?>">
            <!--<td><?php echo $producto->id_producto; ?></td>-->
            <td><?php echo $producto->nombreProd; ?></td>
            <td><?php echo $producto->descripcionProd; ?></td>
            <td><?php echo $producto->estadoProd; ?></td>
            <td><?php echo $producto->talla; ?></td>
            <td><?php echo $producto->tipo_tela; ?></td>
            <td><?php echo $producto->foto; ?></td>
            <td><?php echo $producto->descuento; ?>%</td>
            <td><?php echo $producto->fecha_reg; ?></td>
            <td><?php echo $producto->nombrePers . " " . $producto->apellido; ?></td>
            <td><?php echo $producto->codigo_interno; ?></td>
            <td><?php echo $producto->codigo_externo; ?></td>
            <td>$<?php echo $producto->general; ?></td>
            <td><?php echo $producto->proveedor; ?></td>
            <td><a type="button" class="btn" id="btn-editar" href="#"><span class="icon-pencil2"></span></a></td>
            <td><a type="button" class="btn btn-danger bEliminar" href="#"><span class="icon-bin"></span></a></td>
        </tr>
    <?php } ?>
</tbody>
</table>
</div>
<?php require 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>