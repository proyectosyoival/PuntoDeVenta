<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Punto de Venta</title>
    <!-- links para css -->
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootsrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/fonts/style.css">
    <!-- script para js -->
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/jquery-3.2.1.slim.min.js"></script> 
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/functions.js"></script> 
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/js/bootsrap.min.js">
    <!-- links o script de internet -->
    <!-- Cargamos la fuente de Google Raleway : visitar Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body> 
    <div id="wrapper">
        <section>
            <header>
                <a href="#" id="exit">
                    <span class="icon-switch"></span>
                </a>
                <a href="#" id="menu_on">
                    <span></span>
                    <span></span>
                    <span></span>
                 </a>
            </header>
            <nav>
                <ul>
                    <li><a href="#"><span class="icon-cart"></span> Venta</a></li>
                    <li><a href="#"><span class="icon-search"></span> Consultar precios</a></li>
                </ul>
            </nav>
        </section>
    </div>
</body>
</html>