<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Categorias</title>
</head>

<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">
				 <div id="respuesta" class="center"></div>
		<h1 class="text-center" id="h1-tab-titulo">Categorias</h1>

		<div>
			<a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>categoria/nuevo"><span class="icon-plus"></span>Nuevo</a>
		</div>
		<hr>
		<table  class ="table table-hover text-center">
			<thead class="thead-dark" id="thead_table">
				<th scope="col">Categoria</th>
        <th scope="col">Descripción</th>
				<th scope="col">Estado</th>
				<th scope="col">Editar</th>
				<th scope="col">Borrar</th>
			</thead>
			<tbody id="tbody-general">
				<?php
					include_once 'models/categoria.php';
					foreach($this->categorias as $row) {
						$categorias = new Cate();
						$categorias = $row;
				 ?>
				 <tr id="fila-<?php echo $categorias->id_categoria; ?>">
						 <td><?php echo $categorias->nombreCate; ?></td>
             <td><?php echo $categorias->descripcionCate; ?></td>
						 <td><?php echo $categorias->estadoCate; ?></td>
						 <td><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'categoria/verCategoria/' . $categorias->id_categoria; ?>"><span class="icon-pencil2"></span></a></td>
						 <td><a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $categorias->id_categoria;?>" data-function="categoria/eliminarCate"><span class="icon-bin"></span></a></td>
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
