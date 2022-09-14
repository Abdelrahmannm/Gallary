<?php
if (isset($_POST["add_user"])) {
    $user_firstname = escape($_POST["user_firstname"]);
    $user_lastname = escape($_POST["user_lastname"]);
    $user_role = escape($_POST["user_role"]);
    // $image = $_FILES['image']['name'];
    // $image_temp = $_FILES['image']['tmp_name'];
    $username = escape($_POST["username"]);
    $user_email = escape($_POST["user_email"]);
    $user_password = escape($_POST["user_password"]);

    $user_password=password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));
    // $date = date('d-m-y');
    // $post_comment_count=4;
    // move_uploaded_file($image_temp, "../images/$image");
    $query = " INSERT INTO `users` ( `user_firstname`, `user_lastname`, `user_role`, `username`, `user_email`, `user_password`) ";
    $query .= " VALUES ('$user_firstname','$user_lastname','$user_role','$username','$user_email','$user_password')";
    $send_user_query =  mysqli_query($connection, $query);
    confirm($send_user_query);
    echo "user created: .." . "<a href='users.php'>View Users</a>" ;
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_firstname"> First name </label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname"> Last name </label>
        <input type="text" name="user_lastname" class="form-control">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriper">Select Options</option>
            <option value="admin">admin</option>
            <option value="subscriper">subscriper</option>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="image"> post image </label>
        <input type="file" name="image" class="form-control">
    </div> -->
    <div class="form-group">
        <label for="username"> username </label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="email"> email </label>
        <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password"> password </label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <!-- <div class="form-group">
        <label for="content"> post content </label>
        <textarea name="content" id="" class="form-control" cols="30" rows="10"></textarea>
    </div> -->
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="add_user" value="Add User">
    </div>
</form>