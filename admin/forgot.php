<?php
include('connection.php');
include('main.php');

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$otp = rand(100000, 999999);

if (isset($_POST['submit'])) {

    $email = $_POST['email'];

    $data = "SELECT * FROM user WHERE email = '$email'";
    $data1 = mysqli_query($conn, $data);
    $data2 = mysqli_fetch_assoc($data1);

    if (@$data2['email'] == $email) {

        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

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
            $mail->addAddress($email, $otp);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Forgot password';
            $mail->Body    =  $otp;

            $mail->send();
            echo '';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        header('location:passotp.php');
    } else {
        echo "Your email is not match to our data.... please try again";    
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
                        <h4>Enter Your Email</h4>
                        <form class="pt-3" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Enter your email">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="submit" value="OTP">
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