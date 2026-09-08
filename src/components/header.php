<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>The Garrison</title>
  <meta content="The Garrison restaurant — menu, reservations, and more" name="description">
  <meta content="restaurant, garrison, menu, rezervare" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <?php if (getenv('RECAPTCHA_SITE_KEY')) { ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <?php } ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1>The Garrison<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php#hero">Home</a></li>
          <li><a href="index.php#about">About</a></li>
          <li><a href="index.php#menu">Meniu</a></li>
          <li><a href="index.php#events">Evenimente</a></li>
          <li><a href="index.php#chefs">Chefs</a></li>
          <li><a href="index.php#gallery">Gallery</a></li>
          <li><a href="index.php#contact">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="d-flex flex-row justify-content-center align-items-center gap-3">
        <?php if (function_exists('is_admin_logged_in') && is_admin_logged_in()) { ?>
          <a href="secure.php" class="text-decoration-none">Admin</a>
          <a href="logout.php" class="text-decoration-none">Logout</a>
        <?php } elseif (isset($_SESSION['name'])) { ?>
          <a href="logout.php" class="text-decoration-none">Logout</a>
          <a class="btn-book-a-table" href="rezervare.php">Rezerva o masa</a>
        <?php } else { ?>
          <a href="login.php" class="text-decoration-none">Login</a>
          <a href="signup.php" class="text-decoration-none">Sign up</a>
          <a class="btn-book-a-table" href="rezervare.php">Rezerva o masa</a>
        <?php } ?>
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
