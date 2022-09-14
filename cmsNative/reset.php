<?php include "includes/header.php"; ?>

<?php
if(!isset($_GET['token']) && !isset($_GET['email'])){
   redirect("index");
}
// $email = "abdoayad0000@gmail.com";
// $token = '4f6b19aa6d257830c6a199a203e7f110563f30d70f7bf8119502a2467c72a91b4dcdc1a7bcba8f625a392fadc1f35d2f35b2';

if ($stmt = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE token=? ")) {
    mysqli_stmt_bind_param($stmt, "s", $_GET['tokens']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    if (isset($_POST['password']) && isset($_POST['confirmpassword'])) {
        if ($_POST['password'] === $_POST['confirmpassword']) {
            $password = $_POST["password"];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='',user_password='$hashedPassword' where user_email=?")) {
                mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) >= 1) {
                    redirect("login");
                }
                mysqli_stmt_close($stmt);

            } 
        }

        // if ($_GET["token"] !== $token || $_GET['email'] !== $email) {
        //     redirect('index');
        // }
    }
}

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">
                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                    <div class="form-group">
                                        <input id="password" name="password" placeholder="password" class="form-control" type="password">
                                    </div>
                                    <div class="form-group">
                                        <input id="confirmpassword" name="confirmpassword" placeholder="confirm password" class="form-control" type="password">
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>
                                    <input type="hidden" class="hide" name="tokenn" id="tokenn" value="">
                                </form>

                            </div><!-- Body-->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php"; ?>

</div> <!-- /.container -->