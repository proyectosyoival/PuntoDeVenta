<?php

class UserSession{

    public function __construct(){
        session_start();
    }

    public function setCurrentUser($user){
        $db= new Database();
        $_SESSION['usuario'] = $user;
        $query = $db->connect()->prepare('SELECT * FROM persona WHERE usuario = :usuario');
        $query->execute(['usuario' => $user]);
        
        foreach ($query as $currentUser) {
            $query->idPersona = $currentUser['id_persona'];
            $query->nombre = $currentUser['nombrePers'];
            $query->apellido = $currentUser['apellido'];
            $query->rol = $currentUser['id_rol'];
        }
         $_SESSION['idPersona'] = $query->idPersona;
         $_SESSION['nombre'] = $query->nombre;
         $_SESSION['apellido'] = $query->apellido;
         $_SESSION['rol'] = $query->rol;
    }

    public function getCurrentUser(){
        return $_SESSION['usuario'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>