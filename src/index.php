<?php
session_start();
require 'function.php';
include 'dbconnection.php';

admin_check_remember_me($conn);

if (is_admin_logged_in()) {
    header("Location: secure.php");
    die;
} else {
    check_remember_me($conn);
}

require("components/header.php");
?>

<?php include("components/home.php"); ?>

<main id="main">

<?php include("components/about.php"); ?>
<?php include("components/why-us.php"); ?>
<?php include("components/menu.php"); ?>
<?php include("components/stats.php"); ?>
<?php include("components/testimonials.php"); ?>
<?php include("components/chefs.php"); ?>
<?php include("components/gallery.php"); ?>
<?php include("components/contact.php"); ?>

</main><!-- End #main -->

<?php include("components/footer.php"); ?>
