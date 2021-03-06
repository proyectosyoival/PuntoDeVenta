<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Categoria</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">

		<h1 id="h1-form">Nueva Categoria</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>categoria/registrarCategoria" method="POST" id="form-categoria">
			<div class="form-group">
				<label for="nombreCate">Nombre de la Categoria:</label>
        <input type="text" name="nombreCate" id="nombreCate" class="form-control col-md-4" placeholder="Ingresa el nombre de la categoria" autocomplete="off">
				<!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
			</div>
      <div class="form-group">
        <label for="descripcionCate">Descripción de la Categoria:</label>
        <textarea name="descripcionCate" id="descripcionCate" class="form-control col-md-4" placeholder="Ingresa una descripción acerca de la categoria" rows="3" autocomplete="off"></textarea>
      </div>
			<div>
				<label for="estado">Estado:</label><br>
				<input type="radio" name="estadoCate" id="estadoCate" value="1"> Activo <br>
				<input type="radio" name="estadoCate" id="estadoCate" value="0"> Inactivo
			</div>
			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>categoria">Regresar</a>
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
   $("#form-categoria" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombreCate: {//este es el name del input a validar
                           required:true,
                           //este es el requisito a validar
                   },
                	 descripcionCate: {
		                    required:true,
                	}
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombreCate: {
                           required: "&#x1f5d9; Ingresa el nombre de la categoria",//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                   },
                	 descripcionCate: {
		                    required:"&#x1f5d9; Ingresa la descripción de la categoria",
                	 } //debes agregar el mensaje por cada input que pusiste en rules
           }
   });
      });
</script>
</html>
