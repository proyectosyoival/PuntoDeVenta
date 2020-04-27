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
		<div class="center"><?php echo $this->mensaje; ?></div>
		<h1 id="h1-form">Editar Producto</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>producto/actualizarProducto" method="POST" enctype="multipart/form-data" autocomplete="off">
			
			<div class="form-row">
				
				<div class="form-group col-md-3">
					<label>Producto:</label>
					<select class="form-control" name="idtipoprod" required>
						<option value="<?php echo $this->productoSelected->id_cat_tipo_prod;?>" hidden><?php echo $this->productoSelected->nombreTipoProd;?></option>
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
						<option value="<?php echo $this->productoSelected->id_departamento;?>" hidden><?php echo $this->productoSelected->nombreDepa;?></option>
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

				<!-- Se trae el dato para mostrarlo en el select de Categoría -->
				<?php 
				$categoria = $this->productoSelected->nombreCate;
			//sacar los nombres de la tabla de Categoría
				$db= new Database();
				$query = $db->connect()->prepare('SELECT * FROM categoria WHERE nombreCate LIKE :categoria');
				$query->execute(['categoria' => $categoria]);
				foreach ($query as $row) {
					$idCategoria 	= $row['id_categoria'];
					$nombreCate   	= $row['nombreCate'];           
				}
				?>
				<div class="form-group col-md-3">
					<label>Categoría:</label>
					<select class="form-control" name="idcategoria" required>
						<option value="<?php echo $idCategoria; ?>" hidden><?php echo $nombreCate; ?></option>
						<?php
						include_once 'models/categoria.php';
						foreach ($this->categorias as $row) {
							$categoria = new Categoria();
							$categoria = $row;
							?>
							<option value="<?php echo $categoria->id_categoria; ?>"><?php echo $categoria->nombreCate; ?></option>
						<?php } ?>					
					</select>
				</div>

			</div>

			<!-- hiddens -->
			<input type="text" name="idcodigodebarras" hidden="true" value="<?php echo $this->productoSelected->id_codigo_de_barras; ?>">
			<input type="text" name="idprecio" hidden="true" value="<?php echo $this->productoSelected->id_precio; ?>">
			<input type="text" name="idstock" hidden="true" value="<?php echo $this->productoSelected->id_stock; ?>">

			<div class="form-row">

				<div class="form-group col-md-6">
					<label for="descripcion">Descripción:</label>
					<textarea minlength="1" name="descripcionProd" id="descripcionProd" class="form-control" maxlength="300" rows="1" placeholder="Descripción..." required><?php echo $this->productoSelected->descripcionProd;?></textarea>
				</div>

				<!-- Se trae el dato para mostrarlo en el select de Tipo De Tela -->
				<?php
				$tipoTela =	$this->productoSelected->tipo_tela;
				//sacar los nombres de la tabla de tipo de tela
				$db= new Database();
				$query = $db->connect()->prepare('SELECT * FROM tipo_tela WHERE nombreTipoTela LIKE :tipoTela');
				$query->execute(['tipoTela' => $tipoTela]);
				foreach ($query as $row) {
					$idTipoDeTela 	= $row['id_tipo_tela'];
					$tipoDeTela   	= $row['nombreTipoTela'];           
				}
				?>
				<div class="form-group  col-md-3">
					<label>Tipo de Tela:</label>
					<select class="form-control" name="idtipotela">
						<option value="<?php echo $idTipoDeTela; ?>" hidden><?php echo $tipoDeTela; ?></option>
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
					<input type="text" name="talla" id="talla" class="form-control" value="<?php echo $this->productoSelected->talla;?>" placeholder="Talla del producto" required>
				</div>

				<div class="form-group col-md-3">
					<label for="estado">Estado:</label>
					<div class="form-control">
						<?php 
						$estado = $this->productoSelected->estadoProd;
						if($estado == 1){
							?>
							<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="1" checked> Activo
							<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="0"> Inactivo
							<?php
						}
						else{
							?>
							<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="1"> Activo
							<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="0" checked> Inactivo
							<?php
						}
						?>						
					</div>
				</div>

				<div class="form-group col-md-3">
					<label for="proveedor">Proveedor:</label>
					<input type="text" name="proveedor" id="proveedor" class="form-control" value="<?php echo $this->productoSelected->proveedor;?>" placeholder="Nombre de proveedor" required>
				</div>

			</div>

			<div class="form-row">

				<div class="form-group  col-md-3">
					<label for="codigointerno">Codigo Interno:</label>
					<input type="text" name="codigointerno" id="codigointerno" class="form-control" value="<?php echo $this->productoSelected->codigo_interno; ?>" placeholder="Codigo Interno" readonly>
				</div>

				<div class="form-group  col-md-1">
					<label for="codigointerno">Barras:</label>
					<input type="text" name="barrasinterno" id="barrasinterno" class="form-control" placeholder="Barras Código Interno" readonly>
				</div>

				<div class="form-group  col-md-1"></div>

				<div class="form-group  col-md-3">
					<label for="codigoexterno">Codigo Externo:</label>
					<input type="text" name="codigoexterno" id="codigoexterno" class="form-control" value="<?php echo $this->productoSelected->codigo_externo; ?>" placeholder="Codigo Externo" required>
				</div>

				<div class="form-group  col-md-1">
					<label for="codigointerno">Barras:</label>
					<input type="text" name="barrasexterno" id="barrasexterno" class="form-control" placeholder="Barras Código Externo" readonly>
				</div>

			</div>

			<div class="form-row">

				<div class="form-group col-md-3">
					<label for="precio">Precio:</label>
					<input type="text" name="precio" id="precio" class="form-control" value="<?php echo $this->productoSelected->general; ?>" placeholder="Precio base del producto" required>
				</div>

				<div class="form-group col-md-3">
					<label for="cantidad">Cantidad:</label>
					<input type="text" name="cantidad" id="cantidad" class="form-control" value="<?php echo $this->productoSelected->cantidad; ?>" placeholder="Numero de unidades" required>
				</div>

				<div class="form-group col-md-3">
					<label for="descuento">Descuento:</label>
					<input type="text" name="descuento" id="descuento" class="form-control" value="<?php echo $this->productoSelected->descuento; ?>" placeholder="Porcentaje de descuento" required>
				</div>

			</div>

			<div class="form-row">

				<div class="form-group col-md-4">
					<label for="foto">Foto:</label>
					<?php 
					$foto = $this->productoSelected->foto;
					if(empty($foto)) { ?>				
						<input type="file" name="foto" id="foto" class="form-control" autocomplete="off" accept="image/*">
					<?php }else{ ?>
						<input type="file" name="foto" id="foto" class="form-control" autocomplete="off" accept="image/*" hidden="true">
						<img src="<?php echo constant('URL'); ?>img/productos/<?php echo $this->productoSelected->foto;?>" class="img-editProd" id="imgfoto">
						<button type="button" class="close" aria-label="Close" onclick="cambiarfoto();" id="btnfoto">
							<span aria-hidden="true">&times;</span>
						</button>
					<?php } ?>
				</div>

			</div>

			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>producto">Regresar</a>
				<button type="submit" class="btn" id="btn-registrar">Actualizar</button>
			</div>

		</form>
	</div>

	<?php require 'views/footer.php'; ?>
</body>
<!-- SCRIPT PARA Ocultar imagen -->
<script language="javascript" type="text/javascript">
	function cambiarfoto(){
		document.getElementById('imgfoto').hidden=true;
		document.getElementById('btnfoto').hidden=true;
		document.getElementById('foto').hidden=false;
	}
</script> 
</html>