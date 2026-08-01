<?php
session_start();
require 'function.php';
include 'dbconnection.php';


check_remember_me($conn);


if (!is_logged_in()) {
    header("Location: login.php");
    die;
   
}
?>
<?php
  $nr_persoane = 0;
  $data_rezervare= "";
  $nr_persoane_err =$data_rezervare_err= "";
  $error = false; 
  $error_msg = "";
  
  if (isset($_POST['submit'])){



   $nr_persoane = trim($_POST['nr_persoane']);
   $data_rezervare=$_POST['data_rezervare'];

  if ($nr_persoane <= 0){
    $nr_persoane_err = "Alegeti un numar de persoane";
    $error = true;}
    elseif($nr_persoane > 6){
      $nr_persoane_err = "Numarul maxim de persoane este 6";
      $error = true;

    }
   

  
 

    if ($data_rezervare == ""){
      $data_rezervare_err = "Alegeti o data";
      $error = true;
  }
  if (!$error){
    require 'assets/clase/rezervare_masa.php';
      $rezervare= new Rezervare($_POST['nr_persoane'],$_SESSION['name'],$data_rezervare);
      $rezervare->verifica_rezervare();
      if(empty($rezervare->error)){
       
      header("Location: index.php");
      exit();
    }
      else{
        $error_msg=$rezervare->error;
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
      <h2>Rezervare</h2>
     
    </div>

  </div>
</div><!-- End Breadcrumbs -->

<section class="sample-page">
  <div class="container" data-aos="fade-up">

  
  
  <div class="position-absolute top-20 start-50" >
    <div class=" mb-3"><h1>Rezervare</h1></div>
    <div class="col-lg-4">
            <svg width="200" height="200" viewBox="-100 -100 200 200">
                <g stroke="black" stroke-width="2">
                  <circle cx="0" cy="-45" r="7" fill="#4F6D7A" />
                  <circle cx="0" cy="50" r="10" fill="#F79257" />
                    <path
                    d="
                    M -50 40
                    L -50 50
                    L 50 50
                    L 50 40
                    Q 40 40 40 10
                    C 40 -60 -40 -60 -40 10   
                    Q -40 40 -50 40"
                    fill="#FDEA96"
                    />
                </g>
              </svg>
            </div>
      <div class="err-msg">
              
      
              <?php if (!empty($error_msg)){ ?>
                  <div class="alert alert-danger">
                      <?= $error_msg?>
                  </div>
              <?php } ?>
      


      </div>
     
      <form action="rezervare.php" method="post">

      <div class="mb-3">
              <label for="nr_persoane" class="form-label">Numar persoane</label>
              <input
                  type="number"
                 class="form-control"
                  name="nr_persoane"
                  id="nr_persoane"
                  placeholder="Numar persoane"
                  value="<?=$nr_persoane?>"

                 
              />
              <div class="input-err text-danger"><?= $nr_persoane_err?></div>
             
              
          </div>
          <div class="mb-3">
              <label for="data_rezervare" class="form-label">Data rezervare</label>
              <input
                  type="date"
                 class="form-control"
                  name="data_rezervare"
                  id="data_rezervare"
                  value="<?=$data_rezervare?>"
          
                 
              />
              <div class="input-err text-danger"><?= $data_rezervare_err?></div>
             
              
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
