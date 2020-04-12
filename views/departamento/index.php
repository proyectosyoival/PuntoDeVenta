<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Departamento</title>
</head>

<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">
				 <div id="respuesta" class="center"></div>
		<h1 class="text-center" id="h1-tab-titulo">DEPARTAMENTO</h1>

		<div>
			<a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>departamento/nuevo"><span class="icon-plus"></span>Nuevo</a>
		</div>
		<hr>
		<table  class ="table table-hover text-center">
			<thead class="thead-dark" id="thead_table">
				<th scope="col">Departamento</th>
				<th scope="col">Estado</th>
				<th scope="col">Fecha de registro</th>
				<th scope="col">Editar</th>
				<th scope="col">Borrar</th>
			</thead>
			<tbody id="tbody-general">
				<?php
					include_once 'models/departamento.php';
					foreach($this->departamento as $row) {
						$departamento = new Depto();
						$departamento = $row;
				 ?>
				 <tr id="fila-<?php echo $departamento->id_departamento; ?>">
						 <td><?php echo $departamento->nombreDepa; ?></td>
						 <td><?php echo $departamento->estadoDepa; ?></td>
						 <td><?php echo $departamento->fecha_alta; ?></td>
						 <td><a type="button" class="btn" id="btn-table" href="#"><span class="icon-pencil2"></span></a></td>
						 <td><a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $departamento->id_departamento;?>" data-function="departamento/deletDepto"><span class="icon-bin"></span></a></td>
				 </tr>
				 <?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php require 'views/footer.php'; ?>
	<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>
