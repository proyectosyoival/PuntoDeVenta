<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventario</title>
</head>
<body>
	<?php require 'views/header.php'; ?>

	<h1 class="">Inventario</h1>

	<div class=""><?php echo $this->mensaje; ?></div>

	<form action="<?php echo constant('URL'); ?>nuevoInventario/registrarInventario" method="POST">
		<p>
			<label for="fecha">Fecha:</label><br>
			<input type="date" name="fecha" id="fecha" step="0" value="<?php echo date("Y-m-d");?>" required>
		</p>
		<p>
			<label for="descripcion">Descripción:</label><br>
			<textarea minlength="10" id="descripcion" maxlength="200" placeholder="Descripción..."></textarea>
		</p>
		<p>
			<label for="idstock">Stok Id:</label><br>
			<input type="text" name="idstock" id="idstocks" required>
		</p>
		<p>
			<input type="submit" value="Crear Inventario">
		</p>

	</form>

	<?php require 'views/footer.php'; ?>
</body>
</html>