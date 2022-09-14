<?php include("includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>
<?php 
if(empty($_GET['id']))
{
    redirect("photos.php");
}


?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Comments
                </h1>
                <a href="../photo.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary">Add comment</a>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Body</th>
                                <th>Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $comments=Comment::find_the_comments($_GET['id']); ?>

                            <?php foreach ($comments as $comment) : ?>
                                <tr>
                                    <td><?php echo  $comment->id ?></td>
                                    <td><?php echo  $comment->author ?></td>
                                    <td><?php echo  $comment->body ?></td>
                                    <td><a class="btn btn-danger btn-sm " href="delete_comment_photo.php?id=<?php echo $comment->id ?>">Delete</a></td>
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