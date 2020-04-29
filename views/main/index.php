<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    <?php require 'views/menu.php'; ?>
<div class="container-fluid">
    	<div class="">
    		<h1>Bienvenido(a) <?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></h1>
    	</div>
    <!-- inicio de carvies -->
    <div class="row justify-content-center" id="cards">
        <?php
                    include_once 'models/main.php';
                    foreach($this->menus as $row){
                        $menus = new Menu();
                        $menus = $row; 
        ?>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><?php echo $menus->iconoMenu." ".$menus->nombreMenu;?></h5></div>
                    <div class="card-body">
                        <p class="card-text text-left"><?php echo $menus->descripcionMenu;?></p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira" href="<?php echo constant('URL'); ?>caja">Ir a <?php echo $menus->nombreMenu;?></a></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- fin cards -->
    </div>
</div>
    <?php require 'views/footer.php'; ?>

</body>
</html>
