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

	<h1 class"">Departamento</h1>
	
	<div class="table-responsive-">
		<table  width ="1100px" >
			<thead class="thead-dark" id="thead_table">
				<th scope="col">#id</th>
				<th scope="col">Departamento</th>
				<th scope="col">Estado</th>
				<th scope="col">Fecha alta</th>
				<th scope="col">Editar</th>
				<th scope="col">Borrar</th>
			</thead>
			<tbody>
				<tr>
					<th scope="row"></th>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php require 'views/footer.php'; ?>
	<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>
