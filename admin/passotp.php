<?php
include('connection.php');
include('main.php');

session_start();
@$oldotp = $_SESSION['otp'];

if (isset($_POST['submit'])) {

    $otp = $_POST['otp'];

    if ($oldotp == $otp) {
        header('location:changepass.php');
    }else{
        echo 'Your OTP is wrong';
    }
}
?>



<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-center p-5">
                        <div class="brand-logo">
                            <img src="assets/images/logo.svg">
                        </div>
                        <h4>change password</h4>
                        <p class="text-muted">please check your email and enter otp</p>
                        <form class="pt-3" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="otp" id="exampleInputEmail1" placeholder="Enter OTP">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" value="SUBMIT">
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