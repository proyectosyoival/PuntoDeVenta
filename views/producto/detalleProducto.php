<div class="form-row col-md-12">
	<div class="col-md-4">
		<!-- Departamento -->
		<div align="center"><?php echo $this->productoSelected->nombreDepa; ?> : <?php echo $this->productoSelected->nombreCate; ?></div>
		<!-- Imagen -->
		<div align="center"><img src="<?php echo constant('URL'); ?>img/productos/<?php echo $this->productoSelected->foto; ?>" class="img-responsive" width="200"  title="<?php echo $this->productoSelected->descripcionProd;?>"></div>
	</div>
	<div class="col-md-8">
		<!-- Marca -->
		<div>
		    <div align="left"><span>Marca: </span>Nike</div>
	  	</div>
		<!-- Descripción -->
		<div align="left">
			<h5><?php echo $this->productoSelected->descripcionProd;?></h5>
		</div>
		<!-- Proveedor -->
		<div>
		    <div align="left"><span>Proveedor: </span><?php echo $this->productoSelected->proveedor; ?></div>
	  	</div>
	</div>	
</div>





<hr>
<div class="form-group col-md-3">
	<label for="tipoTalla">Tipo de Numeración:</label>
	<select class="form-control" name="tipoTalla" id="tipoTalla" required>
		<option value="">-----</option>
		<?php
		include_once 'models/talla.php';
		$db = new Database();
		$query = $db->connect()->prepare('SELECT distinct(tipoTalla) FROM talla ORDER BY tipoTalla ASC');
		$query->execute();
		foreach ($query as $row) {
			$tipoTalla 	= $row['tipoTalla'];
			?>
			<option value="<?php echo $tipoTalla; ?>"><?php echo $tipoTalla; ?></option>
		<?php } ?>
	</select>
</div>

<div class="col-md-2">
	<label>Agregar Talla:</label>
	<div>
		<button type="button" class="btn btn-primary form-control" id="add_field"> + </button>
	</div>
</div>

</div>

<div id="listas">

	<div class="form-row">

		<div class="form-group col-md-1" id="selectTallas">

		</div>

		<div class="form-group col-md-2">
			<label for="cantidad">Cantidad:</label>
			<input type="text" name="cantidad[]" id="cantidad" class="form-control" placeholder="Unidades" required>
		</div>

		<div class="form-group  col-md-2">
			<label for="codigointerno">Codigo Interno:</label>
			<input type="text" name="codigointerno[]" id="codigointerno" class="form-control" placeholder="Codigo Interno" readonly required>
		</div>

		<div class="form-group  col-md-2">
			<label for="codigoexterno">Codigo Externo:</label>
			<input type="text" name="codigoexterno[]" id="codigoexterno" class="form-control" placeholder="Codigo Externo" required>
		</div>

		<div>
			<label>&nbsp;</label>
			<div>
				<p></p>
			</div>
		</div>

	</div>

</div>

<div id="aquiSeClona">

</div>

<div class="form-row">

	<div class="form-group col-md-2">
		<label for="precio">Precio:</label>
		<input type="text" name="precio" id="precio" class="form-control" placeholder="Precio base" required>
	</div>

	<div class="form-group col-md-2">
		<label for="mayoreo">Mayoreo:</label>
		<input type="text" name="mayoreo" id="mayoreo" class="form-control" placeholder="Precio al mayoreo" required>
	</div>

	<div class="form-group col-md-2">
		<label for="descuento">Descuento:</label>
		<input type="number" name="descuento" id="descuento" class="form-control" placeholder="Porcentaje" step="0.01" min="0" max="1" required>
	</div>

	<div class="form-group col-md-3">
		<label for="idpromocion">Promoción:</label>
		<select class="form-control" name="idpromocion" id="idpromocion" required>
			<option value="">-----</option>
			<?php
			include_once 'models/promocion.php';
			$db = new Database();
			$query = $db->connect()->prepare('SELECT * FROM promocion ORDER BY nombrePromo ASC');
			$query->execute();
			foreach ($query as $row) {
				?>
				<option value="<?php echo $row['id_promocion']; ?>"><?php echo $row['nombrePromo']; ?></option>
			<?php } ?>
		</select>
	</div>

</div> -->