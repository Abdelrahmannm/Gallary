<?php include("includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>

<?php
$photo = new Photo;
if (isset($_GET['id'])) {
    $photo = Photo::findById($_GET['id']);
    if (isset($_POST['update'])) {
        if ($photo) {
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['Caption'];
            $photo->altenate_text = $_POST['altenate_text'];
            $photo->decription = $_POST['decription'];
            $photo->save_photo_and_file();
        }
    }
} else {
    redirect("photos.php");
}



?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Photos <small>Subheading</small>
                </h1>
                <form action="" method='post'>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" id="" value="<?php echo $photo->title; ?>">
                        </div>
                        <div class="form-group text-center">
                            <a class="thumbnail" href="#"><img width=500 height=200  src="<?php echo $photo->picture_path(); ?>" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="Caption" class="form-control" id="" value="<?php echo $photo->caption; ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">Altenate Text</label>
                            <input type="text" name="altenate_text" class="form-control" id="" value="<?php echo $photo->altenate_text; ?>">
                        </div>
                        <div class="form-group">
                            <label for="decription">Decription</label>
                            <textarea  id="summernote"  class="form-control" name="decription" id="" cols="30" rows="10"><?php echo $photo->decription; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Uploaded on: <?php echo date("F j, Y, g:i a"); ?>

                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                    </p>
                                    <p class="text">
                                        File Type: <span class="data"><?php echo $photo->type; ?></span>
                                    </p>
                                    <p class="text">
                                        File Size: <span class="data"><?php echo $photo->size; ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a class='btn btn-danger btn-lg' href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div> <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>