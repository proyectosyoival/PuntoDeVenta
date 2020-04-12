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
    <div class="center"><?php echo $this->mensaje; ?></div>
    <h1 id="h1-form">Editar Departamento</h1>
    <hr>
    <form action="<?php echo constant('URL');?>departamento/actualizardepartamento" method="POST" id="form-departamento">
      <input type="text" name="id_departamento" hidden="true" value="<?php echo $this->departamento->id_departamento; ?>">
      <div class="form-group">
        <label for="nombreDepa">Nombre del Departamento:</label>
        <input type="text" name="nombreDepa" id="nombreDepa" class="form-control col-md-4" placeholder="Ingresa el nombre del departamento" autocomplete="off" value="<?php echo $this->departamento->nombreDepa; ?>">
        <!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
      </div>
      <div>
        <label for="estado">Estado:</label><br>
        <input type="radio" name="estadoDepa" id="estadoDepa" value="1"> Activo <br>
        <input type="radio" name="estadoDepa" id="estadoDepa" value="0"> Inactivo
      </div>
      <div>
        <a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>departamento">Regresar</a>
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
   $("#form-departamento" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombreDepa: {//este es el name del input a validar
                           required:true,
                           //este es el requisito a validar
                   },
                   estadoDepa: {
                        required:true,
                  }
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombreDepa: {
                           required: "&#x1f5d9; Ingresa el nombre del departamento",//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                   },
                   estadoDepa: {
                        required:"selecciona el estado del departamento",
                   } //debes agregar el mensaje por cada input que pusiste en rules
           }
   });
      });
</script>
</html>
