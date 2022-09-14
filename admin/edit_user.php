<?php include("includes/header.php"); ?>
<?php include("includes/photo_modal.php"); ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>

<?php
if (isset($_GET['id'])) {
    $user = User::findById($_GET['id']);
    if (isset($_POST['update'])) {
        if ($user) {
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->password = $_POST['password'];
            if (empty($_FILES['user_image'])) {
                $user->save();
                redirect("users.php");
                $session->message("the user saved successfully");
            } else {
                $user->set_file($_FILES['user_image']);
                $user->upload_photo();
                $user->save();
                redirect("users.php");
                $session->message("the user saved successfully");

                // redirect("edit_user.php?id=$user->id");
            }
        }
    }
} else {
    redirect("users.php");
}



?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Users <small></small>
                </h1>
                <form action="" method='post' enctype="multipart/form-data">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" id="" value="<?php echo $user->username; ?>">
                        </div>
                        <div class="form-group text-center user_image_box">
                            <a class="thumbnail" data-toggle="modal" data-target="#photo-library" href="#"><img width=500 height=200 src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""></a>
                            <input class="thumbnail" type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" class="form-control" id="" value="<?php echo $user->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="" value="<?php echo $user->last_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="" value="<?php echo $user->password; ?>">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="user-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="glyphicon glyphicon-calendar"></span> Uploaded on: <?php echo date("F j, Y, g:i a"); ?>

                                    </p>
                                    <p class="text ">
                                        username: <span class="data user_id_box"><?php echo $user->username; ?></span>
                                    </p>
                                    <p class="text">
                                        First name: <span class="data"><?php echo $user->first_name; ?></span>
                                    </p>
                                    <p class="text">
                                        last name: <span class="data"><?php echo $user->last_name; ?></span>
                                    </p>
                                    <p class="text">
                                        Password: <span class="data"><?php echo $user->password; ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a class='btn btn-danger btn-lg' id='user-id' href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
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