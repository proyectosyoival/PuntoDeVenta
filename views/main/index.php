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
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-cart"></span> Caja</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira">Ir a caja</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-man-woman"></span> Empleados</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira" href="<?php echo constant('URL'); ?>persona">Ir a empleados</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-coin-dollar"></span> Precios</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira">Ir a caja</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-barcode"></span> Codigos de barras</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira">Ir a caja</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-search"></span> Tipos de venta</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira">Ir a caja</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-credit-card"></span> Tipos de pago</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira">Ir a caja</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3">
            <div class="col mb-4" id="col2">
                <div class="card h-100">
                    <div class="card-header text-center" id="card-header"><h5 class="text-center"><span class="icon-stats-dots"></span> Reportes</h5></div>
                    <div class="card-body">
                        <p class="card-text text-left">Apartado para registrar las ventas realizadas durante el día.</p>
                        <div class="text-center"><a type="button" class="btn" id="btn-ira">Ir a caja</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin cards -->
    </div>
</div>
    <?php require 'views/footer.php'; ?> 

</body>
</html>