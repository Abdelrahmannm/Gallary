<?php include("includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Photos <small></small>
                </h1>
                <p class="bg-success"><?php echo $message; ?></p>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>ID</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $photos = User::findById($_SESSION['user_id'])->photos(); ?>
                            <?php foreach ($photos as $photo) : ?>
                                <tr>
                                    <td><img class="admin-thump-nail" src='<?php echo $photo->picture_path(); ?>' alt=''>
                                        <div class="action_links">
                                            <a class="btn btn-danger  delete_link" href="delete_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                                            <a class="btn btn-primary" href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                                            <a class="btn btn-info" href="../photo.php?id=<?php echo $photo->id ?>">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo  $photo->id ?></td>
                                    <td><?php echo  $photo->filename ?></td>
                                    <td><?php echo  $photo->title ?></td>
                                    <td><?php echo  $photo->size ?></td>
                                    <?php $comments=Comment::find_the_comments($photo->id);
                                    $count=count($comments);?>
                                   <td> <a class="btn btn-info" href="photo_comment.php?id=<?php echo $photo->id ?>"><?php echo $count; ?></a></td>
                                   

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div> <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>