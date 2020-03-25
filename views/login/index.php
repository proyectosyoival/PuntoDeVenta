<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boombachas</title>
</head>
<body> 
	<?php require 'views/header.php'; ?>
	<h1 id="h1">PUNTO DE VENTA BOOMBACHAS v1.0</h1>
	<form action="<?php echo constant('URL'); ?>nuevo/registrarAlumno" method="POST" id="form-login">
		<div class="container justify-content-center col-md-3" id="cont-login">
	    	<div class="text-center">
	    		<p id="head-login">INICIAR SESIÓN</p>
	    		<div id="cont-img" class="container justify-content-center"><img src="<?php echo constant('URL'); ?>public/img/userlogin2.png" class="img-fluid" id="img-login"></div>
	    	</div>

	    	<div class="justify-content-center" id="body-login">
	    		<div class="form-group">
	    			<label>Usuario</label> <span class="icon-user"></span> 
	    			<input type="email" name="email" class="form-control text-center" placeholder="Ingresa un usuario">
	    		</div>
	    		<div class="form-group">
	    			<label>Contraseña</label> <span class="icon-lock"></span> 
	    			<input type="password" name="contrasena" class="form-control text-center" placeholder="Ingresa la contraseña">
	    		</div>
	    		<div class="form-group">
	    			<button class="btn" id="btn-sub-login" type="submit">Ingresar</button>
	    		</div>
	    	</div>
	  	</div>
	</form>
	<?php require 'views/footer.php'; ?>
<!-- SCRIPT PARA VALIDACION DEL FORMULARIO DE LOGIN-->
<script type="text/javascript">
jQuery.validator.setDefaults({
  debug: false,
  success: "valid",
   errorClass: "my-error-class"
});
jQuery.validator.addMethod("letterandnumbers", function(value, element) {
        return this.optional(element) || /^[a-z0-9\s]+$/i.test(value);
    }, "Solo letras y numeros");
$(function validar() {
   $("#form-login" ).validate({
           rules: {
                   email: {
                           required:true,
                           email:true
                   },
                	contrasena:{
		                    required:true,
		                    minlength:8,
                	}
           },
           messages: {
                   email: {
                           required: "&#x1f5d9; Ingresa un email",
                           email: "&#x1f5d9; Ingresa un email valido"
                   },
                	contrasena:{
		                    required:"&#x1f5d9; Ingresa tu contraseña",
		                    minlength:"&#x1f5d9; Tu contraseña debe ser mayor a 8 caracteres",
                	}
           }
   });
      });
</script>
</body>
</html>