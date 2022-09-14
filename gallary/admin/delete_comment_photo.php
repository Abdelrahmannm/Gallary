<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>
<?php

if (empty($_GET['id'])) {
    redirect("photo_comment.php");
}

$comment = Comment::findById($_GET['id']);
if ($comment) {
    $comment->delete();
    redirect("photo_comment.php?id=".$comment->photo_id);
} else {
    redirect("photo_comment.php?id=".$comment->photo_id);
}





?>