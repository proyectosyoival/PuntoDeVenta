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
    //echo "hay sesion";
    $user->setUser($userSession->getCurrentUser());
    $app = new App();

}else if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
    
    $userForm = $_POST['usuario'];
    $passForm = $_POST['contrasena'];

    $user = new User();
    if($user->userExists($userForm, $passForm)){
        //echo "Existe el usuario";
        $userSession->setCurrentUser($userForm);
        $user->setUser($userForm);

         $app = new App();
        // include_once 'views/main/index.php';
    }else{
        //echo "No existe el usuario";
        $errorLogin = "Nombre de usuario y/o password incorrecto";
        include_once 'views/login/index.php';
        // $app = new App();
    }
}else{
    //echo "login";
    include_once 'views/login/index.php';
    // $app = new App();
}

?>