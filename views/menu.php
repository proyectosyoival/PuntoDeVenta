<!DOCTYPE html>
<html lang="en">
<body> 
    <div id="wrapper">
        <section>
            <header>
                <!-- boton de modal para salir -->
                 <button type="button" class="btn" data-toggle="modal" data-target="#modalsalir" id="exit">
                    <span class="icon-switch"></span>
                </button>
                <!-- <a href="<?php echo constant('URL'); ?>controllers/logout.php" id="exit">
                    <span class="icon-switch"></span>
                </a> -->
                <a href="#" id="menu_on">
                    <span></span>
                    <span></span>
                    <span></span>
                 </a>
            </header>
            <nav>
                <ul>
                    <li><a href="#"><span class="icon-home"></span> Home</a></li>
                    <li><a href="#"><span class="icon-cart"></span> Caja</a></li>
                    <li><a href="#"><span class="icon-search"></span> Consultar precios</a></li>
                    <li><a href="#"><span class="icon-price-tag"></span> Productos</a></li>
                    <li><a href="#"><span class="icon-search"></span> Inventarios</a></li>
                    <li><a href="#"><span class="icon-man-woman"></span> Empleados</a></li>
                    <li><a href="#"><span class="icon-coin-dollar"></span> Precios</a></li>
                    <li><a href="#"><span class="icon-barcode"></span> Codigos de barras</a></li>
                    <li><a href="#"><span class="icon-search"></span> Tipos de venta</a></li>
                    <li><a href="#"><span class="icon-price-tag"></span> Productos</a></li>
                    <li><a href="#"><span class="icon-search"></span> Inventarios</a></li>
                    <li><a href="#"><span class="icon-man-woman"></span> Empleados</a></li>
                    <li><a href="#"><span class="icon-coin-dollar"></span> Precios</a></li>
                    <li><a href="#"><span class="icon-barcode"></span> Codigos de barras</a></li>
                    <li><a href="#"><span class="icon-search"></span> Tipos de venta</a></li>
                    <li><a href="#"><span class="icon-credit-card"></span> Tipos de pago</a></li>
                    <li><a href="#"><span class="icon-stats-dots"></span> Reportes</a></li>
                </ul>
            </nav>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalsalir" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" id="modal-header">
            <h5 class="modal-title text-center" id="exampleModalCenterTitle">SALIR</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            ¿Estas seguro que deseas salir del sistema?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" id="btn-cancelar-modal" data-dismiss="modal">No</button>
            <a type="button" class="btn btn-danger" href="<?php echo constant('URL'); ?>controllers/logout.php">Salir</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin modal -->
</body>
</html>