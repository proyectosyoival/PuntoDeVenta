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
                    <?php
                    // include_once 'models/main.php';
                    // foreach($this->menus as $row){
                    //     $menus = new Menu();
                    //     $menus = $row; 
                    $query = $db->connect()->prepare('SELECT * FROM menu ORDER BY nombreMenu');
                    $query->execute();

                    foreach ($query as $currentUser) {
                        $query->nombreMenu = $currentUser['nombreMenu'];
                        $query->iconoMenu = $currentUser['iconoMenu'];
                        $query->controlerMenu = $currentUser['controlerMenu'];
                    ?>
                    <li><a href="<?php echo constant('URL').$query->controlerMenu?>"><?php echo $query->iconoMenu." ".$query->nombreMenu;?></a></li>
                    <?php } ?>
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
