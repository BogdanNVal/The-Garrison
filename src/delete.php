<?php

require 'function.php';
include 'dbconnection.php';

admin_check_remember_me($conn);

if (!is_admin_logged_in()) {
    header("Location: index.php");
    die;
}

?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


if (isset($_POST['submit'])) {
    require 'assets/clase/Mancare.php';
    $mancare= new Mancare($id);
    $mancare->delete();
    if(empty($mancare->error)){
        header("Location: secure.php");
        exit();
       }
       else{
        
       $err_msg=$mancare->error;
    echo $err_msg;}
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
  <h1 class="text-center">Esti sigur ca vrei sa stergi acest element?</h1>
  
  <div class="container ">
      <div class="err-msg">
          
  
          <?php if (!empty($err_msg)){ ?>
              <div class="alert alert-danger">
                
                  <?= $err_msg?>
              </div>
          <?php } ?>
  
      </div>  
  </div>

      <form action="delete.php?id=<?=$id?>" method="post">
                    
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

    

 
</section>

</main><!-- End #main -->

      <?php 
include("components/footer.php");
  ?>
