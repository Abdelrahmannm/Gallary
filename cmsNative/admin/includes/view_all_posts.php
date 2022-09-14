<?php
include("delete_modal.php");
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = escape($_POST['bulk_options']);

        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status='$bulk_options' WHERE post_id=$postValueId";
                $qureyUpdate_publish = mysqli_query($connection, $query);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status='$bulk_options' WHERE post_id=$postValueId";
                $qureyUpdate_draft = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE from posts WHERE post_id=$postValueId";
                $qureyDelete = mysqli_query($connection, $query);
                break;
            case 'clone':
                $query = " select * from posts where post_id = $postValueId ";
                $mycategory = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($mycategory)) {
                    $post_title = escape($row["post_title"]);
                    $post_category_id = escape($row["post_category_id"]);
                    $post_date = escape($row["post_date"]);
                    $post_author = escape($row["post_author"]);
                    $post_status = escape($row["post_status"]);
                    $post_image = escape($row["post_image"]);
                    $post_tages = escape($row["post_tages"]);
                    $post_content = escape($row["post_content"]);
                    $query  = " INSERT INTO `posts` (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tages`, `post_status`) ";
                    $query .= " VALUES ('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tages','$post_status')";
                    $send_data_query =  mysqli_query($connection, $query);
                    break;
                }
        }
    }
}

?>

<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select option</option>
                <option value="published">publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply" id="">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>status</th>
                <th>Image</th>
                <th>tages</th>
                <th>comment</th>
                <th>date</th>
                <th>View</th>
                <th>Views</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>


            <?php
            $currentuser=$_SESSION['username'];
            if($_SESSION['user_role']=='admin'){

                $query = "SELECT
                posts.post_id,
                posts.post_author,
                posts.post_title,
                posts.post_category_id,
                posts.post_status,
                posts.post_image,
                posts.post_tages,
                posts.post_comment_count,
                posts.post_date,
                posts.post_view_count,
                category.category_id,
                category.category_title
              FROM
                posts
                LEFT JOIN category ON posts.post_category_id = category.category_id 
              ORDER BY posts.user_id DESC ";


            }
            else{
            $query = "SELECT
            posts.post_id,
            posts.post_author,
            posts.post_title,
            posts.post_category_id,
            posts.post_status,
            posts.post_image,
            posts.post_tages,
            posts.post_comment_count,
            posts.post_date,
            posts.post_view_count,
            category.category_id,
            category.category_title
          FROM
            posts
            LEFT JOIN category ON posts.post_category_id = category.category_id where post_author='$currentuser'
          ORDER BY posts.user_id DESC ";}
            $select_myposts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_myposts)) {
                $post_id    = escape($row["post_id"]);
                $post_author = escape($row["post_author"]);
                $post_title = escape($row["post_title"]);
                $post_category_id = escape($row["post_category_id"]);
                $post_status = escape($row["post_status"]);
                $post_image = escape($row["post_image"]);
                $post_tages = escape($row["post_tages"]);
                $post_comment_count = escape($row["post_comment_count"]);
                $post_date = escape($row["post_date"]);
                $post_view_count = escape($row["post_view_count"]);
                $category_id    = escape($row["category_id"]);
                $category_title = escape($row["category_title"]);

                echo "<tr>";
            ?>
                <th><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $post_id; ?>"></th>
            <?php
                echo "<td>{$post_id}</td>";

                if (!empty($post_author)) {
                    echo "<td>{$post_author}</td>";
                }
                echo "<td>{$post_title}</td>";
                echo "<td>{$category_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src= '../images/$post_image' alt='image'> </td>";
                echo "<td>{$post_tages}</td>";

                $query_comments = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query_comments);
                $count_comment = mysqli_num_rows($send_comment_query);


                echo "<td><a href='posts_comments.php?id=$post_id'>$count_comment</a> </td>";
                echo "<td>{$post_date}</td>";
                echo "<td> <a class='btn btn-success' href='../post.php?p_id={$post_id}'> View Post </a> </td>";
                echo "<td><a href='posts.php?reset={$post_id}'>{$post_view_count}</a></td>";
                echo "<td> <a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'> Edit </a> </td>";

                ?>
                <form action="" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <td><input type="submit" class="btn btn-danger" name="delete" value="Delete" id=""></td>
                </form>
                <?php
                // echo "<td> <a rel='$post_id' class='delete_link' href='javascript:void(0)'> Delete </a> </td>";
                // echo "<td> <a onClick=\" javascript: return confirm('Are you Sure'); \" href='posts.php?delete={$post_id}'> Delete </a> </td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</form>
<?php
if (isset($_POST['delete'])) {
    $mypost = escape($_POST['post_id']);
    $query = " DELETE from posts where post_id = {$mypost}";
    $excution = mysqli_query($connection, $query);
    confirm($excution);
    header('Location: posts.php');
}
if (isset($_GET['reset'])) {
    $mypost = escape($_GET['reset']);
    $reset_query = "UPDATE posts SET post_view_count = 0 where post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $excution = mysqli_query($connection, $reset_query);
    confirm($excution);
    header('Location: posts.php');
}

?>

<script>
    $(document).ready(function() {
        $(".delete_link").on('click', function() {
            var id = $(this).attr("rel");
            var delete_url = "posts.php?delete=" + id + " ";
            $(".modal_delete_link").attr("href", delete_url);
            $("#exampleModal").modal("show");
        })
    });
</script>