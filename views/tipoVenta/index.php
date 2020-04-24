<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tipos de Venta</title>
</head>

<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">
				 <div id="respuesta" class="center"></div>
		<h1 class="text-center" id="h1-tab-titulo">Tipos de Venta</h1>
		<div>
			<a type="button" class="btn" id="btn-table" href="<?php echo constant('URL'); ?>tipoVenta/nuevo"><span class="icon-plus"></span>Nuevo</a>
		</div>
		<hr>
		<!--inicio de carview-->
		<div class="row" id="cards">
				<div class="row row-cols-1 row-cols-md-3" id="card-general">
				<?php
					include_once 'models/tipoVenta.php';
					foreach($this->tiposVenta as $row) {
						$tiposVenta = new tipo_venta();
						$tiposVenta = $row;
				 ?>
				 <div class="col mb-4" id="fila-<?php echo $tiposVenta->id_tipo_venta;?>">
						 <div class="card">
								 <div class="card-header text-center" id="card-header2">
									 <h5 class="text-center"><?php echo $tiposVenta->descripcionTipoVenta; ?></h5>
								 </div>
						 <div class="card-body" id="card-body">
							 <p class= "text-center"><a type="button" class="btn" id="btn-editar" href="<?php echo constant('URL') . 'tipoVenta/verTipo_Venta/' . $tiposVenta->id_tipo_venta; ?>"><span class="icon-pencil2"></span></a>
								 <a type="button" class="btn btn-danger bEliminar" data-id="<?php echo $tiposVenta->id_tipo_venta;?>" data-function="tipoVenta/eliminarTipo_Venta"><span class="icon-bin"></span></a></p>
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
