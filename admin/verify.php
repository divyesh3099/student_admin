<?php
include('connection.php');
include('main.php');

session_start();
$otp = $_SESSION['otp'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if (isset($_POST['submit'])) {

    $emailotp = $_POST['otp'];
    if ($emailotp == $otp) {
        $q = "INSERT INTO `user` (`username`,`email`,`password`) VALUES ('$username','$email','$password')";
        $q2 = mysqli_query($conn, $q);
        header('location:login.php');

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
            $mail->addAddress($email, $username);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Register Form';
            $mail->Body    =  $username . 'Welcome To admin dashboard';

            $mail->send();
            echo '';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Your otp is wrong.... please try again";
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
                        <h4>Welcome</h4>
                        <p class="text-muted">please check your email and enter otp</p>
                        <form class="pt-3" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="otp" id="exampleInputEmail1" placeholder="Enter OTP">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" value="SIGN UP">
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