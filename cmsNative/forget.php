<?php include "includes/header.php"; ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;

require "./vendor/autoload.php";
?>
<?php require "./vendor/phpmailer/phpmailer/src/PHPMailer.php" ?>
<?php require "./vendor/phpmailer/phpmailer/src/SMTP.php" ?>


<!-- Page Content -->
<?php
if (!isset($_GET['forget'])) {
    redirect('index');
}
if (ifIsItMethod('post')) {
    if (isset($_POST['email'])) {
        $email = escape($_POST['email']);
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        if (emailExist($email)) {

            if ($statement = mysqli_prepare($connection, "UPDATE users SET token ='$token' where user_email =?")) {
                mysqli_stmt_bind_param($statement, "s", $email);
                mysqli_stmt_execute($statement);
                mysqli_stmt_close($statement);
                $mail = new PHPMailer();
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->Username   = '36dc1c1e872ba2';                     //SMTP username
                $mail->Password   = '6f05ba94e49ab5';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;
                $mail->SMTPAuth   = true;
                $mail->isHTML(true);
                $mail->CharSet='UTF-8';
                $mail->setFrom('mycms@yahoo.com', '3yad');
                $mail->addAddress($email);
                $mail->Subject = 'Reset your password';
                $mail->Body    = '<p>Click this link to reset password
                <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.'">Click Here<a/>
                </p>';

                if ($mail->send()) {

                    $emailSent=true;
                } else {
                    echo "not sent";
                }
            }
        }
    }
}
?>
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <?php if(!isset($emailSent)):  ?>


                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">




                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->
                            <?php else:  ?>
                                <h2>please check your mail </h2>

                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->