
<?php

class Main extends Controller{

    function __construct(){
        parent::__construct();
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
    	$nombre1 = new User();
    	$nombre1->getNombre();
        $this->view->render('main/index');
    }

}

?>