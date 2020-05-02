<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PRECIO</title>
</head>
<body>
  <?php require 'views/header.php'; ?>
  <?php require 'views/menu.php'; ?>
  <div class="container-fluid">
   <div class="center"><?php echo $this->mensaje; ?></div>
   <h1 id="h1-form">Editar Precio</h1>
   <hr>
   <form action="<?php echo constant('URL'); ?>precio/actualizarPrecio" method="POST">
    <input type="text" name="id_precio" hidden="true" value="<?php echo $this->precio->id_precio; ?>">
    <div class="form-group">
      <label for="precioGeneral">General:</label>
      <input type="text" name="precioGeneral" id="precioGeneral" class="form-control col-md-4" placeholder="Precio del Producto" value="<?php echo $this->precio->general; ?>" required>
    </div>
    <div class="form-group">
      <label for="precioMayoreo">Al mayoreo:</label>
      <input type="text" name="precioMayoreo" id="precioMayoreo" class="form-control col-md-4" placeholder="Precio del Producto al Mayoreo" value="<?php
          $precioMayoreo = $this->precio->mayoreo;
          if($precioMayoreo == null)
           echo '0';
         else
          echo $precioMayoreo;
        ?>" required>
    </div>
    <div>
      <a type="button" class="btn" id="btn-regresar" href="<?php echo constant('URL'); ?>precio">Regresar</a>
      <button type="submit" class="btn" id="btn-registrar">Actualizar</button>
    </div>
  </form>
</div>

<?php require 'views/footer.php'; ?>
</body>
</html>