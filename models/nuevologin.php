<?php

class NuevoLogin extends Model{
    echo "fin";

    public function __construct(){
        parent::__construct();
    }

    public function userExists($datos){
        try {
            $query = $this->db->connect()->prepare('SELECT * FROM persona WHERE usuario = :usuario AND contrasena = :contrasena');
            $query->execute(['usuario' => $datos['usuario'], 'contrasena' => $datos['contrasena']]);

            if($query->rowCount()){
                return true;
            }else{
                return false;
            }

        public function setUser($datos){
            $query = $this->db->connect()->prepare('SELECT * FROM persona WHERE usuario = :usuario');
            $query->execute(['usuario' => $datos['usuario']]);
        
            foreach ($query as $currentUser) {
                $this->nombre = $currentUser['nombre'];
                $this->usuario = $currentUser['usuario'];
            }
        }

        public function getNombre(){
            return $this->nombre;
        }

       }catch(PDOException $e){
            //echo $e->getMessage();
            return false;
        }
    }

}

?>