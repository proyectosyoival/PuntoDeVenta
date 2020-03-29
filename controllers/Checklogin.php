<?php

class User extends Database{
    public $nombre;
    public $usuario;


    public function userExists($usuario, $contrasena){

        $query = $this->connect()->prepare('SELECT * FROM persona WHERE usuario= :usuario AND contrasena = :contrasena');
        $query->execute(['usuario' => $usuario, 'contrasena' => $contrasena]);
    
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        // echo $user;
        $query = $this->connect()->prepare('SELECT * FROM persona WHERE usuario = :usuario');
        $query->execute(['usuario' => $user]);
    }

    // public function getNombre(){
    //     // echo "ahora";
    //     return $this->nombre;
    // }   
}

?>