<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tipos de movimientos de caja</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">

		<h1 id="h1-form">Nuevo Tipo De Movimiento De Caja</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>tipomovcaja/registrarTipoMovCaja" method="POST" id="form-tipmovcaja">
			<input type="text" name="id_rol" hidden="true" value="<?php echo $this->rol->id_rol; ?>">
			<div class="form-group">
				<label for="nombreMovCaja">Nombre del tipo de movimiento de caja:</label>
        <input type="text" name="nombreMovCaja" id="nombreMovCaja" class="form-control col-md-4" placeholder="Ingresa el nombre del tipo de movimiento de caja" autocomplete="off">
				<!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
			</div>
      <div class="form-group">
        <label for="descripcionMovCaja">Descripción del tipo de movimiento de caja:</label>
        <textarea name="descripcionMovCaja" id="descripcionMovCaja" class="form-control col-md-4" placeholder="Ingresa una descripción acerca del nombre del movimiento de caja" rows="3" autocomplete="off"></textarea>
      </div>
			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>tipomovcaja">Regresar</a>
				<button type="submit" class="btn" id="btn-registrar">Registrar</button>
			</div>
		</form>
	</div>
	
	<?php require 'views/footer.php'; ?>
</body>
<!-- SCRIPT PARA VALIDACION DEL FORMULARIO DE LOGIN-->
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
   $("#form-tipmovcaja" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombreMovCaja: {//este es el name del input a validar
                           required:true,
                           //este es el requisito a validar
                   },
                	 descripcionMovCaja: {
		                    required:true,
                	}
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombreMovCaja: {
                           required: "&#x1f5d9; Ingresa el nombre del tipo de movimiento de caja",//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                   },
                	 descripcionMovCaja: {
		                    required:"&#x1f5d9; Ingresa una descripción acerca del nombre del movimiento de caja",
                	 } //debes agregar el mensaje por cada input que pusiste en rules
           }
   });
      });
</script>
</html>