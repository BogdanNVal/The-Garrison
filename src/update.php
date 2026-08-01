<?php
session_start();
require 'function.php';
include 'dbconnection.php';


admin_check_remember_me($conn);



if (!is_admin_logged_in()) {
    header("Location: index.php");
    die;
}
?>
<?php

  $imagine="";
  $nume_err=$pret_err=$imagine_err=$descriere_err = "";
  $error = false; 
  $err_msg = "";




  if (isset($_GET['id'])){
    $id = $_GET['id'];
  }
  require 'assets/clase/Mancare.php';
  $mancare= new Mancare($id);
  $mancare->get();

  if (isset($_POST['submit'])){
      
      
    $nume = trim($_POST['nume']);
    $pret=$_POST['pret'];
    $descriere=trim($_POST['descriere']);
    $categorie = in_array($_POST['categorie'] ?? '', Mancare::CATEGORII_VALIDE, true) ? $_POST['categorie'] : $mancare->categorie;
    $targetDir = "assets/img/menu/";
    $imagine = $targetDir . basename($_FILES['file']['name']);
    $imageFileType = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
      
    if ($nume ==""){
      $nume_err = "Adauga nume";
      $error=true;

    }  
    
    if ($pret <= 0){ 
        $pret_err = "Adauga un pret corect";
        $error=true;

      }
      if ($descriere==""){
        $descriere_err = "Adauga descriere";
        $error=true;
  
      }  
      if (empty($_FILES['file']['name'])) {
        $imagine = $mancare->imagine;}

      elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
        $imagine_err = "Format incorect";
        $error = true;
    }


        if (!$error){
           if (empty($_FILES['file']['name']) || move_uploaded_file($_FILES['file']['tmp_name'], $imagine)) {
         $mancare->set($nume,$pret, $descriere, $imagine, $categorie);
            $mancare->update();
         if(empty($mancare->error))
         {
          header("Location: secure.php");
          exit();
         }
         else
         $err_msg=$mancare->error;
         

  
      }
    }

  }

include("components/header.php");

  ?>

   <main id="main">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Update page</h2>
     
    </div>

  </div>
</div><!-- End Breadcrumbs -->

<section class="sample-page">
  <div class="container" data-aos="fade-up">

  <div class="position-absolute top-20 start-50" >
    <div><h1>Update</h1></div>
      <div class="err-msg">
          
  
          <?php if (!empty($error_msg)){ ?>
              <div class="alert alert-danger">
                  <?= $error_msg?>
              </div>
          <?php } ?>
  
      </div>  
 
      <form action="update.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
              <label for="nume" class="form-label">Nume</label>
              <input
                  type="text"
                  class="form-control"
                  name="nume"
                  id="nume"
                  placeholder="Adauga Nume"
                  value="<?=$mancare->nume?>"
              />
              <div class="input-err text-danger"><?= $nume_err?></div>
              
          </div>

          <div class="mb-3">
              <label for="pret" class="form-label">Pret</label>
              <input
                  type="number"
                  step="0.01"
                  class="form-control"
                  name="pret"
                  id="pret"
                  placeholder="Adauga Pret"
                  value="<?=$mancare->pret?>"
              />
              <div class="input-err text-danger"><?= $pret_err?></div>
              
          </div>

          <div class="mb-3">
              <label for="descriere" class="form-label">Descriere</label>
              <input
                  type="text"
                  class="form-control"
                  name="descriere"
                  id="descriere"
                  placeholder="Adauga Descriere"
                  value="<?=$mancare->descriere?>"
              />
              <div class="input-err text-danger"><?= $descriere_err?></div>
              
          </div>

          <div class="mb-3">
              <label for="categorie" class="form-label">Categorie</label>
              <select class="form-control" name="categorie" id="categorie">
                  <?php foreach (Mancare::CATEGORII_VALIDE as $cat): ?>
                      <option value="<?= $cat ?>" <?= $cat === $mancare->categorie ? 'selected' : '' ?>>
                          <?= ucfirst($cat) ?>
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>

  
          

          <div class="mb-3">
              <label for="file" class="form-label">Imagine</label>
              <div>
              <img src="<?=$mancare->imagine?>" alt="Current Image" width="100">
              </div>   
              <input
                  type="file"
                  class="form-control"
                  name="file"
                  id="file"
                  value="<?=$imagine?>"
                  
                  
              />
              <div class="input-err text-danger"><?= $imagine_err?></div>
              
              
          </div>
  
          
          <div class="reg-button text-center mb-3">
              <button
                  type="submit"
                  name = "submit"
                  class="btn btn-primary">
                  Submit
              </button>
          </div>
          
      </form>
  </div>



  </div>
</section>

</main><!-- End #main -->

      <?php 
include("components/footer.php");
  ?>
