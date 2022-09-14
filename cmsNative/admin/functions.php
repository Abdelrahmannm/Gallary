<?php
function confirm($result)
{
    global $connection;
    if (!$result) {
        die("we fucked up " . mysqli_error($connection));
    }
}
function query($query)
{
    global $connection;
    return mysqli_query($connection, $query);
}



function Category_insertion()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $category_title = $_POST['category_title'];
        if ($category_title == "" || empty($category_title)) {
            echo " This can't be empty ";
        } else {
            $query = " insert into category(category_title,user_id) value('{$category_title}', ".$_SESSION['user_id']." ) ";
            $myinsertion = mysqli_query($connection, $query);
            if (!$myinsertion) {
                die("we fucked up " . mysqli_error($connection));
            }
        }
    }
}


function loggedInUserId()
{
    global $connection;

    if (isLoggedIN()) {
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION["username"] . "'");
        confirm($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;
}



function userLikedthispost($post_id)
{
    $result = query("SELECT * FROM likes WHERE user_id= " . loggedInUserId() . " AND post_id={$post_id}");
    confirm($result);
    return mysqli_num_rows($result) >= 1 ? true : false;
}
function postslike($post_id)
{
    $result = query("SELECT * FROM likes WHERE post_id=$post_id");
    confirm($result);
    echo mysqli_num_rows($result);
}


function findAllCategories()
{
    global $connection;
    if($_SESSION['user_role']=='admin'){
        $query = " SELECT * from category ";
    }
    else{
        $query = " SELECT * from category  WHERE user_id =". $_SESSION['user_id']."";
    }
    $select_mycategory = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_mycategory)) {
        $category_id    = $row["category_id"];
        $category_title = $row["category_title"];
        echo "<tr>";
        echo "<td>{$category_title}</td>";
        echo "<td>{$category_id}</td>";
        echo "<td><a class='btn btn-info' href='categories.php?Edit={$category_id}'>Edit</a></td>";
?> <form action="" method="post">
            <input type="hidden" name="category_id" value="<?php echo $category_id ?>">
            <td><input type="submit" class="btn btn-danger" name="delete" value="Delete" id=""></td>
        </form><?php
                echo "</tr>";
            }
        }
        function delete_categort()
        {
            global $connection;
            if (isset($_GET["delete"])) {
                $category_id = $_GET["delete"];
                $query = " delete from category where category_id = {$category_id}";
                $delete_query = mysqli_query($connection, $query);
                header('Location: categories.php');
            }
        }
        function update_categories()
        {
            global $connection;
            if (isset($_POST["update"])) {
                $category_title = $_POST["category_title"];
                $category_id = $_GET["Edit"];
                $query = " update category set category_title='{$category_title}' where category_id = {$category_id}";
                $update_query = mysqli_query($connection, $query);
                if (!isset($update_query)) {
                    die("we are died");
                }
            }
        }

        function redirect($location)
        {
            header(header: "Location:" . $location);
            exit;
        }
        function ifIsItMethod($method)
        {
            if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
                return true;
            } else {
                return false;
            }
        }
        function isLoggedIN()
        {
            if (isset($_SESSION['user_role'])) {
                return true;
            } else {
                return false;
            }
        }
        function isLoggenInAndRedirect($location)
        {
            isLoggedIN();
            redirect($location);
        }

        function users_online()
        {
            if (isset($_GET['onlineusers'])) {
                global $connection;
                if (!$connection) {
                    session_start();
                    include "../includes/db.php";
                }
                $session = session_id();
                $time = time();
                $time_out_in_sec = 05;
                $time_out = $time - $time_out_in_sec;

                $query = "SELECT * FROM users_online WHERE session = '$session' ";
                $sendQuery = mysqli_query($connection, $query);
                $count = mysqli_num_rows($sendQuery);
                if ($count == NULL) {
                    mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time') ");
                } else {
                    mysqli_query($connection, "UPDATE users_online SET time='$time' WHERE session ='$session'");
                }
                $user_online = mysqli_query($connection, "SELECT * FROM users_online where time > '$time_out'");
                echo $counter_user = mysqli_num_rows($user_online);
            }
        }
        users_online();


        function escape($string)
        {
            global $connection;
            return mysqli_real_escape_string($connection, trim($string));
        }

        function queryCount($table)
        {
            global $connection;
            $query = "SELECT * from $table ";
            $selectoAll = mysqli_query($connection, $query);
            $num = mysqli_num_rows($selectoAll);
            confirm($selectoAll);
            return $num;
        }
        function queryCountforuser($table)
        {
            global $connection;
            $query = "SELECT * from $table where user_id =".$_SESSION['user_id']."";
            $selectoAll = mysqli_query($connection, $query);
            $num = mysqli_num_rows($selectoAll);
            confirm($selectoAll);
            return $num;
        }
        function condition($table, $cond)
        {
            global $connection;
            $query = "SELECT * from $table where $cond";
            $selectoAllpublishedPosts = mysqli_query($connection, $query);
            $numOfpublishedPosts = mysqli_num_rows($selectoAllpublishedPosts);
            return $numOfpublishedPosts;
        }
        function conditionforuser($table, $cond)
        {
            global $connection;
            $query = "SELECT * from $table where $cond AND user_id =".$_SESSION['user_id']."" ;
            $selectoAllpublishedPosts = mysqli_query($connection, $query);
            $numOfpublishedPosts = mysqli_num_rows($selectoAllpublishedPosts);
            return $numOfpublishedPosts;
        }
        function isAdmin()
        {
            global $connection;
            if (isLoggedIN()) {
                $query = "SELECT user_role FROM users where user_id = ".$_SESSION['user_id']."";
                $execution = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($execution);
                if ($row['user_role'] == 'admin') {
                    return true;
                } else {
                    return false;
                }
            }
        }
        function userExist($username)
        {
            global $connection;
            $query = "SELECT username FROM users where username='$username' ";
            $execution = mysqli_query($connection, $query);
            $row = mysqli_num_rows($execution);
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        }
        function emailExist($email)
        {
            global $connection;
            $query = "SELECT username FROM users WHERE user_email = '$email'";
            $execution = mysqli_query($connection, $query);
            $row = mysqli_num_rows($execution);
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        }

        function ifImage($image)
        {
            if (!$image) {
                return "image_1.jpg";
            } else {
                return $image;
            }
        }
        function Registration($username, $email, $password)
        {
            global $connection;

            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
            $email = mysqli_real_escape_string($connection, $email);
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

            $query = "INSERT INTO users (username, user_email, user_password , user_role) ";
            $query .= "VALUES ('{$username}','{$email}','{$password}','subscriper' )";
            $register_user_query = mysqli_query($connection, $query);
            $message = "Registerd Successflly";
            confirm($register_user_query);
        }
        function login($username, $password)
        {
            global $connection;
            $username = trim($username);
            $password = trim($password);
            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);
            $_query = "SELECT * from users where username= '$username' ";
            $execu = mysqli_query($connection, $_query);

            while ($row = mysqli_fetch_array($execu)) {
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];
                $db_password = $row['user_password'];
                $db_user_firstname = $row['user_firstname'];
                $db_user_lastname = $row['user_lastname'];
                $db_user_role = $row['user_role'];
                if (password_verify($password, $db_password)) {
                    $_SESSION['user_id']=$db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['firstname'] = $db_user_firstname;
                    $_SESSION['lastname'] = $db_user_lastname;
                    $_SESSION['user_role'] = $db_user_role;
                    header("Location:/cms/admin");
                } else {
                    return false;
                }
            }
            // $password=crypt($password,$db_password);
            return true;
        }
                ?>