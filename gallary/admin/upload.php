<?php include("includes/header.php"); ?>


<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>

<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}
?>

<?php
$message = "";
if (isset($_FILES['file'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->user_id = $_SESSION['user_id'];
    $photo->set_file($_FILES['file']);
    if ($photo->save_photo_and_file()) {
        $message = 'photo uploaded successfully';
    } else {
        $message = join("<br>", $photo->errors);
    }
}


?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Upload <small></small>
                </h1>

                <div class="row">
                    <div class="col-lg-6">
                        <form action="upload.php" class="dropzone">
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $message; ?>
                        <form action="upload.php" method='post' enctype="multipart/form-data">
                            <div class="from-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <!-- <div class="from-group">
                                <input type="file" name="file">
                            </div> -->
                            <hr>
                            <div class="from-group text-center">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div> <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>