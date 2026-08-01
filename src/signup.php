<?php
session_start();
require 'function.php';
include 'dbconnection.php';

admin_check_remember_me($conn);


if (is_admin_logged_in()) {
    header("Location: secure.php");
    die;
   
}

else
{   check_remember_me($conn);
    if (is_logged_in()) {
    header("Location: index.php");
    die;
}}


?>
<?php
  $name = $email = $pwd = $conf_pwd = $remember_token= "";
  $name_err = $email_err = $pwd_err = $conf_pwd_err = "";
  $error = false; 
  $err_msg = "";
  
  if (isset($_POST['submit'])){
  
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $pwd = trim($_POST['pwd']);
      $conf_pwd = trim($_POST['conf_pwd']);
 
      if ($name == ""){
          $name_err = "Name is mandatory";
          $error = true;
      }
  
      if ($email == ""){
          $email_err = "Email is mandatory";
          $error = true;
      }
      elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
              $email_err = "Invalid Email format";
              $error = true;
          }
      else{   
          $sql = "select * from users where email = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s",$email);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows >0){
              $email_err = "Email already registered";
              $error = true;
          } 
      }
  
      if ($pwd == ""){
          $pwd_err = "Password is mandatory";
          $error = true;
      }
      elseif (strlen($pwd) < 6) {
          $pwd_err = "Password must be atleast 6 characters";
          $error = true;
          }
      
      if ($conf_pwd == ""){
          $conf_pwd_err = "Confirm Password is mandatory";
          $error = true;
      }
  
      if ($pwd !="" && $conf_pwd !=""){
          if ($pwd != $conf_pwd){
              $conf_pwd_err = "Passwords do not match";
              $error = true;
          }
      }
  

        if (!$error){
          $pwd = password_hash($pwd, PASSWORD_DEFAULT);
  
          $sql = "insert into users (name, email, password,remember_token) value(?, ?, ?,?)";
          try{
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ssss", $name, $email, $pwd,$remember_token);
              $stmt->execute();
              $succ_msg = "Registration successful. Please <a href='login.php'>login</a>";
              $name = $email ="";
          }
          catch(Exception $e){
              $error_msg = $e->getMessage();
          }
  
      }
  }

  include("components/header.php")

  ?>
  
   <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h1 class="text text-center">Sign up</h1>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Sign up</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

    <section class="sample-page">
      <div class="container" data-aos="fade-up">


  <div class="container ">
      <div class="err-msg">
          <?php if (!empty($succ_msg)){ ?>
              <div class="alert alert-success">
                  <?= $succ_msg?>
              </div>
          <?php } ?>
  
          <?php if (!empty($error_msg)){ ?>
              <div class="alert alert-danger">
                  <?= $error_msg?>
              </div>
          <?php } ?>
  
      </div>
      <form action="" method="post">
          <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                  type="text"
                  class="form-control"
                  name="name"
                  id="name"
                  placeholder="Enter Name"
                  value="<?=$name?>"
              />
              <div class="input-err text-danger"><?= $name_err?></div>
              
          </div>
  
          <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                  type="text"
                  class="form-control"
                  name="email"
                  id="email"
                  placeholder="Enter email"
                  value="<?=$email?>"
              />
              <div class="input-err text-danger"><?= $email_err?></div>
              
          </div>
  
          <div class="mb-3">
              <label for="pwd" class="form-label">Password</label>
              <input
                  type="password"
                  class="form-control"
                  name="pwd"
                  id="pwd"
                  placeholder="Enter password"
              />
              <div class="input-err text-danger"><?= $pwd_err?></div>
              
          </div>
  
          <div class="mb-3">
              <label for="conf_pwd" class="form-label">Confirm Password</label>
              <input
                  type="password"
                  class="form-control"
                  name="conf_pwd"
                  id="conf_pwd"
                  placeholder="Enter Confirm password"
              />
              <div class="input-err text-danger"><?= $conf_pwd_err?></div>
              
          </div>
  
          <div class="form-check">
          <input
              class="form-check-input"
              name=""
              id=""
              type="checkbox"
              value="checkedValue"
              aria-label="Show Password"
              onclick = "showPwd()"
          />Show Password
          </div>
          
          <div class="reg-button text-center mb-3">
              <button
                  type="submit"
                  name = "submit"
                  class="btn btn-primary">
                  Sign up
              </button>
          </div>
          <p class="text-center">Already Sign up? Login <a href="login.php">here</a></p>
      </form>
  </div>

     </div>
    </section>

  </main><!-- End #main -->
  <script>
      function showPwd(){
          var pwd = document.getElementById("pwd");
          var conf_pwd = document.getElementById("conf_pwd");
          if (pwd.type === "password")
              pwd.type = "text";
          else
          pwd.type = "password"
  
          if (conf_pwd.type === "password")
              conf_pwd.type = "text";
          else
              conf_pwd.type = "password"
      }
  </script>
 <?php 
  include("components/footer.php");
  ?>
