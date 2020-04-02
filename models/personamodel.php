<?php

include_once 'models/persona.php';

class PersonaModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insert($datos){
        // insertar datos en la BD
        try{
            $query = $this->db->connect()->prepare('INSERT INTO persona (nombrePers, apellido, fecha_nac, direccion, telefono, usuario, contrasena, foto, comprobante, num_empleado, id_rol) VALUES(:nombreRol, :descripcionRol)');
            $query->execute(['nombrePers' => $datos['nombrePers'], 'apellido' => $datos['apellido'], 'fecha_nac' => $datos['fecha_nac'], 'direccion' => $datos['direccion'], 'telefono' => $datos['telefono'], 'usuario' => $datos['usuario'], 'contrasena' => $datos['contrasena'], 'foto' => $datos['foto'], 'num_empleado' => $datos['num_empleado'], 'id_rol' => $datos['id_rol']]);
            return true;
        }catch(PDOException $e){
            //echo $e->getMessage();
            //echo "Ya existe esa matrícula";
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
        $query = $this->db->connect()->prepare("DELETE FROM persona WHERE id_persona= :id_persona");
        try{
            $query->execute([
                'id_persona'=> $id,
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}

?>