<?php

class Persona extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personas = [];
        
        //echo "<p>Nuevo controlador Main</p>";
    }

    function nuevo(){
        $this->view->render('persona/nuevo');
    }

    function render(){
        $personas = $this->model->get();
        $this->view->personas = $personas;

        $this->view->render('persona/index');
    }

    function registrarPersona(){
        $nombrePers = $_POST['nombrePers'];
        $apellido = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $foto = $_FILES["foto"];
        $comprobante = $_FILES["comprobante"];
        $id_rol = $_POST['id_rol'];
        $mensaje = "";

        $db=new Database();
        $query = $db->connect()->prepare('SELECT * FROM PERSONA ORDER BY id_persona DESC LIMIT 1');
        $query->execute();
        foreach ($query as $row) {
            $id_ultimo=$row['id_persona']+1;
        }
        if ($id_rol==1) {
            $num_empleado= 'ADM'.date('dmy').$id_ultimo;
        }elseif ($id_rol==2) {
            $num_empleado= 'ENC'.date('dmy').$id_ultimo;
        }elseif ($id_rol==3) {
            $num_empleado= 'CAJ'.date('dmy').$id_ultimo;
        }elseif ($id_rol==4) {
            $num_empleado= 'VEN'.date('dmy').$id_ultimo;
        }

        if($this->model->insert(['nombrePers' => $nombrePers, 'apellido' => $apellido, 'fecha_nac' => $fecha_nac, 'direccion' => $direccion, 'telefono' => $telefono, 'usuario' => $usuario, 'contrasena' => $contrasena, 'foto' => $foto, 'comprobante' => $comprobante, 'num_empleado' => $num_empleado, 'id_rol' => $id_rol,])){
            // $mensaje = "IVA creado";
        }else{
            // $mensaje = "La matrícula ya existe";
        }
            $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verPersona($param = null){
        $id_persona = $param[0];
        $persona = $this->model->getById($id_persona);

        // session_start();
        $_SESSION['id_persona'] = $persona->id_persona;
        $this->view->persona = $persona;
        $this->view->mensaje = "";
        $this->view->render('persona/edit');
    }

    function actualizarPersona(){
        // session_start();
        $nombrePers = $_POST['nombrePers'];
        $apellido = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $foto = $_POST['foto'];
        $comprobante = $_POST['comprobante'];
        $num_empleado = $_POST['num_empleado'];
        $id_rol = $_POST['id_rol'];

        // unset($_SESSION['id_iva']);

        if($this->model->update(['id_persona' => $id_persona, 'nombrePers' => $nombrePers, 'apellido' => $apellido, 'fecha_nac' => $fecha_nac, 'direccion' => $direccion, 'telefono' => $telefono, 'usuario' => $usuario, 'contrasena' => $contrasena, 'foto' => $foto, 'comprobante' => $comprobante, 'num_empleado' => $num_empleado, 'id_rol' => $id_rol,])){
            // actualizar alumno exito
            $persona = new Personas();
            $persona->id_persona = $id_persona;
            $persona->nombrePers = $nombrePers;
            $persona->apellido = $apellido;
            $persona->fecha_nac = $fecha_nac;
            $persona->direccion = $direccion;
            $persona->telefono = $telefono;
            $persona->usuario = $usuario;
            $persona->contrasena = $contrasena;
            $persona->foto = $foto;
            $persona->comprobante = $comprobante;
            $persona->num_empleado = $num_empleado;
            $persona->id_rol = $id_rol;           
            $this->view->persona = $persona;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('persona/edit');
    }

    function eliminarPersona($param = null){
        $id_persona = $param[0];

        if($this->model->delete($id_persona)){
            // $this->view->mensaje = "Alumno eliminado correctamente";
            $mensaje = 1;
        }else{
            // mensaje de error
            // $this->view->mensaje = "No se pudo eliminar el alumno";
            $mensaje = 0;
        }
        // $this->render();
        
        echo $mensaje;
    }
}

?>