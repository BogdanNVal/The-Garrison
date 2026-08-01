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


  require 'assets/clase/Mancare.php';

  $categorii_disponibile = Mancare::CATEGORII_VALIDE;

  $nume = $descriere = $imagine = "";
  // Categoria vine preselectata daca vii de pe secure.php cu ?categorie=..., altfel implicit "starters"
  $categorie = (isset($_GET['categorie']) && in_array($_GET['categorie'], $categorii_disponibile, true))
      ? $_GET['categorie']
      : "starters";
  $nume_err =$pret_err= $descriere_err = $imagine_err = "";
  $error = false; 
  $err_msg = "";
  
  if (isset($_POST['submit'])){
      
      $nume = trim($_POST['nume']);
      $pret=$_POST['pret'];
      $descriere=trim($_POST['descriere']);
      $categorie = in_array($_POST['categorie'] ?? '', $categorii_disponibile, true) ? $_POST['categorie'] : "starters";
      $targetDir="assets/img/menu/";
      $imagine=$targetDir.basename($_FILES['file']['name']);
      $imageFileType = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
       
    
 
      if ($nume == ""){
          $nume_err = "Adauga nume";
          $error = true;
      }
      if ($pret <= 0){
        $pret_err = "Adauga un pret corect";

      }

      if ($descriere == ""){
        $descriere_err = "Adauga Descriere";
        $error = true;
    }

    if ($imagine== $targetDir){
        $imagine_err = "Adauga Imagine";
        $error = true;
    }
    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
        $imagine_err = "Format incorect";
        $error = true;
    }



  

        if (!$error){
          
            if(move_uploaded_file($_FILES['file']['tmp_name'],$imagine)){
                $mancare= new Mancare(0);
                $mancare->set($nume,$pret, $descriere, $imagine, $categorie);
                $mancare->add();
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
      <h2>Admin page</h2>
     
    </div>

  </div>
</div><!-- End Breadcrumbs -->

<section class="sample-page">
  <div class="container" data-aos="fade-up">


 
  <div class="position-absolute top-20 start-50" >
    <div><h1>Adaugare</h1></div>
      <div class="err-msg">
          
  
          <?php if (!empty($error_msg)){ ?>
              <div class="alert alert-danger">
                  <?= $error_msg?>
              </div>
          <?php } ?>
  
      </div>  
      <form action="add.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
              <label for="nume" class="form-label">Nume</label>
              <input
                  type="text"
                  class="form-control"
                  name="nume"
                  id="nume"
                  placeholder="Adauga Nume"
                  value="<?=$nume?>"
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
                  value="<?=$pret?>"
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
                  value="<?=$descriere?>"
              />
              <div class="input-err text-danger"><?= $descriere_err?></div>
              
          </div>

          <div class="mb-3">
              <label for="categorie" class="form-label">Categorie</label>
              <select class="form-control" name="categorie" id="categorie">
                  <?php foreach ($categorii_disponibile as $cat): ?>
                      <option value="<?= $cat ?>" <?= $cat === $categorie ? 'selected' : '' ?>>
                          <?= ucfirst($cat) ?>
                      </option>
                  <?php endforeach; ?>
              </select>
          </div>

  
          

          <div class="mb-3">
              <label for="file" class="form-label">Imagine</label>
               
              <input
                
                  type="file"
                  class="form-control"
                  name="file"
                  id="file"
                  
                  
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
