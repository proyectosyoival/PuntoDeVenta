<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Productos</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div id="content">

		<h1 class="">Productos</h1>

		<div>
			<a href="<?php echo constant('URL'); ?>producto/nuevo">Nuevo Producto</a>
		</div>
        <hr>
		<table width="1100px">
            <thead>
                <tr>
                	<th>Id</th>
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
                </tr>
            </thead>
            <tbody id="tbody-alumnos">
                <?php
                    include_once 'models/producto.php';
                    foreach($this->productos as $row){
                        $prodcuto = new Producto();
                        $producto = $row; 
                ?>
                <tr id="fila-<?php echo $producto->id_producto; ?>">
                    <td><?php echo $producto->id_producto; ?></td>
                    <td><?php echo $producto->nombre; ?></td>
                    <td><?php echo $producto->descripcion; ?></td>
                    <td><?php echo $producto->estado; ?></td>
                    <td><?php echo $producto->talla; ?></td>
                    <td><?php echo $producto->tipo_tela; ?></td>
                    <td><?php echo $producto->foto; ?></td>
                    <td><?php echo $producto->descuento; ?></td>
                    <td><?php echo $producto->fecha_reg; ?></td>
                    <td><?php echo $producto->nombre . " " . $producto->apellido; ?></td>
                    <td><?php echo $producto->codigo_interno; ?></td>
                    <td><?php echo $producto->codigo_externo; ?></td>
                    <td><?php echo $producto->general; ?></td>
                    <td><?php echo $producto->proveedor; ?></td>
                    <td><a href="#">Editar</a></td>
                    <td><a href="#">Eliminar</a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>

	</div>

	<?php require 'views/footer.php'; ?>
	<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>