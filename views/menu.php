<?php
    $rol=$_SESSION['rol'];
    $nombre_rol="";
    // consulta para sacar el nombre del rol
    $db= new Database();
    $query = $db->connect()->prepare('SELECT * FROM rol WHERE id_rol = :id_rol');
        $query->execute(['id_rol' => $rol]);

        foreach ($query as $currentUser) {
            $query->nombre = $currentUser['nombreRol'];
        }
    $nombre_rol=$query->nombre;
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div id="wrapper">
        <section>
            <header>
                <div class="row container">
                    <a href="#" id="menu_on">
                        <span></span>
                        <span></span>
                        <span></span>
                     </a>
                    <span id="span-sesion"><?php echo $_SESSION['nombre']/*." ".$_SESSION['apellido']*/."-".$nombre_rol;?></span>
                    <!-- boton de modal para salir -->
                    <button type="button" class="btn" data-toggle="modal" data-target="#modalsalir" id="exit">
                        <span class="icon-switch"></span>
                    </button>
                </div>
            </header>
            <nav>
                <ul>
                    <li><a href="<?php echo constant('URL'); ?>main"><span class="icon-home"></span> Home</a></li>
                    <li><a href="#"><span class="icon-cart"></span> Caja</a></li>
                    <li><a href="#"><span class="icon-search"></span> Consultar precios</a></li>
                    <li><a href="<?php echo constant('URL'); ?>rol"><span class="icon-users"></span> Roles</a></li>
                    <li><a href="<?php echo constant('URL'); ?>producto"><span class="icon-price-tag"></span> Productos</a></li>
                    <li><a href="#"><span class="icon-search"></span> Inventarios</a></li>
                    <li><a href="<?php echo constant('URL'); ?>persona"><span class="icon-man-woman"></span> Empleados</a></li>
                    <li><a href="#"><span class="icon-coin-dollar"></span> Precios</a></li>
                    <li><a href="#"><span class="icon-barcode"></span> Codigos de barras</a></li>
                    <li><a href="#"><span class="icon-search"></span> Tipos de venta</a></li>
                    <li><a href="#"><span class="icon-search"></span> Inventarios</a></li>
                    <li><a href="<?php echo constant('URL'); ?>departamento"><span class="icon-woman"></span> Departamento</a></li>
                    <li><a href="<?php echo constant('URL'); ?>categoria"><span class="icon-user-tie"></span> Categorias</a></li>
                    <li><a href="<?php echo constant('URL'); ?>iva"><span class="icon-coin-dollar"></span> IVA</a></li>
                    <li><a href="#"><span class="icon-barcode"></span> Codigos de barras</a></li>
                    <li><a href="#"><span class="icon-search"></span> Tipos de venta</a></li>
                    <li><a href="<?php echo constant('URL'); ?>tipoPago"><span class="icon-credit-card"></span> Tipos de pago</a></li>
                    <li><a href="#"><span class="icon-stats-dots"></span> Reportes</a></li>
                    <li><a href="<?php echo constant('URL'); ?>tipomovcaja"><span class="icon-enlarge"></span> Tipos de movimiento de cajas</a></li>
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
