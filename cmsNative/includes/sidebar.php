<?php
if(ifIsItMethod('POST')){

    if(isset($_POST['login'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        login($_POST['username'],$_POST['password']);
    }
    else {
        redirect('/cms/index');
    }}
    //isLoggenInAndRedirect("/cms/admin/index.php");
}

?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>

        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name='submit' class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <div class="well">
        <?php if (isset($_SESSION['user_role'])) : ?>
            <h3 class="text-center">Logged in as <?php echo $_SESSION['username']; ?></h3>
            <div class="text-center">
            <a  href="/cms/includes/logout.php" class="btn btn-danger ">Log Out</a>
            </div>
        <?php else : ?>
            <h4>Login</h4>
            <form  method="post">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Submit</button>
                    </span>
                </div>
                <div class="from-group text-center">
                    <a href="forget.php?forget=<?php echo uniqid(); ?>">Forget password</a>
                </div>
            </form>
        <?php endif; ?>

        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $query = " select * from category ";
        $mycategory_sidebar = mysqli_query($connection, $query);

        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($mycategory_sidebar)) {
                        $category_title = $row["category_title"];
                        $category_id = $row["category_id"];
                        echo "<li><a href='category/$category_id'>{$category_title}</a></li>";
                    }

                    ?>

                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>