<?php
require_once 'libs/database.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
require_once 'libs/model.php';
require_once 'libs/app.php';
require_once 'config/config.php';
include_once 'controllers/Checklogin.php';
include_once 'controllers/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['usuario'])){
    $user->setUser($userSession->getCurrentUser());
    $app = new App();

}else if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
    
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $user = new User();
    if($user->userExists($usuario, $contrasena)){
        // echo "Existe el usuario";
        $userSession->setCurrentUser($usuario);
        $user->setUser($usuario);

         $app = new App();
        // include_once 'views/main/index.php';
    }else{
        // echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'views/login/index.php';
        // $app = new App();
    }
}else{
    // echo "login";
    include_once 'views/login/index.php';
    // $app = new App();
}

?>