<?php
include('connection.php');
session_start();
if (@$_SESSION['id'] != null) {
    header('location:index.php');
}
include('main.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$otp = rand(100000, 999999);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = "SELECT * FROM user WHERE email='$email'";
    $data1 = mysqli_query($conn, $data);
    $data2 = mysqli_fetch_assoc($data1);

    if (@$data2['email'] != $email) {

        $_SESSION['otp'] = $otp;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        
        header('location:verify.php');

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = false;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'divyeshmarakana4@gmail.com';
            $mail->Password   = 'tfby bflu iwum tlas';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('divyeshmarakana4@gmail.com', 'register form');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Email verification from IT institute';
            $mail->Body    = $otp;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    } else {
        echo "Your email is match in our data.... Please use diffrent email";
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
                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                        <form class="pt-3" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="username" id="exampleInputUsername1" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" value="SIGN UP">
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="login.php" class="text-primary">Login</a>
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