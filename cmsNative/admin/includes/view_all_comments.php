<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Comment</th>
            <th>Email</th>
            <th>status</th>
            <th>In Response to </th>
            <th>Date</th>
            <th>Approve </th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>


        <?php
        if($_SESSION['user_role']=='admin'){
            $query = " select * from comments ";
        }
        else{
            $query = " SELECT * from comments WHERE user_id =". $_SESSION['user_id']."";
        }
        $select_comments = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id    = escape($row["comment_id"]);
            $comment_post_id = escape($row["comment_post_id"]);
            $comment_author = escape($row["comment_author"]);
            $comment_content = escape($row["comment_content"]);
            $comment_email = escape($row["comment_email"]);
            $comment_status = escape($row["comment_status"]);
            $comment_date = escape($row["comment_date"]);

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";

            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";

            $query="SELECT * from posts where post_id = $comment_post_id";
            $exection=mysqli_query($connection,$query);
            $row=mysqli_fetch_assoc($exection);
            $title=escape($row['post_title']);
            $id=escape($row['post_id']);

            echo "<td><a href='../post.php?p_id=$id'>$title</a> </td>";

            echo "<td>{$comment_date}</td>";
            echo "<td> <a class='btn btn-primary' href='comments.php?approve=$comment_id'> Approve </a> </td>";
            echo "<td> <a class='btn btn-warning' href='comments.php?unapprove=$comment_id'> Unapprove </a> </td>";
            ?> <form action="" method="post">
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
                    <td><input type="submit" class="btn btn-danger" name="delete" value="Delete" id=""></td>
                </form><?php
            // echo "<td> <a href='comments.php?delete=$comment_id'> Delete </a> </td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>

<?php
if(isset($_GET['unapprove']))
{
    $mycomment_id=escape($_GET['unapprove']);
    $query="UPDATE comments SET comment_status ='Unapproved' where comment_id = $mycomment_id ";
    $excution=mysqli_query($connection,$query);
    confirm($excution);
    header('Location: comments.php');
}

if(isset($_GET['approve']))
{
    $mycomment_id=escape($_GET['approve']);
    $query="UPDATE comments SET comment_status ='Approved' where comment_id = $mycomment_id ";
    $excution=mysqli_query($connection,$query);
    confirm($excution);
    header('Location: comments.php');
}


if(isset($_POST['delete']))
{
    $mycomment=escape($_POST['comment_id']);
    $query=" DELETE from comments where comment_id = {$mycomment}";
    $excution=mysqli_query($connection,$query);
    confirm($excution);
    header('Location: comments.php');
}

?>