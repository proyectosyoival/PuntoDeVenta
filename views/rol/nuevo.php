<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Iva</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">

		<h1 id="h1-form">Nuevo Rol</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>iva/registrarIva" method="POST" id="form-iva">
			<div class="form-group">
				<label for="porcentaje">Porcentaje:</label>
				<input type="number" name="porcentaje" id="porcentaje" class="form-control col-md-4" placeholder="Agrega un nuevo IVA Ejemplo. 0.16" step="0.01" min="0" max="1"><!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
			</div>
			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>iva">Regresar</a>
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
   $("#form-iva" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
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
</html>