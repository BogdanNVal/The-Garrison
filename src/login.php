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
$email = $pwd = "";
$email_err = $pwd_err = "";
$error = false;
$error_msg = "";
$remember = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $pwd = trim($_POST['pwd']);

    if (isset($_POST['remember'])) {
        $remember = $_POST['remember'];
    }

    if ($email == "") {
        $email_err = "Email is mandatory";
        $error = true;
    }

    if ($pwd == "") {
        $pwd_err = "Password is mandatory";
        $error = true;
    }


    $recaptcha_secret = getenv('RECAPTCHA_SECRET_KEY');
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    if ($recaptcha_secret) {
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
        $responseKeys = json_decode($response, true);

        if (!$responseKeys["success"]) {
            $error = true;
            $error_msg = "Please complete the reCAPTCHA";
        }
    }

   


   
    if (!$error){
        $sql = "SELECT * FROM admins WHERE email = ?";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $stored_pwd = $row['password'];
                if (password_verify($pwd, $stored_pwd)){
                 
                   
                        if ($remember) {
                            $remember_token = bin2hex(random_bytes(32));
                            $hashed_remember_token = hash('sha256', $remember_token);
    
                            setcookie("remember_token", $remember_token, time() + 365 * 24 * 3600, "/");
    
                            $sql = "UPDATE admins SET remember_token = ? WHERE email = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $hashed_remember_token, $email);
                            $stmt->execute();
                        } else {
                            setcookie("remember_token", "", time() - 3600, "/");
                        }
                        $_SESSION['admin_id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                       
                        header("Location: secure.php");
    
                        exit();
                } else {
                    $error_msg = "Incorrect Password";
                }
            } else {
                $sql = "SELECT * FROM users WHERE email = ?";
               
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $stored_pwd = $row['password'];
                        if (password_verify($pwd, $stored_pwd)){
              
                            if ($remember) {
                                $remember_token = bin2hex(random_bytes(32));
                                $hashed_remember_token = hash('sha256', $remember_token);
        
                                setcookie("remember_token", $remember_token, time() + 365 * 24 * 3600, "/");
        
                                $sql = "UPDATE users SET remember_token = ? WHERE email = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ss", $hashed_remember_token, $email);
                                $stmt->execute();
                            } else {
                                setcookie("remember_token", "", time() - 3600, "/");
                            }
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['name'] = $row['name'];
                           
                            header("Location: index.php");
                            exit();
        
                        } else {
                            $error_msg = "Incorrect Password";
                        }
                    } else {
                        $error_msg = "Email id not registered";
                    }
               
            }
        
            
        } catch (Exception $e) {
            $error_msg = $e->getMessage();
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
          <h1 class="text text-center">Login</h1>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Login</li>
          </ol>
        </div>

      </div>
    </div><!-- End Breadcrumbs -->

 

    <section class="sample-page">
      <div class="container" data-aos="fade-up">

      

        <div class="container">

        <div class="err-msg">
            <?php if (!empty($error_msg)){ ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error_msg) ?>
                </div>
            <?php } ?>
        </div>
        
        <form id="form1" action="" method="post">
               
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="text"
                        class="form-control"
                        name="email"
                        id="email"
                        placeholder="Enter email"
                        value=""
                    />
                    <div class="input-err text-danger"><?= htmlspecialchars($email_err) ?></div>
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
                    <div class="input-err text-danger"><?= htmlspecialchars($pwd_err) ?></div>
                </div>

                <div class="form-check">
                    <input
                        class="form-check-input"
                        name="remember"
                        type="checkbox"
                        value="1"
                        aria-label="Remember Me"
                        
                    />Remember Me
                </div>
                <div class="form-group">
                <div class="g-recaptcha" data-sitekey="<?= htmlspecialchars(getenv('RECAPTCHA_SITE_KEY')) ?>"></div>
                </div>
                
                <div class="reg-button text-center mt-3">
                    <button
                        type="submit"
                        id="login"
                        name="submit"
                        class="btn btn-primary"
                        >
                        
                        Login
                    </button>
                </div>
                <p class="text-center">Not Registered? Click <a href="signup.php">here</a> to sign up</p>
            </form>
        </div>
      </div>

    </section>


    


  </main><!-- End #main -->

  <?php 



  include("components/footer.php");
  ?>


