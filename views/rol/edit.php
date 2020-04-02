<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Roles</title>
</head>
<body>
  <?php require 'views/header.php'; ?>
  <?php require 'views/menu.php'; ?>

  <div class="container-fluid">
    <div class="center"><?php echo $this->mensaje; ?></div>
    <h1 id="h1-form">Editar Rol</h1>
    <hr>
    <form action="<?php echo constant('URL'); ?>rol/actualizarRol" method="POST" id="form-rol">
      <input type="text" name="id_rol" hidden="true" value="<?php echo $this->rol->id_rol; ?>">
      <div class="form-group">
        <label for="nombreRol">Nombre del Rol:</label>
        <input type="text" name="nombreRol" id="nombreRol" class="form-control col-md-4" placeholder="Ingresa el nombre del rol" autocomplete="off" value="<?php echo $this->rol->nombreRol; ?>">
        <!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
      </div>
      <div class="form-group">
        <label for="descripcionRol">Descripción del Rol:</label>
        <textarea name="descripcionRol" id="descripcionRol" class="form-control col-md-4" placeholder="Ingresa una descripción acerca de las funciones del rol" rows="3" autocomplete="off"><?php echo $this->rol->descripcionRol; ?></textarea>
      </div>
      <div>
        <a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>rol">Regresar</a>
        <button type="submit" class="btn" id="btn-registrar">Actualizar</button>
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