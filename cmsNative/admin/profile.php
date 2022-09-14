<?php include "includes/admin_header.php"; ?>

<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * from users WHERE username ='$username' ";
    $my_admin = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($my_admin)) {
        $user_id    = $row["user_id"];
        $username = $row["username"];
        $user_password = $row["user_password"];
        $user_firstname = $row["user_firstname"];
        $user_lastname = $row["user_lastname"];
        $user_email = $row["user_email"];
        $user_image = $row["user_image"];
        $user_role = $row["user_role"];
    }
}
?>

<?php

if (isset($_POST["edit_user"])) {
    $user_firstname = $_POST["user_firstname"];
    $user_lastname = $_POST["user_lastname"];
    //$user_role = $_POST["user_role"];
    // $image = $_FILES['image']['name'];
    // $image_temp = $_FILES['image']['tmp_name'];
    $username = $_POST["username"];
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];
    // $date = date('d-m-y');
    // $post_comment_count=4;
    // move_uploaded_file($image_temp, "../images/$image");
    if (!empty($user_password)) {
        $query_pass = "SELECT user_password FROM users WHERE username= '$username' ";
        $get_query = mysqli_query($connection, $query_pass);
        confirm($get_query);
        $row = mysqli_fetch_array($get_query);
        $db_password = $row['user_password'];
        if ($db_password != $user_password) {
            $user_password_hashed = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }
    }

    $query = " UPDATE users
SET
  username = '$username',
  user_firstname = '{$user_firstname}',
  user_lastname = '$user_lastname',
  user_email = '$user_email',
  user_password='$user_password_hashed'
WHERE
  username = '{$username}';";
    $end = mysqli_query($connection, $query);
    confirm($end);
}


?>

<div id="wrapper">

    <?php //if ($connection) echo "conn"; 
    ?>
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php "; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small><?php echo $user_firstname; ?></small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_firstname"> First name </label>
                            <input type="text" value="<?php echo $user_firstname; ?>" name="user_firstname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_lastname"> Last name </label>
                            <input type="text" value="<?php echo $user_lastname; ?>" name="user_lastname" class="form-control">
                        </div>

                        <!-- <div class="form-group">
                            <select name="user_role" id="">
                                <option><?php //echo $user_role; 
                                        ?> </option>

                                <?php
                                // if ($user_role == 'admin') {
                                //     echo "<option value='subscriper'>subscriper</option>";
                                // } else {
                                //     echo "<option value='admin'>admin</option>";
                                // }

                                ?>
                            </select>
                        </div> -->

                        <!-- <div class="form-group">
                         <label for="image"> post image </label>
                         <input type="file" name="image" class="form-control">
                        </div> -->
                        <div class="form-group">
                            <label for="username"> username </label>
                            <input type="text" value="<?php echo $username; ?>" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email"> email </label>
                            <input type="email" value="<?php echo $user_email; ?>" name="user_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_password"> password </label>
                            <input type="password"   autocomplete="off" name="user_password" class="form-control" >
                        </div>
                        <!-- <div class="form-group">
                            <label for="content"> post content </label>
                            <textarea name="content" id="" class="form-control" cols="30" rows="10"></textarea>
                        </div> -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" name="edit_user" value="update Profile">
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>