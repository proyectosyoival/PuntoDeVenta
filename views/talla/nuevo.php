<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tallas</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">

		<h1 id="h1-form">Nueva Talla</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>talla/registrarTalla" method="POST" id="form-talla">
			<div class="form-group">
				<label for="nombreTalla">Talla:</label>
        <input type="text" name="nombreTalla" id="nombreTalla" class="form-control col-md-4" placeholder="Ingresa la talla" autocomplete="off">
				<!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
			</div>
      <div class="form-group">
        <label for="tipoTalla">Tipo de talla:</label>
        <select name="tipoTalla" id="tipoTalla" class="form-control col-md-4">
          <option value="">Selecciona un tipo</option>
          <option value="Alfabético">Alfabético</option>
          <option value="Númerico">Númerico</option>
        </select>
      </div>
			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>talla">Regresar</a>
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
   $("#form-talla" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombreTalla: {//este es el name del input a validar
                           required:true,
                           //este es el requisito a validar
                   },
                	 tipoTalla: {
		                    required:true,
                	}
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombreTalla: {
                           required: "&#x1f5d9; Ingresa la talla",//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                   },
                	 tipoTalla: {
		                    required:"&#x1f5d9; Selecciona un tipo de talla",
                	 } //debes agregar el mensaje por cada input que pusiste en rules
           }
   });
      });
</script>
</html>