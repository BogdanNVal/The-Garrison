<?php


class Rezervare {


  

  public $nume_rezervare;
  
  public $data_rezervare;
  public $nr_persoane;

  public $id_masa;

  public $error;
 

  public function __construct( $nr_persoane,$nume_rezervare,$data_rezervare) {
    $this->nume_rezervare = $nume_rezervare;
    $this->data_rezervare = $data_rezervare;
    $this->nr_persoane = $nr_persoane;
    $this->id_masa = -1;
    $this->error = "";

  }


  public function masa_libera()
  { 
   
    require 'dbconnection.php';
    $sql = "SELECT * FROM mese WHERE nr_persoane >= ?";
    try {
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $this->nr_persoane);
      $stmt->execute();
  $result = $stmt->get_result();
    
      
    if($result->num_rows>0){
     
      while($row=mysqli_fetch_array($result)){
       
        $this->verifica_data($row["id"]);
        if(empty($this->error)){
         
          $this->id_masa=$row["id"];
          break;
      
  }}}
    
}catch (Exception $e) {
  $this->error= $e->getMessage();}
 
  
}
  


  function verifica_data($id_masa) {
   
    $this->error="";
     require 'dbconnection.php';
    $sql = "SELECT * FROM rezervari WHERE id_masa = ?";
    try {
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id_masa);
      $stmt->execute();
  $result = $stmt->get_result();
  
  while( $row=mysqli_fetch_array($result)){
    
  if ($this->data_rezervare==$row["data_rezervare"]){
    $this->error= "Masa ocupata";
    break;
  }}
    
   
  }catch (Exception $e) {
    $this->error= $e->getMessage();}
   
    
  }


  function adauga_rezervare() {
    $id=-1;
    require 'dbconnection.php';

    $sql = "INSERT INTO rezervari (nume, data_rezervare,nr_persoane	, id_masa) VALUE (?, ?, ?, ?)";
    try{
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdd", $this->nume_rezervare ,$this->data_rezervare, $this->nr_persoane,  $this->id_masa);
        $stmt->execute();
       
      
    }
    catch(Exception $e){
        $this->error = $e->getMessage();
    }
   
  }

 

  
  
 

function verifica_rezervare() {
  $this->masa_libera();
  
  if($this->id_masa==-1){
    $this->error= "NU EXISTA MESE LIBERE DE " .$this->nr_persoane. " PERSOANE PE DATA " .$this->data_rezervare;
  
    }else{
      $this->adauga_rezervare();
    }
   
  


}


}