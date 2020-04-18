<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tipos de Pago</title>
</head>
<body>
  <?php require 'views/header.php'; ?>
  <?php require 'views/menu.php'; ?>

  <div class="container-fluid">
    <div class="center"><?php echo $this->mensaje; ?></div>
    <h1 id="h1-form">Editar Tipo de Pago</h1>
    <hr>
    <form action="<?php echo constant('URL'); ?>tipoPago/actualizarTipoPago" method="POST" id="form-tipoPago">
      <input type="text" name="id_categoria" hidden="true" value="<?php echo $this->tipoPago->id_tipo_pago; ?>">
      <div class="form-group">
        <label for="descripcionTipoPago">Descripción del Tipo de pago:</label>
        <textarea name="descripcionTipoPago" id="descripcionTipoPago" class="form-control col-md-4" placeholder="Ingresa una descripción acerca del Tipo de Pago" rows="3" autocomplete="off"><?php echo $this->tipoPago->descripcionTipoPago; ?></textarea>
      </div>
      <div>
        <a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>tipoPago">Regresar</a>
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
   $("#form-tipoPago" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   descripcionTipoPago: {
                        required:true,
                  }
           },
           messages: {//mensaje si no se cumplen las validaciones

                   descripcionTipoPago: {
                        required:"&#x1f5d9; Ingresa la descripción del Tipo de Pago",
                   } //debes agregar el mensaje por cada input que pusiste en rules
           }
   });
      });
</script>
</html>
