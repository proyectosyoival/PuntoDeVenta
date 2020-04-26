<?php

include_once 'models/departamento.php';

class departamentoModel extends Model{

  public function _construct(){
    parent::__construct();
  }

  public function insert($datos){

    try{
      $query = $this->db->connect()->prepare('INSERT INTO departamento (nombreDepa, estadoDepa) VALUES( :nombreDepa, :estadoDepa)');
      $query->execute(['nombreDepa' => $datos['nombreDepa'], 'estadoDepa' => $datos['estadoDepa']]);
      return true;

    }catch (PDOException $e){
      return false;
    }
  }
  public function getDepto(){
    $items =[];

    try {
      $query =$this->db->connect()->query("SELECT*FROM departamento");
      while($row = $query->fetch()){
        $item = new Depto();
        $item->id_departamento = $row['id_departamento'];
        $item->nombreDepa = $row['nombreDepa'];
        $item->estadoDepa = $row['estadoDepa'];
        $item->nomenclaturaDep = $row['nomenclaturaDep'];
        $item->fecha_alta = $row ['fecha_alta'];
        array_push($items, $item);
      }
      return $items;

    } catch (PDOException $e) {
      return [];
    }

  }

  public function getById($id_departamento){
      $item = new Depto();

      $query = $this->db->connect()->prepare("SELECT * FROM departamento WHERE id_departamento = :id_departamento");
      try{
          $query->execute(['id_departamento' => $id_departamento]);

          while($row = $query->fetch()){
              $item->id_departamento = $row['id_departamento'];
              $item->nombreDepa = $row['nombreDepa'];
              $item->estadoDepa = $row['estadoDepa'];
              $item->nomenclaturaDep =$row['nomenclaturaDep'];
              $item->fecha_alta = $row['fecha_alta'];
          }

          return $item;
      }catch(PDOException $e){
          return null;
      }
  }

  public function update($item){
    $query = $this->db->connect()->prepare("UPDATE departamento SET nombreDepa = :nombreDepa, estadoDepa = :estadoDepa WHERE id_departamento = :id_departamento");
    try {
      $query->execute([
        'id_departamento'=> $item['id_departamento'],
        'nombreDepa'=> $item['nombreDepa'],
        'estadoDepa' => $item['estadoDepa']
      ]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }
  public function delete($id){
      $query = $this->db->connect()->prepare("DELETE FROM departamento WHERE id_departamento = :id_departamento");
      try{
          $query->execute([
              'id_departamento'=> $id,
          ]);
          return true;
      }catch(PDOException $e){
          return false;
      }
  }
}
 ?>
