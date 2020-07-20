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
					<select class="form-control" name="idtipoprod" id="idtipoprod" required>
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

				<div class="form-group  col-md-3">
					<label>Tipo de Tela:</label>
					<select class="form-control" name="idtipotela" id="idtipotela" required>
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

				<div class="form-group col-md-3">
					<label>Departamento:</label>
					<select class="form-control" name="iddepartamento" id="iddepartamento" onchange="FormaDescripcion();" required>
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

			</div>

			<div class="form-row">

				<div class="form-group col-md-6">
					<label for="descripcion">Descripción:</label>
					<textarea minlength="1" name="descripcionProd" id="descripcionProd" class="form-control" maxlength="300" rows="1" placeholder="Descripción..." required></textarea>
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
					
					<div>
						<label>&nbsp;</label>
						<div>
							<p></p>
						</div>
					</div>

					<div class="form-group  col-md-2">
						<label for="codigointerno">Codigo Interno:</label>
						<input type="text" name="codigointerno[]" id="codigointerno" class="form-control" placeholder="Codigo Interno" requiredS>
					</div>

					<div class="form-group  col-md-2">
						<label for="codigoexterno">Codigo Externo:</label>
						<input type="text" name="codigoexterno[]" id="codigoexterno" class="form-control" placeholder="Codigo Externo" required>
					</div>

				</div>

			</div>

			<div id="aquiSeClona">
				
			</div>

			<div class="form-row">

				<div class="form-group col-md-3">
					<label for="estado">Estado:</label>
					<div class="form-control">
						<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="1" required > Activo
						<input type="radio" name="estadoProd" id="estado" class="col-md-2" value="0"> Inactivo
					</div>
				</div>

			</div>

			<div class="form-row">
				
				<div class="form-group col-md-9">
					<label for="proveedor">Proveedor:</label>
					<input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Nombre de proveedor" required>
				</div>		

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
<script type="text/javascript">
	$(document).ready(function(){
		recargarLista();

		$('#tipoTalla').change(function(){
			recargarLista();
		});
	})
</script>

<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			url: "obtenerTallas",
			type: "POST",
			data: "tipoTalla=" + $('#tipoTalla').val(),
			success:function(r){
				$('#selectTallas').html(r);
			}
		});
	}
</script>

<script type="text/javascript">
	var campos_max = 10;   //max de 10 campos

	var x = 0;
	$('#add_field').click (function(e) {
                e.preventDefault();     //prevenir novos clicks
                if (x < campos_max) {
                	$('#listas').clone().appendTo('#aquiSeClona');
                	$("#aquiSeClona p:first").replaceWith('<input type="button" class="btn btn-danger remover_campo" value="-"/>');
                	$('#tipoTalla').attr('disabled', true);
                	x++;
                }
            });
        // Remover o div anterior
        $('#aquiSeClona').on("click",".remover_campo",function(e) {
        	e.preventDefault();
        	var parent = $(this).parents().get(2);
        	$(parent).remove();
        	x--;
        	if(x == 0){
        		$('#tipoTalla').attr('disabled', false);
        	}
        });
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){
		$('#add_field').attr('disabled', true); //desactivamos el botón +
		$('#tipoTalla').change(function(){
			if($(this).val() != ''){
				$('#add_field').attr('disabled', false); //activamos el botón + 
			}else{
				$('#add_field').attr('disabled', true); //desactivamos el botón +
			}
		});
	});
</script>

<script type="text/javascript">
	jQuery.validator.setDefaults({
		debug: false,
		success: "valid",
		errorClass: "my-error-class"
	});
	jQuery.validator.addMethod("letterandnumbers", function(value, element) {
		return this.optional(element) || /^[a-z0-9\s\.]+$/i.test(value);
	}, "Solo letras y numeros");
	$(function validar() {
   $("#descuento" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   porcentaje: {//este es el name del input a validar
                   	required:true,
                   	min:0,
                   	max:1
                           //este es el requisito a validar
                       }
                	// contrasena:{
		               //      required:true,
		               //      minlength:8,
                	// }
                },
           messages: {//mensaje si no se cumplen las validaciones
           	porcentaje: {
           		required: "&#x1f5d9; Ingresa un IVA",
           		min: "&#x1f5d9; El valor debe ser mayor a 0",
                           max: "&#x1f5d9; El valor debe ser menor a 1"//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                       }
                	// contrasena:{
		               //      required:"&#x1f5d9; Ingresa tu contraseña",
		               //      minlength:"&#x1f5d9; Tu contraseña debe ser mayor a 8 caracteres",
                	// } debes agregar el mensaje por cada input que pusiste en rules
                }
            });
});
</script>

<script type="text/javascript">
	function FormaDescripcion()
	{
		var product = "";
		var product = document.getElementById("idtipoprod").value;
		var comboProduct = document.getElementById("idtipoprod");
		var productSelected = comboProduct.options[comboProduct.selectedIndex].text;

		var tipoDeTela = "";
		var tipoDeTela = document.getElementById("idtipotela").value;
		var comboTipoDeTela = document.getElementById("idtipotela");
		var tipoDeTelaSelected = comboTipoDeTela.options[comboTipoDeTela.selectedIndex].text;

		var apartament = "";
		var apartament = document.getElementById("iddepartamento").value;
		var comboApartament = document.getElementById("iddepartamento");
		var apartamentSelected = comboApartament.options[comboApartament.selectedIndex].text;

		document.getElementById("descripcionProd").value = productSelected + " DE " + tipoDeTelaSelected + " PARA " + apartamentSelected;
	}
</script>