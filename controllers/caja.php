<?php

class Caja extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personas = [];
        
        //echo "<p>Nuevo controlador Main</p>";
    }

    function nuevo(){
        $this->view->render('caja/nuevo');
    }

    function render(){
        $cajas = $this->model->get();
        $this->view->cajas = $cajas;

        $this->view->render('caja/index');
    }

    function registrarCaja(){
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
        
        if ($id_ultimo<10) {
          $id_ultimo="0".$id_ultimo;  
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
           // echo $mensaje = "IVA creado";
        }else{
           // echo $mensaje = "La matrícula ya existe";
        }
            // $this->view->mensaje = $mensaje;
            $this->render();
    }

    function verCaja($param = null){
        $id_persona = $param[0];
        $persona = $this->model->getById($id_persona);

        // session_start();
        $_SESSION['id_persona'] = $persona->id_persona;
        $this->view->persona = $persona;
        $this->view->mensaje = "";
        $this->view->render('persona/edit');
    }

    function actualizarCaja(){
        // session_start();
        $id_persona = $_POST['id_persona'];
        $nombrePers = $_POST['nombrePers'];
        $apellido = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $foto = $_FILES['foto'];
        $comprobante = $_FILES['comprobante'];
        $id_rol = $_POST['id_rol'];

        //mandar variable correcta de comprobante y foto
        $db= new Database();
        $query = $db->connect()->prepare('SELECT * FROM persona WHERE id_persona=:id_persona');
        $query->execute(['id_persona' => $id_persona]);
          foreach ($query as $row) {
                  $contrasenaold=$row['contrasena'];
                  $fotoold = $row['foto'];
                  $comprobanteold = $row['comprobante'];
                  $num_empleado= $row['num_empleado'];        
          }
        // verificar si la contraseña viene vacia
        if ($contrasena=="") {
            $contrasena=$contrasenaold;
        }else{
            $contrasena=password_hash($contrasena, PASSWORD_BCRYPT);
        }

        $cfoto=$num_empleado."-".$foto["name"];
        $ccomprobante=$num_empleado."-".$comprobante["name"];
        // si sube fotos con el mismo nombre
        if ($cfoto==$fotoold && $ccomprobante==$comprobanteold) {
            $nfoto=$fotoold;
            $ncomprobante=$comprobanteold;  
        //si no sube fotos          
         }elseif ($foto["name"]=="" && $comprobante["name"]=="") {
            $nfoto=$fotoold;
            $ncomprobante=$comprobanteold;  
        // si sube fotos diferentes dos fotos diferentes a las guardadas
         }elseif ($cfoto!=$fotoold && $ccomprobante!=$comprobanteold && $foto["name"]!="" && $comprobante["name"]!="") {
             // array_push($arrayupfotos, $foto, $comprobante);
             $this->subirfotos($foto, $comprobante, $num_empleado);
             $nfoto=basename( $num_empleado."-".$foto["name"]);
             $ncomprobante=basename( $num_empleado."-".$comprobante["name"]);
             @unlink('img/empleados/'.$fotoold);
             @unlink('img/empleados/'.$comprobanteold);
             // echo "<br>".$cfoto."-".$fotoold."-".$ccomprobante."-".$comprobanteold;
        // si una foto es diferente pero comprobante es igual
         }elseif ($ccomprobante==$comprobanteold && $foto["name"]=="") {
            $ncomprobante=$comprobanteold;
            $nfoto=$fotoold; 
            // si el comprobante es diferente pero la foto es igual
         }elseif ($cfoto==$fotoold && $comprobante["name"]=="") {
            $ncomprobante=$comprobanteold;
            $nfoto=$fotoold;
            
         }elseif ($ccomprobante!=$comprobanteold && $foto["name"]=="") {
            //si se cambia el comprobante y la foto queda igual
            $foto["name"]="";
            $this->subirfotos($foto, $comprobante, $num_empleado);
            @unlink('img/empleados/'.$comprobanteold);
            $ncomprobante=basename( $num_empleado."-".$comprobante["name"]);
            $nfoto=$fotoold; 
            // si la foto es diferente y el comprobante igual
         }elseif ($cfoto!=$fotoold && $comprobante["name"]=="") {
            $comprobante["name"]="";
            $this->subirfotos($foto, $comprobante, $num_empleado);
            @unlink('img/empleados/'.$fotoold);
            $nfoto=basename( $num_empleado."-".$foto["name"]);
            $ncomprobante=$comprobanteold;
            
         }

        // unset($_SESSION['id_iva']);

        if($this->model->update(['id_persona' => $id_persona, 'nombrePers' => $nombrePers, 'apellido' => $apellido, 'fecha_nac' => $fecha_nac, 'direccion' => $direccion, 'telefono' => $telefono, 'usuario' => $usuario, 'contrasena' => $contrasena, 'foto' => $nfoto, 'comprobante' => $ncomprobante, 'id_rol' => $id_rol,])){
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
            $persona->foto = $nfoto; 
            $persona->comprobante = $ncomprobante; 
            $persona->id_rol = $id_rol;           
            $this->view->persona = $persona;
            $this->view->mensaje = "Registro actualizado correctamente";
        }else{
            // mensaje de error
            $this->view->mensaje = "No se pudo actualizar el registro";
        }
        $this->view->render('persona/edit');
    }

    public function subirfotos($foto, $comprobante, $num_empleado){
        $arrayupfotos=array($foto, $comprobante);
            for ($i=0; $i <count($arrayupfotos) ; $i++) { 
                 //INICIA SUBIR IMAGEN AL SERVIDOR
                $target_dir = "img/empleados/";
                $target_file = $target_dir . basename($num_empleado."-".$arrayupfotos[$i]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($arrayupfotos[$i]["tmp_name"]);
                    if($check !== false) {
                        echo "El archivo es una imagen - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        // echo "El archivo no es una imagen.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    // echo "Lo siento, el archivo ya existe.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($arrayupfotos[$i]["size"] > 2000000) {
                    // echo "Lo siento, el archivo es muy grande.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    // echo "Lo siento, solo los archivos JPG, JPEG, PNG & GIF guardados.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    // echo "Lo siento, tu archivo no se pudo guardarx2.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($arrayupfotos[$i]["tmp_name"], $target_file)) {
                        "The file ". basename($arrayupfotos[$i]["name"]). " has been uploaded.";
                         //TERMINA SUBIR IMAGEN AL SERVIDOR
                    } else {
                        // echo "Lo siento, hubo un error al subir el archivo.";
                    }
                }
            }
        }

    function eliminarCaja($param = null){
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