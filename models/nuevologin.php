<?php

class NuevoLogin extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function selectlogin($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('SELECT * FROM persona WHERE usuario=:usuario AND contrasena=:contrasena');
            $query->execute(['usuario' => $datos['usuario'], 'contrasena' => $datos['contrasena']]);
            echo $query;
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            echo "Ya existe esa matrícula";
            return false;
        }
        
    }
}

?>