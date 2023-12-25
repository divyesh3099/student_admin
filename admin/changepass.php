<?php
include('connection.php');
include('main.php');

session_start();
$email = $_SESSION['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if (isset($_POST['submit'])) {

    $pass = $_POST['pass'];

    $q = "UPDATE user SET password = '$pass' WHERE email = '$email';";
    $q1 = mysqli_query($conn, $q);

    if ($q1) {
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
            $mail->Subject = 'change password successfull';
            $mail->Body    =  'your password is successfully change';

            $mail->send();
            echo '';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        header('location:login.php');
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
                        <p class="text-muted">please enter new password</p>
                        <form class="pt-3" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="pass" id="exampleInputEmail1" placeholder="Enter New Password">
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