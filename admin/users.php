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
                    Users 
                </h1>
                <p class="bg-success"><?php echo $message; ?></p>
                <a href="add_user.php" class="btn btn-primary">Add User</a>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $users = User::findAll(); ?>

                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?php echo  $user->id ?></td>

                                    <td><img class="admin-thump-nail user_image" width="80"  height="120" src='<?php echo $user->image_path_and_placeholder(); ?>' alt=''></td>
                                    <td><?php echo  $user->username ?>
                                        <div class="action_link">
                                            <a class="btn btn-danger delete_link" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
                                            <a class="btn btn-primary" href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
                                        </div>

                                    </td>
                                    <td><?php echo  $user->first_name ?></td>
                                    <td><?php echo  $user->last_name ?></td>
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