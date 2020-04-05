<?php

include_once 'models/persona.php';

class PersonaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
        $foto=$datos['foto'] ;
        $comprobante=$datos['comprobante'];  
        $arrayupfotos=array();
        array_push($arrayupfotos, $foto, $comprobante);
        for ($i=0; $i <count($arrayupfotos) ; $i++) { 
             //INICIA SUBIR IMAGEN AL SERVIDOR
            $target_dir = "img/empleados/";
            $target_file = $target_dir . basename($datos['num_empleado']."-".$arrayupfotos[$i]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($arrayupfotos[$i]["tmp_name"]);
                if($check !== false) {
                    echo "El archivo es una imagen - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "El archivo no es una imagen.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Lo siento, el archivo ya existe.";
                $uploadOk = 0;
            }
            // Check file size
            if ($arrayupfotos[$i]["size"] > 2000000) {
                echo "Lo siento, el archivo es muy grande.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Lo siento, solo los archivos JPG, JPEG, PNG & GIF guardados.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Lo siento, tu archivo no se pudo guardar.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($arrayupfotos[$i]["tmp_name"], $target_file)) {
                    "The file ". basename($arrayupfotos[$i]["name"]). " has been uploaded.";
                } else {
                    echo "Lo siento, hubo un error al subir el archivo.";
                }
            }
        }

        //TERMINA SUBIR IMAGEN AL SERVIDOR
        $foto = basename( $datos['num_empleado']."-".$foto["name"]);
        $comprobante = basename( $datos['num_empleado']."-".$comprobante["name"]);

            $query = $this->db->connect()->prepare('INSERT INTO persona (nombrePers, apellido, fecha_nac, direccion, telefono, usuario, contrasena, foto, comprobante, num_empleado, id_rol) VALUES(:nombrePers, :apellido, :fecha_nac, :direccion, :telefono, :usuario, :contrasena, :foto, :comprobante, :num_empleado, :id_rol)');
            $query->execute(['nombrePers' => $datos['nombrePers'], 'apellido' => $datos['apellido'], 'fecha_nac' => $datos['fecha_nac'], 'direccion' => $datos['direccion'], 'telefono' => $datos['telefono'], 'usuario' => $datos['usuario'], 'contrasena' => $datos['contrasena'], 'foto' => $foto, 'comprobante' => $comprobante, 'num_empleado' => $datos['num_empleado'], 'id_rol' => $datos['id_rol']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            // echo "Ya existe esa matrícula";
            return false;
        }
        
    }
    
    public function get(){
        $items = [];

        try{

            $query = $this->db->connect()->query("SELECT*FROM persona");

            while($row = $query->fetch()){
                $item = new Personas();
                $item->id_persona = $row['id_persona'];
                $item->nombrePers = $row['nombrePers'];
                $item->apellido = $row['apellido'];
                $item->fecha_nac = $row['fecha_nac'];
                $item->direccion = $row['direccion'];
                $item->telefono = $row['telefono'];
                $item->telefono = $row['telefono'];
                $item->usuario = $row['usuario'];
                $item->contrasena = $row['contrasena'];
                $item->foto = $row['foto'];
                $item->comprobante = $row['comprobante'];
                $item->num_empleado = $row['num_empleado'];
                $item->id_rol = $row['id_rol'];
                array_push($items, $item);
            }

            return $items;
        }catch(PDOException $e){
            return [];
        }
    }

    public function getById($id_persona){
        $item = new Personas();

        $query = $this->db->connect()->prepare("SELECT * FROM persona WHERE id_persona = :id_persona");
        try{
            $query->execute(['id_persona' => $id_persona]);

            while($row = $query->fetch()){
                $item->id_persona = $row['id_persona'];
                $item->nombrePers = $row['nombrePers'];
                $item->apellido = $row['apellido'];
                $item->fecha_nac = $row['fecha_nac'];
                $item->direccion = $row['direccion'];
                $item->telefono = $row['telefono'];
                $item->telefono = $row['telefono'];
                $item->usuario = $row['usuario'];
                $item->contrasena = $row['contrasena'];
                $item->foto = $row['foto'];
                $item->comprobante = $row['comprobante'];
                $item->num_empleado = $row['num_empleado'];
                $item->id_rol = $row['id_rol'];
            }

            return $item;
        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        $query = $this->db->connect()->prepare("UPDATE persona SET nombrePers = :nombrePers, apellido = :apellido, fecha_nac = :fecha_nac, direccion = :direccion, telefono = :telefono, usuario = :usuario, contrasena = :contrasena, foto = :foto, comprobante = :comprobante, num_empleado = :num_empleado, id_rol = :id_rol, WHERE id_persona = :id_persona");
        try{
            $query->execute([
                'id_persona'=> $item['id_persona'],
                'nombrePers'=> $item['nombrePers'],
                'apellido'=> $item['apellido'],
                'fecha_nac'=> $item['fecha_nac'],
                'direccion'=> $item['direccion'],
                'telefono'=> $item['telefono'],
                'usuario'=> $item['usuario'],
                'contrasena'=> $item['contrasena'],
                'foto'=> $item['foto'],
                'comprobante'=> $item['comprobante'],
                'num_empleado'=> $item['num_empleado'],
                'id_rol'=> $item['id_rol'],
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function delete($id){
        $db = new Database();
        $query3 = $db->connect()->prepare('SELECT * FROM PERSONA WHERE id_persona= :id_persona');
        $query3->execute([
                'id_persona'=> $id,
            ]);
        foreach ($query3 as $row) {
            $foto=$row['foto'];
            $comprobante=$row['comprobante'];
        }
        $query = $this->db->connect()->prepare("DELETE FROM persona WHERE id_persona= :id_persona");
        try{
            $query->execute([
                'id_persona'=> $id,
            ]);
            @unlink('img/empleados/'.$foto);
            @unlink('img/empleados/'.$comprobante);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>