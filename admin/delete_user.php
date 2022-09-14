<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php

if (empty($_GET['id'])) {
    redirect("users.php");
}

$user = User::findById($_GET['id']);
if ($user) {
    $session->message("the user $user->username has been Deleted");
    $user->delete_photo();
    redirect("users.php");
} else {
    redirect("users.php");
}





?>