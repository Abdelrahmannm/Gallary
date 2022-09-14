<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php //if ($connection) echo "conn"; ?>
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php "; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    <!-- the back end section of create category -->
                    <div class="col-xs-6">


                        <?php
                        Category_insertion();
                        ?>
                        <?php
                        update_categories();
                        ?>
                        <!-- form front-end to create category -->
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category_title"> Add Category</label>
                                <input class="form-control" type="text" name="category_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-info" type="submit" name="submit" value="Add category">
                            </div>
                        </form>

                        <!-- form to delete or update category  -->

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category_title"> Edit Category</label>
                                <?php delete_categort(); ?>

                                <?php
                                if (isset($_GET["Edit"])) {
                                    $category_id = $_GET["Edit"];
                                    include "includes/update_categories.php";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-info" type="submit" name="update" value="update">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <th>Category Title</th>

                                    <th>ID</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // display table of the data
                                findAllCategories(); 
                                 ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>

    <?php
    if (isset($_POST['delete'])) {
        $mypost = escape($_POST['category_id']);
        $query = " DELETE from category where category_id = {$mypost}";
        $excution = mysqli_query($connection, $query);
        confirm($excution);
        header('Location: categories.php');
    }
    
    ?>