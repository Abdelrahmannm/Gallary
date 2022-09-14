<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email </th>
            <th>Role </th>

        </tr>
    </thead>
    <tbody>


        <?php
        $query = " select * from users ";
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


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";

            // $query = " select * from category where category_id = {$post_category_id} ";
            // $select_mycategory = mysqli_query($connection, $query);
            // while ($row = mysqli_fetch_assoc($select_mycategory)) {
            //     $category_id    = $row["category_id"];
            //     $category_title = $row["category_title"];

            // echo "<td>{$category_title}</td>";
            // }


            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";




            // $query="SELECT * from posts where post_id = $comment_post_id";
            // $exection=mysqli_query($connection,$query);
            // $row=mysqli_fetch_assoc($exection);
            // $title=$row['post_title'];
            // $id=$row['post_id'];

            // echo "<td><a href='../post.php?p_id=$id'>$title</a> </td>";

            echo "<td> <a class='btn btn-success' href='users.php?change_to_admin=$user_id'> admin </a> </td>";
            echo "<td> <a class='btn btn-info' href='users.php?change_to_sub=$user_id'> subscriper </a> </td>";
            echo "<td> <a class='btn btn-warning' href='users.php?source=edit_user&edit_user=$user_id'> Edit </a> </td>";
        ?> <form action="" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <td><input type="submit" class="btn btn-danger" name="delete" value="Delete" id=""></td>
            </form><?php
                    // echo "<td> <a class='btn btn-danger' href='users.php?delete=$user_id'> Delete </a> </td>";
                    echo "</tr>";
                }

                    ?>

    </tbody>
</table>

<?php
if (isset($_GET['change_to_admin'])) {
    $myuser_id = escape($_GET['change_to_admin']);
    $query = "UPDATE users SET user_role ='admin' where user_id = $myuser_id ";
    $excution = mysqli_query($connection, $query);
    confirm($excution);
    header('Location: users.php');
}

if (isset($_GET['change_to_sub'])) {
    $myuser_id = escape($_GET['change_to_sub']);
    $query = "UPDATE users SET user_role ='subscriper' where user_id = $myuser_id ";
    $excution = mysqli_query($connection, $query);
    confirm($excution);
    header('Location: users.php');
}


if (isset($_POST['delete'])) {
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] == 'admin') {
            $myuser = mysqli_real_escape_string($connection, $_POST['user_id']);
            $query = " DELETE from users where user_id = {$myuser}";
            $excution = mysqli_query($connection, $query);
            confirm($excution);
            header('Location: users.php');
        }
    }
}

?>