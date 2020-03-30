<?php


class departamentoModel extends Model{

  public function _construct(){
    parent::__construct();
  }

  public function get(){
    $items =[];

    try {
      $query =$this->db->connect()->query("SELECT *FROM departamento");
      while($row = $query->fetch()){
        $item = new Departamento();
        $item->nombreDepa = $row['nombreDepa'];
        $item->estadoDepa = $row['estadoDepa'];
        $item->fecha_alta = $row ['fecha_alta'];

        array_push($items, $item);
      }
      return $items;

    } catch (PDOException $e) {
      return [];
    }

  }

  public function insert($data){
    try{
      $query = $this->db->connect()->prepare('INSERT INTO departamento(nombreDepa, estadoDepa, fecha_alta) VALUES(:nombreDepa, :estadoDepa, :fecha_alta)');
      $query->execute(['nombreDepa'=> $datos['nombreDepa'], 'estadoDepa'=>$datos['estadoDepa'], 'fecha_alta' => $datos['fecha_alta']]);
      return true;

    }catch (PDOException $e){
      return false;
    }
  }

  public function Update($data){
    $query = $this->db->connect()->prepare("UPDATE departamento SET nombreDepa = :nombreDepa, estadoDepa = :estadoDepa, fecha_alta = :fecha_alta
    WHERE nombreDepa = :nombreDepa");
    try {
      $query->execute([
        'nombreDepa'=> $item['nombreDepa'],
        'estadoDepa' => $item['estadoDepa'],
        'fecha_alta' => $item['fecha_alta']
      ]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
}
 ?>
