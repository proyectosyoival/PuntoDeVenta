<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Empleados</title>
</head>
<body>
	<?php require 'views/header.php'; ?>
	<?php require 'views/menu.php'; ?>

	<div class="container-fluid">

		<h1 id="h1-form">Nuevo Empleado</h1>
		<hr>
		<form action="<?php echo constant('URL'); ?>persona/registrarPersona" method="POST" id="form-rol">
      <!-- div nombre y apellido y fecha denacimiento -->
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="nombrePers">Nombre del empleado:</label>
          <input type="text" name="nombrePers" id="nombrePers" class="form-control" placeholder="Ingresa el nombre del empleado" autocomplete="off">
        </div>
        <div class="form-group col-md-4">
          <label for="apellido">Apellido del empleado:</label>
          <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingresa el apellido del empleado" autocomplete="off">
        </div>
        <div class="form-group col-md-2">
          <label for="fecha_nac">Fecha de Naciemiento:</label>
          <?php $fecha=date('Y-m-d');?>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" autocomplete="off" value="<?php echo $fecha?>">
        </div>
      </div>
      <!-- div para direccion y telefono-->
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="direccion">Dirección del empleado:</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingresa la dirección del empleado" autocomplete="off">
        </div>
        <div class="form-group col-md-4">
          <label for="telefono">Núm. de Teléfono o Celular:</label>
          <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ingresa el núm. de teléfono o celular del empleado" autocomplete="off" maxlength="10" minlength="7">
        </div>
      </div>
      <!-- div para usuario-->
      <div class="form-group">
        <label for="usuario">Usuario del empleado:</label>
         <input type="text" name="usuario" id="usuario" class="form-control col-md-5" placeholder="Ingresa el usuario del empleado: Ej. raul.perez" autocomplete="off">
      </div>
      <!-- div para contraseña y confirmar contraseña-->
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="contrasena">Contraseña del usuario del empleado:</label>
          <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Ingresa una contraseña para el ususario" autocomplete="off" maxlength="10" minlength="7">
        </div>
        <div class="form-group col-md-5">
          <label for="contrasena2">Confirmar contrasena:</label>
          <input type="password2" name="contrasena2" id="contrasena2" class="form-control" placeholder="Confirma la contraseña anterior" autocomplete="off" maxlength="10" minlength="7">
        </div>
      </div>
      <!-- div para foto y comprobante-->
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="foto">Foto del Empleado:</label>
          <input type="text" name="foto" id="foto" class="form-control" placeholder="Ingresa una foto del empleado" autocomplete="off">
        </div>
        <div class="form-group col-md-5">
          <label for="comprobante">Comprobante de domicilio del empleado:</label>
          <input type="text" name="comprobante" id="comprobante" class="form-control" placeholder="Ingresa una foto del comprobante de domicilio del empleado" autocomplete="off">
        </div>
      </div>
      <!-- div para numero empleado y rol-->
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="num_empleado">Núm. de empleado:</label>
          <input type="text" name="num_empleado" id="num_empleado" class="form-control" placeholder="Ingresa un numero de empleado" autocomplete="off" disabled>
        </div>
        <div class="form-group col-md-5">
          <label for="id_rol">Rol del empleado:</label>
          <select name="id_rol" id="id_rol" class="form-control">
            <option value="">Selecciona un rol</option>
            <option value="1">Administrador</option>
            <option value="2">Encargado de tienda</option>
            <option value="3">Cajero</option>
            <option value="4">Vendedor</option>
          </select>
        </div>
      </div>
      <!-- botones -->
			<div>
				<a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>rol">Regresar</a>
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
   $("#form-rol" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombreRol: {//este es el name del input a validar
                           required:true,
                           //este es el requisito a validar
                   },
                	 descripcionRol: {
		                    required:true,
                	}
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombreRol: {
                           required: "&#x1f5d9; Ingresa el nombre del rol",//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                   },
                	 descripcionRol: {
		                    required:"&#x1f5d9; Ingresa la descripción del rol",
                	 } //debes agregar el mensaje por cada input que pusiste en rules
           }
   });
      });
</script>
</html>