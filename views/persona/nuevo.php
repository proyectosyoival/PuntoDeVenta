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
		<form action="<?php echo constant('URL'); ?>persona/registrarPersona" method="POST" id="form-persona" enctype="multipart/form-data">
      <!-- div nombre y apellido y fecha denacimiento -->
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="nombrePers">Nombre:</label>
          <input type="text" name="nombrePers" id="nombrePers" class="form-control" placeholder="Ingresa el nombre" autocomplete="off" onkeyup="PasarValor();">
        </div>
        <div class="form-group col-md-3">
          <label for="apellido">Apellido:</label>
          <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingresa el apellido" autocomplete="off" onkeyup="PasarValor();">
        </div>
        <div class="form-group col-md-2">
          <label for="fecha_nac">Fecha de Naciemiento:</label>
          <?php $fecha=date('Y-m-d');?>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" autocomplete="off">
        </div>
      </div>
      <!-- div para direccion y telefono-->
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="direccion">Dirección:</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingresa la dirección" autocomplete="off">
        </div>
        <div class="form-group col-md-3">
          <label for="telefono">Núm. de Teléfono o Celular:</label>
          <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ingresa el núm. de teléfono o celular" autocomplete="off" maxlength="10" minlength="7">
        </div>
      </div>
      <!-- div para usuario y rol-->
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="usuario">Usuario:</label>
         <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingresa el usuario: Ej. raul.perez" autocomplete="off" readonly> 
      </div>
      <div class="form-group col-md-4">
          <label for="id_rol">Rol del empleado:</label>
          <select name="id_rol" id="id_rol" class="form-control">
            <option value="">Selecciona un rol</option>
            <?php
            //sacar los nombres de la tabla de roles
            $db= new Database();
            $query = $db->connect()->prepare('SELECT * FROM rol');
            $query->execute();
            foreach ($query as $row) { ?>
              <option value="<?php echo $row['id_rol']?>"><?php echo $row['nombreRol'];?></option>            
            <?php } ?>
          </select>
        </div>
    </div>
      <!-- div para contraseña y confirmar contraseña-->
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="contrasena" id="contrasena-label">Contraseña del usuario del empleado:</label>
          <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Ingresa una contraseña para el ususario" autocomplete="off" minlength="8">
        </div>
        <div class="form-group col-md-4">
          <label for="contrasena2" id="contrasena2-label">Confirmar contrasena:</label>
          <input type="password" name="contrasena2" id="contrasena2" class="form-control" placeholder="Confirma la contraseña anterior" autocomplete="off" minlength="8">
        </div>
      </div>
      <!-- div para foto y comprobante-->
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="foto">Foto del Empleado:</label>
          <input type="file" name="foto" id="foto" class="form-control" autocomplete="off" accept="image/*">
        </div>
        <div class="form-group col-md-4">
          <label for="comprobante">Comprobante de domicilio del empleado:</label>
          <input type="file" name="comprobante" id="comprobante" class="form-control" autocomplete="off" accept="image/*">
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
<!-- pasar valor de nombre y contrasena a usuario -->
<script type="text/javascript">
  function PasarValor()
{
  var nombre= "";
  var apellido="";
  var nombre= document.getElementById("nombrePers").value;
  var apellido= document.getElementById("apellido").value;
  var arraynombre = nombre.split(" ");
  var arrayapellido = apellido.split(" ");
  for (var i=0; i < 1; i++) {
      document.getElementById("usuario").value =arraynombre[0]+"."+arrayapellido[0];
  }
}
</script>
</script>
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
   $("#form-persona" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombrePers: {//este es el name del input a validar
                    required:true,
                   },
                	 apellido: {
		                required:true,
                	},
                  fecha_nac: {
                    required:true,
                    dateIso:true,
                  },
                  direccion:{
                    required:true,
                  },
                  telefono:{
                    number:true,
                    minlength: 7,
                    maxlength: 10
                  },
                  usuario:{
                    required:true,
                  },
                  contrasena:{
                    required:true,
                    minlength: 8
                  },
                  contrasena2:{
                    required:true,
                    minlength: 8,
                    equalTo: "#contrasena"
                  },
                  id_rol:{
                    required:true,
                  }
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombrePers: {
                        required: "&#x1f5d9; Ingresa el nombre",
                   },
                	 apellido: {
		                    required:"&#x1f5d9; Ingresa el apellido",
                	 },
                   fecha_nac: {
                    required: "&#x1f5d9; Ingresa la fecha de nacimiento",
                    dateIso: "&#x1f5d9; Ingresa una fecha con formato correcto",
                  },
                  direccion:{
                    required: "&#x1f5d9; Ingresa la dirección"
                  },
                  telefono:{
                    number: "&#x1f5d9; Ingresa solo números",
                    minlength: "&#x1f5d9; Ingrese mínimo 7 digitos",
                    maxlength: "&#x1f5d9; Ingresa maxímo 10 dígitos"
                  },
                  usuario:{
                    required: "&#x1f5d9; Ingresa el nombre y el apellido para que se llene este campo"
                  },
                  contrasena:{
                    required: "&#x1f5d9; Ingresa la contrasena del usuario",
                    minlength: "&#x1f5d9; Ingresa al menos 8 caracteres"
                  },
                  contrasena2:{
                    required: "&#x1f5d9; Repite la contraseña anterior",
                    equalTo: "&#x1f5d9; La contraseña no coincide a la anterior",
                    minlength: "&#x1f5d9; Ingresa al menos 8 caracteres"
                  },
                  id_rol:{
                    required: "&#x1f5d9; Selecciona el rol a desempeñar"
                  }
           }
   });
      });
</script>
</html>