<?php
session_start();
require 'function.php';
include 'dbconnection.php';
require 'assets/clase/Mancare.php';

admin_check_remember_me($conn);



if (!is_admin_logged_in()) {
    header("Location: index.php");
    die;
}

// Etichete de afisat pentru fiecare categorie
$categorii = [
    'starters'  => 'Starters',
    'breakfast' => 'Breakfast',
    'lunch'     => 'Lunch',
    'dinner'    => 'Dinner',
];
?>
<?php
include("components/header.php");
?>
  <main id="main">

  
  

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h1 class="text text-center">ADMIN</h1>
     
          <a href="search.php" class="btn-book-a-table">Verifica rezevari</a>
        
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

 

    <section class="sample-page">
      <div class="container" data-aos="fade-up">

      <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Menu</h2>
          <p>Check Our <span>The Garrison Menu</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <?php $first = true; ?>
          <?php foreach ($categorii as $slug => $label): ?>
          <li class="nav-item">
            <a class="nav-link<?= $first ? ' active show' : '' ?>" data-bs-toggle="tab" data-bs-target="#menu-<?= $slug ?>">
              <h4><?= $label ?></h4>
            </a>
          </li><!-- End tab nav item -->
          <?php $first = false; ?>
          <?php endforeach; ?>

        </ul>
        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

        <?php $first = true; ?>
        <?php foreach ($categorii as $slug => $label): ?>

        <div class="tab-pane fade<?= $first ? ' active show' : '' ?>" id="menu-<?= $slug ?>">

          <div class="tab-header text-center">
            <p>Menu</p>
            <h3><?= $label ?></h3>
          </div>

          <div class="row gy-5">

          <?php
            $produse = Mancare::get_by_categorie($conn, $slug);
            if (empty($produse)) {
              echo '<p class="text-center">Niciun produs adaugat inca la aceasta categorie.</p>';
            }
            foreach ($produse as $row) {
          ?>

          <div class="col-lg-4 menu-item">
            <a href="<?php echo $row['imagine']?>" class="glightbox"><img src="<?php echo $row['imagine']?>" class="menu-img img-fluid" alt=""></a>
            <h4><?php echo $row['nume'];?></h4>
            <p class="ingredients">
            <?php echo $row['descriere'];?>
            </p>
            <p class="price">
              $<?php echo $row['pret'];?>
            </p>

            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Update</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
          </div><!-- Menu Item -->

          <?php } ?>

          </div>

          <div class="d-flex justify-content-center mt-4">
          <a href="add.php?categorie=<?= $slug ?>" class="btn btn-primary">Add la <?= $label ?></a>
          </div>

        </div><!-- End <?= $label ?> Menu Content -->

        <?php $first = false; ?>
        <?php endforeach; ?>

        </div>

      </div>

    </section>

</section><!-- End Menu Section -->


    


  </main><!-- End #main -->

  <?php 



  include("components/footer.php");
  ?>


