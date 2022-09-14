<?php
if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
    $query = " select * from users where user_id =$the_user_id";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id    = escape($row["user_id"]);
        $username = escape($row["username"]);
        $user_password = escape($row["user_password"]);
        $user_firstname = escape($row["user_firstname"]);
        $user_lastname = escape($row["user_lastname"]);
        $user_email = escape($row["user_email"]);
        $user_image = escape($row["user_image"]);
        $user_role = escape($row["user_role"]);
    }
    if (isset($_POST["edit_user"])) {
        $user_firstname = escape($_POST["user_firstname"]);
        $user_lastname =escape( $_POST["user_lastname"]);
        $user_role =escape( $_POST["user_role"]);
        // $image = $_FILES['image']['name'];
        // $image_temp = $_FILES['image']['tmp_name'];
        $username =escape( $_POST["username"]);
        $user_email = escape($_POST["user_email"]);
        $user_password = escape($_POST["user_password"]);
        // $date = date('d-m-y');
        // $post_comment_count=4;
        // move_uploaded_file($image_temp, "../images/$image");
        if (!empty($user_password)) {
            $query_pass = "SELECT user_password FROM users WHERE user_id=$the_user_id";
            $get_query = mysqli_query($connection, $query_pass);
            confirm($get_query);
            $row = mysqli_fetch_array($get_query);
            $db_password =escape($row['user_password']);
            if ($db_password != $user_password) {
                $user_password_hashed = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            }
        }
$query = "UPDATE users
SET
  username = '$username',
  user_firstname = '{$user_firstname}',
  user_lastname = '$user_lastname',
  user_email = '$user_email',
  user_role = '$user_role',
  user_password='$user_password_hashed'
WHERE
  user_id = {$the_user_id};";
        $end = mysqli_query($connection, $query);
        confirm($end);

        echo "user Edited: .." . "<a href='users.php'>View Users</a>";
    }
}
else{
    header("location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname"> First name </label>
        <input type="text" value="<?php echo $user_firstname; ?>" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname"> Last name </label>
        <input type="text" value="<?php echo $user_lastname; ?>" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?> </option>

            <?php
            if ($user_role == 'admin') {
                echo "<option value='subscriper'>subscriper</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }

            ?>
        </select>
    </div>

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
        <input type="password" autocomplete="off" name="user_password" class="form-control">
    </div>
    <!-- <div class="form-group">
        <label for="content"> post content </label>
        <textarea name="content" id="" class="form-control" cols="30" rows="10"></textarea>
    </div> -->
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="edit_user" value="update User">
    </div>
</form>