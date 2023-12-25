<?php
include('connection.php');
session_start();
if (@$_SESSION['id'] != null) {
  header('location:index.php');
}
include('main.php');

if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $data = "SELECT * FROM user WHERE email = '$email'";
  $data1 = mysqli_query($conn, $data);
  $data2 = mysqli_fetch_assoc($data1);

  if($data2['email'] == $email){
    if ($data2['password'] == $password) {
      session_start();
      $_SESSION['id'] = $data2['id'];
      header('location:index.php');
    } else {
      echo "Your password is not match.... Please try again";
    }
  }else {
    echo "Your email is not match.... Please try again";
  }
}


?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <div class="brand-logo">
              <img src="assets/images/logo.svg">
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>
            <form class="pt-3" method="post">
              <div class="form-group">
                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
              </div>
              <div class="mt-3">
                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" value="SIGN IN">
              </div>
              <div class="my-2 d-flex justify-content-between align-items-center">
                <a href="forgot.php" class="auth-link text-black">Forgot password?</a>
              </div>
              <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.php" class="text-primary">Create</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>

<?php

include('script.php');

?>