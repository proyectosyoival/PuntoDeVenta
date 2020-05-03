<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Promociones</title>
</head>

<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">
				 <div id="respuesta" class="center"></div>
		<h1 class="text-center" id="h1-tab-titulo">Promociones</h1>
		<div>
			<a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>promociones/nuevo"><span class="icon-plus"></span> Nuevo</a>
		</div>
		<hr>
		<!--inicio de carview-->
		<div class="row" id="cards">
        <div class="row row-cols-1 row-cols-md-3" id="card-general">
				<?php
					include_once 'models/promocion.php';
					foreach($this->promocion as $row) {
						$promocion = new Promo();
						$promocion = $row;
				 ?>
				 <div class="col mb-4" id="fila-<?php echo $promocion->id_promocion;?>">
						 <div class="card">
								 <div class="card-header text-center" id="card-header2">
									 <h5 class="text-center"><?php echo $promocion->nombrePromo; ?></h5>
								 </div>
						 <div class="card-body" id="card-body">
							 <p class="card-text text-left"><span class="label-card">Descripion: </span><?php echo $promocion->descripcionPromo; ?></p>
							 <p class ="card-text text-left"><span class="label-card">Fecha de vigencia: </span> <?php echo $promocion->fecha_vigencia; ?></p>
							 <p class= "text-center"><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'promociones/verPromocion/' . $promocion->id_promocion; ?>"><span class="icon-pencil2"></span></a>
								 <a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $promocion->id_promocion;?>" data-function="promociones/eliminarPromo"><span class="icon-bin"></span></a></p>
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
