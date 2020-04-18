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
		<!--inicio de carview-->
		<div class="row" id="cards">
        <div class="row row-cols-1 row-cols-md-3" id="card-general">
				<?php
					include_once 'models/categoria.php';
					foreach($this->categorias as $row) {
						$categorias = new Cate();
						$categorias = $row;
				 ?>
				 <div class="col mb-4" id="fila-<?php echo $categorias->id_categoria;?>">
						 <div class="card">
								 <div class="card-header text-center" id="card-header2">
									 <h5 class="text-center"><?php echo $categorias->nombreCate; ?></h5>
								 </div>
						 <div class="card-body" id="card-body">
							 <p class="card-text text-left"><span class="label-card">Descripion: </span><?php echo $categorias->descripcionCate; ?></p>
							 <p class ="card-text text-left"><span class="label-card">Estado: </span><?php echo $categorias->estadoCate; ?></p>
							 <p class= "text-center"><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'categoria/verCategoria/' . $categorias->id_categoria; ?>"><span class="icon-pencil2"></span></a>
								 <a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $categorias->id_categoria;?>" data-function="categoria/eliminarCate"><span class="icon-bin"></span></a></p>
							 </div>
						 </div>
					 </div>
				 <?php } ?>
			 </div>
		 </div>
	 </div>

<?php require 'views/footer.php'; ?>
	<script src="<?php echo constant('URL'); ?>public/js/main.js"></script>
</body>
</html>
