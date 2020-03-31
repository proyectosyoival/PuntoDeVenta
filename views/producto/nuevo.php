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

		<h1 id="h1-form">Nuevo Producto</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>producto/registrarProducto" method="POST">
			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombreProd" id="nombre" class="form-control col-md-4" placeholder="Nombre del producto" required>
			</div>

			<div class="form-group">
				<label for="descripcion">Descripción:</label>
				<textarea minlength="10" name="descripcionProd" id="descripcionProd" class="form-control col-md-4" maxlength="200" placeholder="Descripción..."></textarea>
			</div>

			<div class="form-group">
				<label for="talla">Talla:</label>
				<input type="text" name="talla" id="talla" class="form-control col-md-4" placeholder="Talla del producto" required>
			</div>

			<div class="form-group">
				<label>Tipo de Tela:</label>
				<select class="form-control col-md-4" name="tipotela">
					<option value="Algodon">Algodon</option>
					<option value="Poliester">Poliester</option>
					<option value="Licra">Licra</option>
					<option value="Nilon">Nilon</option>
					<option value="Mesclilla">Mesclilla</option>
				</select>
			</div>

			<div class="form-group">
				<label for="descuento">Descuento:</label>
				<input type="text" name="descuento" id="descuento" class="form-control col-md-4" placeholder="Porcentaje de descuento" required>
			</div>

			<div class="form-group">
				<label for="estado">Estado:</label><br>
				<input type="radio" name="estadoProd" id="estado" value="1"> Activo <br>
				<input type="radio" name="estadoProd" id="estado" value="0"> Inactivo
			</div>

			<div class="form-group">
				<label for="foto">Foto:</label>
				<input type="file" name="foto" id="foto" class="form-control col-md-4">
			</div>

			<div class="form-group">
				<label for="codigointerno">Codigo Interno:</label>
				<input type="text" name="codigointerno" id="codigointerno" class="form-control col-md-4" placeholder="Codigo Interno" required>
			</div>

			<div class="form-group">
				<label for="codigoexterno">Codigo Externo:</label>
				<input type="text" name="codigoexterno" id="codigoexterno" class="form-control col-md-4" placeholder="Codigo Externo" required>
			</div>

			<div class="form-group">
				<label for="precio">Precio:</label>
				<input type="text" name="precio" id="precio" class="form-control col-md-4" placeholder="Precio base del producto" required>
			</div>

			<div class="form-group">
				<label for="cantidad">Cantidad:</label>
				<input type="text" name="cantidad" id="cantidad" class="form-control col-md-4" placeholder="Numero de unidades" required>
			</div>

			<div class="form-group">
				<label>Categoría:</label>
				<select class="form-control col-md-4" name="idcategoria">
					<option value="0">Deportes</option>
					<option value="1">Casualr</option>
				</select>
			</div>

			<div class="form-group">
				<label for="proveedor">Proveedor:</label>
				<input type="text" name="proveedor" id="proveedor" class="form-control col-md-4" placeholder="Nombre de proveedor" required>
			</div>

			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>producto">Regresar</a>
				<button type="submit" class="btn" id="btn-registrar">Registrar</button>
			</div>

		</form>
	</div>
	
	<?php require 'views/footer.php'; ?>
</body>
</html>