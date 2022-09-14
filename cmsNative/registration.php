<?php include "includes/header.php"; ?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>

<?php
if(isset($_GET['lang'])&& !empty($_GET['lang'])){

    $_SESSION['lang']= $_GET ["lang"];
    if(isset ($_SESSION["lang"]) && $_SESSION["lang"] != $_GET["lang"])
    {
        echo "<script> type='text/javascript'> location.reload(); </script>";
    }}


    if($_SESSION['lang'])
    {
        include "includes/languages/".$_SESSION['lang'].".php";
    }
    else
    {
        include "includes/languages/en.php";
    }




?>



<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $error = ['username' => '', 'email' => '', 'password' => ''];
    if (strlen($username) < 4) {
        if (empty($username)) {
            $error['username'] = 'username can not be empty';
        } else {
            $error['username'] = 'username need to be longer';
        }
    }
    if (userExist($username)) {
        $error['username'] = 'Username Already Exists, pick another one';
    }
    if (empty($email)) {
        $error['email'] = 'Email can not be empty';
    }
    if (emailExist($email)) {
        $error['email'] = "Email Already Exists, <a href='index.php'> Log in </a>";
    }
    if (empty($password)) {
        $error['password'] = 'password can not be empty';
    }
    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    }
    if (empty($error)) {
        Registration($username, $email, $password);
        login($username, $password);
    }
}
?>


<!-- Page Content -->
<div class="container">

    <form method="get" id="language_form" class="navbar-form navbar-right">
        <div class="form-group">
            <select class="form-control" name="lang" onchange="changelang()">
                <option value="en"  <?php if(isset($_SESSION["lang"])&& $_SESSION["lang"]=='en'){ echo "selected" ;}  ?> >English</option>
                <option value="ar" <?php if(isset($_SESSION["lang"])&& $_SESSION["lang"]=='ar'){ echo "selected" ;}  ?> >العربية</option>
            </select>
        </div>
    </form>

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1 class="text-center" ><?php echo _REGISTER ; ?></h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control text-center" placeholder="<?php echo _USERNAME ; ?>" autocomplete="on" value="<?php echo isset($username) ? $username : ''; ?>">
                                <p><?php echo isset($error['username']) ? $error['username'] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control text-center" placeholder="<?php echo _EMAIL ; ?>" autocomplete="on" value="<?php echo isset($email) ? $email : ''; ?>">
                                <p><?php echo isset($error['email']) ? $error['email'] : "" ?></p>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control text-center" placeholder="<?php echo _PASSWORD ; ?>">
                                <p><?php echo isset($error['password']) ? $error['password'] : "" ?></p>
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>

    <script>
        function changelang() {
            document.getElementById("language_form").submit();
        }
    </script>



    <?php include "includes/footer.php"; ?>