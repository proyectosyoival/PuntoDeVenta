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

		<h1 class="">Nuevo Iva</h1>

		<form action="<?php echo constant('URL'); ?>producto/registrarProducto" method="POST">
			<div class="form-group">
				<label for="nombre">Porcentaje:</label>
				<input type="number" name="porcentaje" id="porcentaje" class="form-control col-md-4" placeholder="Agrega un nuevo IVA Ejemplo. 0.16" required>
			</div>
			<div>
				<input type="submit" value="Crear Producto">
			</div>

		</form>

	</div>
	
	<?php require 'views/footer.php'; ?>
</body>
</html>