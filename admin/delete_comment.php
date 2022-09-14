<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php

if (empty($_GET['id'])) {
    redirect("comments.php");
}

$comment = Comment::findById($_GET['id']);
if ($comment) {
    $comment->delete();
    $session->message("the comment $comment->id has been Deleted");
    redirect("comments.php");
} else {
    redirect("commenst.php");
}





?>