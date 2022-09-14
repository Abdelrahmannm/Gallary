<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php

if (empty($_GET['id'])) {
    redirect("photos.php");
}

$photo = Photo::findById($_GET['id']);
if ($photo) {
    $photo->delete_photo();
    $session->message("the photo $photo->filename has been Deleted");
    redirect("photos.php");
} else {
    redirect("photos.php");
}





?>