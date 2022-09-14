<?php include("includes/header.php"); ?>
<?php require_once("admin/includes/init.php"); ?>
<?php
if (empty($_GET['id'])) {
    redirect("index.php");
}
$photo = Photo::findById($_GET['id']);



if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_commet = Comment::create_comment($photo->id, $author, $body);

    if ($new_commet && $new_commet->save()) {

        redirect("photo.php?id=$photo->id");
    } else {
        $message = "saving problem";
    }
} else {
    $author = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);


?>

<div class="row">
    <!-- Blog Post Content Column -->
    <div class="col-lg-12 row">

        <!-- Blog Post -->

        <!-- Title -->
        <h1><?php echo $photo->title ?></h1>

        <!-- Author -->

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" height="400" width="1200" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead"><?php echo $photo->caption; ?></p>
        <p><?php echo $photo->decription; ?></p>

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <label for="body">Comment</label>
                    <textarea name="body" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->
        <?php foreach ($comments as $comment) : ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="https://via.placeholder.com/80" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment->author; ?>
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    <?php echo $comment->body; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- Comment -->


    </div>
</div>
<!-- <div class="col-md-4"> -->


<?php //include("includes/sidebar.php"); 
?>



<!-- </div> -->
<!-- /.row -->

<?php include("includes/footer.php"); ?>