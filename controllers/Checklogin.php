<?php
// include 'libs/database.php';

class User extends Database{
    private $nombre;
    private $username;


    public function userExists($usuario, $contrasena){

        $query = $this->connect()->prepare('SELECT * FROM persona WHERE usuario= :usuario AND contrasena = :contrasena');
        $query->execute(['usuario' => $usuario, 'contrasena' => $contrasena]);
    
        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($usuario){
        $query = $this->connect()->prepare('SELECT * FROM persona WHERE usuario = :usuario');
        $query->execute(['usuario' => $usuario]);
        
        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['nombre'];
            $this->usename = $currentUser['usuario'];
        }
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>