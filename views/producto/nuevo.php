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

		<h1 class="">Nuevo Producto</h1>

		<form action="<?php echo constant('URL'); ?>producto/registrarProducto" method="POST">
			<div>
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" required>
			</div>
			<div>
				<label for="descripcion">Descripción:</label>
				<textarea minlength="10" id="descripcion" maxlength="200" placeholder="Descripción..."></textarea>
			</div>
			<div>
				<label for="talla">Talla:</label>
				<input type="text" name="talla" id="talla" placeholder="Talla del producto" required>
			</div>
			<div>
				<label>Tipo de Tela:</label>
				<select>
					<option value="0">Algodon</option>
					<option value="1">Poliester</option>
					<option value="2">Licra</option>
					<option value="3">Nilon</option>
					<option value="4">Mesclilla</option>
				</select>
			</div>
			<div>
				<label for="descuento">Descuento:</label>
				<input type="text" name="descuento" id="descuento" placeholder="Porcentaje de descuento" required>
			</div>
			<div>
				<label for="estado">Estado:</label><br>
				<input type="radio" name="estado" id="estado" value="1"> Activo <br>
				<input type="radio" name="esta" id="estado" value="0"> Inactivo
			</div>
			<div>
				<label for="foto">Foto:</label>
				<input type="file" name="foto" id="foto">
			</div>
			<div>
				<label for="codigointerno">Codigo Interno:</label>
				<input type="text" name="codigointerno" id="codigointerno" placeholder="Codigo Interno" required>
			</div>
			<div>
				<label for="codigoexterno">Codigo Externo:</label>
				<input type="text" name="codigoexterno" id="codigoexterno" placeholder="Codigo Externo" required>
			</div>
			<div>
				<label for="precio">Precio:</label>
				<input type="text" name="precio" id="precio" placeholder="Precio base del producto" required>
			</div>
			<div>
				<label for="cantidad">Cantidad:</label>
				<input type="text" name="cantidad" id="cantidad" placeholder="Numero de unidades" required>
			</div>
			<div>
				<label>Categoría:</label>
				<select>
					<option value="0">Deportes</option>
					<option value="1">Casualr</option>
				</select>
			</div>
			<div>
				<input type="submit" value="Crear Producto">
			</div>

		</form>

	</div>
	
	<?php require 'views/footer.php'; ?>
	<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>