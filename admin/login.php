<?php ob_start(); ?>
<?php require_once("includes/header.php"); ?>

<?php
if ($session->is_signed_in()) {

    redirect("index.php");
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    //method to check the database 
    $user_found = User::verify_user($username, $password);
    if ($user_found) {
        $session->login($user_found);
        redirect('index.php');
    } else {
?>
<div class="col-md-4 col-md-offset-3">
        <h4 class="bg-danger text-center "><?php echo "username or password is incorrect"; ?></h4>
</div>
<?php
    }
} else {
    $username = "";
    $password = "";
}

?>


<div class="col-md-4 col-md-offset-3">

    <form id="login-id" action="" method="post">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>">

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">

        </div>


        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">

        </div>


    </form>


</div>