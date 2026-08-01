<?php

class Mancare  {
    private $id;
   public $nume;
   public $pret;
    public $descriere;
    public $imagine;
    public $categorie;

    public $error;

    // Categoriile permise pentru un produs din meniu.
    const CATEGORII_VALIDE = ['starters', 'breakfast', 'lunch', 'dinner'];

    public function __construct($id) {

      $this->id = $id;
      $this->nume = "";
      $this->pret = 0;
      $this->descriere = "";
      $this->categorie = "starters";
      $this->error ="";
      }
   

    public function set($nume, $pret, $descriere, $imagine, $categorie) {
      $this->nume= $nume;
      $this->pret = $pret;
      $this->descriere = $descriere;
      $this->imagine = $imagine;
      $this->categorie = in_array($categorie, self::CATEGORII_VALIDE, true) ? $categorie : "starters";
    }

      public function get() {
        require 'dbconnection.php';
        $sql = "SELECT * FROM meniu WHERE id = ?";
        try {
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $this->id);
          $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows < 1){
        $this->error="Id incorect";
      }
      else{
        $row = $result->fetch_assoc();
        $this->nume = $row["nume"];
        $this->pret = $row["pret"];
        $this->descriere = $row["descriere"];
        $this->imagine = $row["imagine"];
        $this->categorie = $row["categorie"];
      }
      } catch (Exception $e) {
        $this->error= $e->getMessage();
    }
    
  
    
    }

    // Returneaza toate produsele dintr-o categorie (folosit pe pagina publica si in panoul de admin).
    public static function get_by_categorie($conn, $categorie) {
      if (!in_array($categorie, self::CATEGORII_VALIDE, true)) {
        return [];
      }
      $sql = "SELECT * FROM meniu WHERE categorie = ? ORDER BY id DESC";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $categorie);
      $stmt->execute();
      $result = $stmt->get_result();
      $rows = [];
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
      return $rows;
    }

    public function update() {
      require 'dbconnection.php';
      $sql = "UPDATE meniu SET nume=?, pret=?, descriere=?, imagine=?, categorie=? WHERE id=?";
      try{
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("sdsssi", $this->nume, $this->pret, $this->descriere, $this->imagine, $this->categorie, $this->id);
          $stmt->execute();
         
          
      }
     catch (Exception $e) {
      $this->error= $e->getMessage();
  }

  }

  public function delete() {
    require 'dbconnection.php';
    $sql = "DELETE FROM meniu WHERE id = ?";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
       
        
       
    } catch (Exception $e) {
      $this->error= $e->getMessage();
    }

}

public function add() {
  require 'dbconnection.php';
  $sql = "INSERT INTO meniu (nume, pret, descriere, imagine, categorie) VALUES (?, ?, ?, ?, ?)";
          try{
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("sdsss", $this->nume ,$this->pret, $this->descriere, $this->imagine, $this->categorie);
              $stmt->execute();
          }
          catch(Exception $e){
            $this->error = $e->getMessage();
          }

}
}
