<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body> 
	<?php require 'views/header.php'; ?>
	<div class="container justify-content-center col-md-6" id="cont-login">
    	<div class="text-center">
    		<p id="head-login">Iniciar Sesión</p>
    		<img src="<?php echo constant('URL'); ?>public/img/userlogin.png" class="img-fluid" width="100px" height="100px" id="img-login">
    	</div>

    	<div class="justify-content-center" id="body-login">
    		<div class="form-group">
    			<label>Usuario:</label>
    			<input type="text" name="" class="form-control" placeholder="Ingresa un usuario">
    		</div>
    		<div class="form-group">
    			<label>Contraseña:</label>
    			<input type="password" name="" class="form-control" placeholder="Ingresa la contraseña">
    		</div>
    	</div>
  	</div>
	<?php require 'views/footer.php'; ?>
</body>
</html>