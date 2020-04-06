<?php

class User extends Database{
    public $nombre;
    public $usuario;


    public function userExists($usuario, $contrasena){

        $query = $this->connect()->prepare('SELECT * FROM persona WHERE usuario= :usuario');
        $query->execute(['usuario' => $usuario]);

        foreach ($query as $row) {
            $password=$row['contrasena'];
        }
    
        if(password_verify($contrasena, $password)){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM persona WHERE usuario = :usuario');
        $query->execute(['usuario' => $user]);
    }

    // public function getNombre(){
    //     // echo "ahora";
    //     return $this->nombre;
    // }   
}

?>