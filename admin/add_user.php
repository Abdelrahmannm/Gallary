<?php include("includes/header.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>

<?php
$user = new User();
if (isset($_POST['create'])) {
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = $_POST['password'];
    $user->set_file($_FILES['user_image']);
    $user->upload_photo();
    $user->save();
    $session->message("the user $user->username has been added");
    redirect("users.php");

}


?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Users <small>Subheading</small>
                </h1>
                <form action="" method='post' enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="">
                        </div>
                     
                        <div class="form-group">
                        <label for="user_image">Image</label>
                            <input class="thumbnail" type="file" name="user_image" >
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="">
                        </div>
                        <div class="info-box-update text-center ">
                            <input type="submit" name="create" value="Create" class="btn btn-primary btn-lg ">
                        </div>


                    </div>

                </form>

            </div>

        </div>

    </div> <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>