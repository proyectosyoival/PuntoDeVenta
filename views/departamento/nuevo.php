<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Departamento</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div id="content">

		<h1 id="h1-form">Nuevo Departamento</h1>

		<form action="<?php echo constant('URL'); ?>departamento/nuevoDepartamento" method="POST">
			<div class="form-group">
				<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" id="nombre" class="form-control col-md-12" placeholder="Nombre del departamento" required>
			</div>
			<div>
				<label for="estado">Estado:</label><br>
				<input type="radio" name="estado" id="estado" value="1"> Activo <br>
				<input type="radio" name="esta" id="estado" value="0"> Inactivo
			</div>
			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>departamento">Regresar</a>
				<button type="submit" class="btn" id="btn-registrar">Crear</button>
			</div>

		</form>

	</div>

	<?php require 'views/footer.php'; ?>
	<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>
