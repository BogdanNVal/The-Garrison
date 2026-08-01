<?php
session_start();
require 'function.php';
include 'dbconnection.php';


admin_check_remember_me($conn);


if (is_admin_logged_in()) {
    header("Location: secure.php");
    die;
   
}
else{check_remember_me($conn);
}



?>



<?php




require("components/header.php");


include("components/home.php");


include("components/about.php");


    
include("components/menu.php");

include("components/stats.php");

include("components/testimonials.php");

include("components/chefs.php");






    


   
include("components/gallery.php");

include("components/contact.php");


?>



<?php
include("components/footer.php");

?>
