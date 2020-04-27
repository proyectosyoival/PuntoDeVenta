<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Productos</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">

		<h1 id="h1-form">Nuevo Producto</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>producto/registrarProducto" method="POST" enctype="multipart/form-data" autocomplete="off">

			<div class="form-row">
				
				<div class="form-group col-md-3">
					<label>Producto:</label>
					<select class="form-control" name="idtipoprod" required>
						<option value="" hidden>Seleccione una opción..</option>
						<?php
						include_once 'models/tipoProducto.php';
						foreach ($this->tiposProd as $row) {
							$tipoProducto = new TipoProduct();
							$tipoProducto = $row;
							?>
							<option value="<?php echo $tipoProducto->id_cat_tipo_prod; ?>"><?php echo $tipoProducto->nombreTipoProd; ?></option>
						<?php } ?>					
					</select>
				</div>

				<div class="form-group col-md-3">
					<label>Departamento:</label>
					<select class="form-control" name="iddepartamento" required>
						<option value="" hidden>Seleccione una opción..</option>
						<?php
						include_once 'models/departamento.php';
						foreach ($this->departamentos as $row) {
							$departamento = new Depto();
							$departamento = $row;
							?>
							<option value="<?php echo $departamento->id_departamento; ?>"><?php echo $departamento->nombreDepa; ?></option>
						<?php } ?>						
					</select>
				</div>

				<div class="form-group col-md-3">
					<label>Categoría:</label>
					<select class="form-control" name="idcategoria" required>
						<option value="" hidden>Seleccione una opción..</option>
						<?php
						include_once 'models/categoria.php';
						foreach ($this->categorias as $row) {
							$categoria = new Cate();
							$categoria = $row;
							?>
							<option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombreCate; ?></option>
						<?php } ?>					
					</select>
				</div>

			</div>

			<div class="form-row">

				<div class="form-group col-md-6">
					<label for="descripcion">Descripción:</label>
					<textarea minlength="1" name="descripcionProd" id="descripcionProd" class="form-control" maxlength="300" rows="1" placeholder="Descripción..." required></textarea>
				</div>

				<div class="form-group  col-md-3">
					<label>Tipo de Tela:</label>
					<select class="form-control" name="idtipotela" required>
						<option value="">Seleccione una opción..</option>
						<?php
						include_once 'models/tipotela.php';
						foreach ($this->tipostela as $row) {
							$tipotela = new Tipotela();
							$tipotela = $row;
							?>
							<option value="<?php echo $tipotela->id_tipo_tela; ?>"><?php echo $tipotela->nombreTipoTela; ?></option>
						<?php } ?>
					</select>
				</div>

			</div>

			<div class="form-row">				

				<div class="form-group  col-md-3">
					<label for="talla">Talla:</label>
					<input type="text" name="talla" id="talla" class="form-control" placeholder="Talla del producto" required>
				</div>

				<div class="form-group col-md-3">
					<label for="estado">Estado:</label>
					<div class="form-control">
						<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="1" required > Activo
						<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="0"> Inactivo
					</div>
				</div>

				<div class="form-group col-md-3">
					<label for="proveedor">Proveedor:</label>
					<input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Nombre de proveedor" required>
				</div>		

			</div>

			<div class="form-row">
				<div class="form-group  col-md-3">
					<label for="codigointerno">Codigo Interno:</label>
					<input type="text" name="codigointerno" id="codigointerno" class="form-control" placeholder="Codigo Interno" requiredS>
				</div>

				<div class="form-group  col-md-1">
					<label for="codigointerno">Barras:</label>
					<input type="text" name="barrasinterno" id="barrasinterno" class="form-control" placeholder="Barras Código Interno" readonly>
				</div>

				<div class="form-group  col-md-1"></div>

				<div class="form-group  col-md-3">
					<label for="codigoexterno">Codigo Externo:</label>
					<input type="text" name="codigoexterno" id="codigoexterno" class="form-control" placeholder="Codigo Externo" required>
				</div>

				<div class="form-group  col-md-1">
					<label for="codigointerno">Barras:</label>
					<input type="text" name="barrasexterno" id="barrasexterno" class="form-control" placeholder="Barras Código Externo" readonly>
				</div>

			</div>

			<div class="form-row">
				<div class="form-group col-md-3">
					<label for="precio">Precio:</label>
					<input type="text" name="precio" id="precio" class="form-control" placeholder="Precio base del producto" required>
				</div>

				<div class="form-group col-md-3">
					<label for="cantidad">Cantidad:</label>
					<input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Numero de unidades" required>
				</div>

				<div class="form-group col-md-3">
					<label for="descuento">Descuento:</label>
					<input type="text" name="descuento" id="descuento" class="form-control" placeholder="Porcentaje de descuento" required>
				</div>
			</div>

			<div class="form-row">

				<div class="form-group col-md-4">
					<label for="foto">Foto:</label>
					<input type="file" name="foto" id="foto" class="form-control" autocomplete="off" accept="image/*">
				</div>
				
			</div>

			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>producto">Regresar</a>
				<button type="submit" class="btn" id="btn-registrar">Registrar</button>
			</div>

		</form>
	</div>

	<?php require 'views/footer.php'; ?>
</body>
</html>
