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
    <div class="center"><?php echo $this->mensaje; ?></div>
    <h1 id="h1-form">Editar Empleado</h1>
    <hr>
    <form action="<?php echo constant('URL'); ?>persona/actualizarPersona" method="POST" id="form-persona" enctype="multipart/form-data">
      <input type="text" name="id_persona" hidden="true" value="<?php echo $this->persona->id_persona; ?>">
      <!-- div nombre y apellido y fecha denacimiento -->
      <div class="form-row">
        <div class="form-group col-md-3">
          <label for="nombrePers">Nombre:</label>
          <input type="text" name="nombrePers" id="nombrePers" class="form-control" placeholder="Ingresa el nombre" autocomplete="off" onkeyup="PasarValor();" value="<?php echo $this->persona->nombrePers;?>">
        </div>
        <div class="form-group col-md-3">
          <label for="apellido">Apellido:</label>
          <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingresa el apellido" autocomplete="off" onkeyup="PasarValor();" value="<?php echo $this->persona->apellido;?>">
        </div>
        <div class="form-group col-md-2">
          <label for="fecha_nac">Fecha de Naciemiento:</label>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" autocomplete="off" value="<?php echo $this->persona->fecha_nac;?>">
        </div>
      </div>
      <!-- div para direccion y telefono-->
      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="direccion">Dirección:</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingresa la dirección" autocomplete="off" value="<?php echo $this->persona->direccion;?>">
        </div>
        <div class="form-group col-md-3">
          <label for="telefono">Núm. de Teléfono o Celular:</label>
          <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ingresa el núm. de teléfono o celular" autocomplete="off" maxlength="10" minlength="7" value="<?php echo $this->persona->telefono;?>">
        </div>
      </div>
      <!-- div para usuario y rol-->
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="usuario">Usuario:</label>
         <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingresa el usuario: Ej. raul.perez" autocomplete="off" readonly value="<?php echo $this->persona->usuario;?>"> 
      </div>
      <?php
        $id_rol=$this->persona->id_rol;
        //sacar los nombres de la tabla de roles
        $db= new Database();
        $query = $db->connect()->prepare('SELECT * FROM rol WHERE id_rol=:id_rol');
        $query->execute(['id_rol' => $id_rol]);
          foreach ($query as $row) {
                  $nombreRol=$row['nombreRol'];           
          } ?>
      <div class="form-group col-md-4">
          <label for="id_rol">Rol del empleado:</label>
          <select name="id_rol" id="id_rol" class="form-control">
            <option value="<?php echo $id_rol;?>" hidden><?php echo $nombreRol;?></option>
            <?php
            //sacar los nombres de la tabla de roles
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
        <div class="form-group col-md-4 text-center">
          <label for="foto">Foto del Empleado:</label><br>
          <?php 
          $foto=$this->persona->foto;
          if (empty($foto)) { ?>
              <input type="file" name="foto" id="foto" class="form-control" autocomplete="off" accept="image/*">
         <?php }else{ ?>
            <input type="file" name="foto" id="foto" class="form-control" autocomplete="off" accept="image/*" hidden="true">
            <img src="<?php echo constant('URL'); ?>img/empleados/<?php echo $this->persona->foto;?>" class="img-edit" id="imgfoto">
            <button type="button" class="close" aria-label="Close" onclick="cambiarfoto();" id="btnfoto">
              <span aria-hidden="true">&times;</span>
            </button>
        <?php } ?>
        </div>
        <div class="form-group col-md-4 text-center">
          <label for="comprobante">Comprobante de domicilio del empleado:</label><br>
          <?php 
          $comprobante=$this->persona->comprobante;
          if (empty($comprobante)) { ?>
              <input type="file" name="comprobante" id="comprobante" class="form-control" autocomplete="off" accept="image/*">
         <?php }else{ ?>
              <input type="file" name="comprobante" id="comprobante" class="form-control" autocomplete="off" accept="image/*" hidden="true">
              <img src="<?php echo constant('URL'); ?>img/empleados/<?php echo $this->persona->comprobante;?>" class="img-edit" id="imgcomprobante">
              <button type="button" class="close" aria-label="Close" onclick="cambiarcomprobante();" id="btncomprobante">
                <span aria-hidden="true">&times;</span>
          <?php } ?>
        </div>
      </div>
      <!-- botones -->
      <div>
        <a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>persona">Regresar</a>
        <button type="submit" class="btn" id="btn-registrar">Actualizar</button>
      </div>
    </form>
  </div>
  
  <?php require 'views/footer.php'; ?>
</body>
<!-- SCRIPT PARA Ocultar imagen -->
<script language="javascript" type="text/javascript">
function cambiarfoto(){
  document.getElementById('imgfoto').hidden=true;
  document.getElementById('btnfoto').hidden=true;
  document.getElementById('foto').hidden=false;
}
function cambiarcomprobante(){
  document.getElementById('imgcomprobante').hidden=true;
  document.getElementById('btncomprobante').hidden=true;
  document.getElementById('comprobante').hidden=false;
}
</script> 
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
<!-- SCRIPT PARA VALIDACION DEL FORMULARIO DE LOGIN-->
<script type="text/javascript">
jQuery.validator.setDefaults({
  debug: false,
  success: "valid",
   errorClass: "my-error-class"
});
jQuery.validator.addMethod("letterandnumbers", function(value, element) {
       return this.optional(element) || /^[a-z0-9\s\.\ñ]+$/i.test(value);
    }, "Solo letras y numeros");
$(function validar() {
   $("#form-persona" ).validate({//#debe tener el nombre del id que le pongan en la etiiqueta form de su formulario
           rules: {//validaciones que va hacer
                   nombrePers: {//este es el name del input a validar
                    required:true,
                    letterandnumbers:true
                   },
                   apellido: {
                    required:true,
                    letterandnumbers:true
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
                    minlength: 8
                  },
                  contrasena2:{
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
                        letterandnumbers: "&#x1f5d9; Ingresa el nombre sin acentos u otro caracter especial"
                   },
                   apellido: {
                        required:"&#x1f5d9; Ingresa el apellido",
                        letterandnumbers: "&#x1f5d9; Ingresa el apellido sin acentos u otro caracter esspecial"
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
                    minlength: "&#x1f5d9; Ingresa al menos 8 caracteres"
                  },
                  contrasena2:{
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