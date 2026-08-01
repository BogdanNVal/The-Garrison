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
include("components/header.php");
?>

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h1 class="text text-center">ADMIN</h1>
     
          <a href="search.php" class="btn-book-a-table">Verifica rezevari</a>
        
        </div>

      </div>
    </div><!-- End Breadcrumbs -->


<div class="container" style="max-width: 50%;">
<div class="text-center mt-5 mb-4"><h1>Cauta rezervare</h1></div>

<input type="text" class="form-control" id="live_search" autocomplete="off"
placeholder="Search ...">

    </div>
    <div id="searchresult"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#live_search").keyup(function(){
    var input = $(this).val();

    if (input != "") {
      $.ajax({
        url: "livesearch.php",
        method: "POST",
        data: { input: input },
        success: function(data){
          $("#searchresult").html(data);
        }
      });
    } else {
      $("#searchresult").html(""); 
    }
  });
});
</script>


<?php 



include("components/footer.php");
?>