<div class="form-group">
	<label for="idtalla">Talla:</label>
	<select class="form-control" id="idtalla[]" name="idtalla[]" onchange="GetTalla();" required>		
		<option value="" hidden>-----</option>
		<?php
		include_once 'models/talla.php';
		foreach ($this->tallas as $row) {
			$talla = new Size();
			$talla = $row;
			?>
			<option value="<?php echo $talla->id_talla; ?>"><?php echo $talla->nombreTalla; ?></option>
		<?php } ?>						
	</select>
</div>