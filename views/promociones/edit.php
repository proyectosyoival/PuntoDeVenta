<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Promociones</title>
</head>
<body>
  <?php require 'views/header.php'; ?>
  <?php require 'views/menu.php'; ?>

  <div class="container-fluid">
    <div class="center"><?php echo $this->mensaje; ?></div>
    <h1 id="h1-form">Editar Promocion</h1>
    <hr>
    <form action="<?php echo constant('URL'); ?>promociones/actualizarPromo" method="POST" id="form-promocion">
      <input type="text" name="id_promocion" hidden="true" value="<?php echo $this->promocion->id_promocion; ?>">
      <div class="form-group">
        <label for="nombrePromo">Nombre de la Promocion:</label>
        <input type="text" name="nombrePromo" id="nombrePromo" class="form-control col-md-4" placeholder="Ingresa el nombre de la promocion" autocomplete="off" value="<?php echo $this->promocion->nombrePromo; ?>">
        <!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
      </div>
      <div class="form-group">
        <label for="descripcionPromo">Descripción de Promocion:</label>
        <textarea name="descripcionPromo" id="descripcionPromo" class="form-control col-md-4" placeholder="Ingresa una descripción acerca de la promocion" rows="3" autocomplete="off"><?php echo $this->promocion->descripcionPromo; ?></textarea>
      </div>
      <div class="form-group">
        <label for="fecha_vigencia">Fecha de vigencia:</label>
        <input type="text" name="fecha_vigencia" id="fecha_vigencia" class="form-control col-md-4" placeholder="Ingresa una fecha de vigencia" autocomplete="off" value="<?php echo $this->promocion->fecha_vigencia; ?>">
        <!-- el uso de la clase col-md-4 es para darle el tamaño, el tamaño maximoes 12 que ocuparia toda la pantalla -->
      </div>
      <div>
        <a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>promociones">Regresar</a>
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
   $("#form-promocion" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombrePromo: {//este es el name del input a validar
                           required:true,
                           //este es el requisito a validar
                   },
                   descripcionPromo: {
                        required:true,
                  },
                  fecha_vigencia{
                    require:true,
                  }
           },
           messages: {//mensaje si no se cumplen las validaciones
                   nombrePromo: {
                           required: "&#x1f5d9; Ingresa el nombre de la promocion",//poner el mensaje que quieres que se muestre si no se cumple la validacion, el &#x1f5d9 es el simbolo de equis que se va mostrar si no se cumple la validacon
                   },
                   descripcionPromo: {
                        required:"&#x1f5d9; Ingresa la descripción de la promocion",
                   }, //debes agregar el mensaje por cada input que pusiste en rules
                   fecha_vigencia: {
                        required:"&#x1f5d9; Ingresa una fecha de vigencia",
                   }
           }
   });
      });
</script>
</html>
