<?php
if (isset($_POST["create_post"])) {
    $title = escape($_POST["title"]);
    $author = escape($_POST["author"]);
    $post_category_id = escape($_POST["post_category"]);
    $statues = escape($_POST["status"]);
    $image = escape($_FILES['image']['name']);
    $image_temp =escape( $_FILES['image']['tmp_name']);
    $tages = escape($_POST["tages"]);
    $content = escape($_POST["content"]);
    $date = date('d-m-y');
    // $post_comment_count=4;
    move_uploaded_file($image_temp, "../images/$image");
    $query = " INSERT INTO `posts` (`post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tages`, `post_status`) ";
    $query .= " VALUES ('$post_category_id','$title','$author',now(),'$image','$content','$tages','$statues')";
    $send_data_query =  mysqli_query($connection, $query);
    confirm($send_data_query);
    $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Added successfully. <a href='../post.php?p_id=$the_post_id'>View Post</a> OR <a href='posts.php'>See Posts</a>
    </p> ";
}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title"> post title </label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
    <label for="post_category">Category</label>
        <select name="post_category" id="">
            <?php
            $query = " select * from category ";
            $select_category = mysqli_query($connection, $query);
            // confirm($select_category);
            while ($row = mysqli_fetch_assoc($select_category)) {
                $category_id    = escape($row["category_id"]);
                $category_title = escape($row["category_title"]);
                echo  "<option value='$category_id'> $category_title</option>";
            }
            ?>

        </select>
    </div>
    <div class="form-group">
    <label for="author">User</label>

        <select name="author" id="">
            <?php
           // $query = " select * from users ";
            //$select_user = mysqli_query($connection, $query);
            // confirm($select_category);
            // echo  "<option value=''>Post User</option>";
            // while ($row = mysqli_fetch_assoc($select_user)) {
            //     $user_id  =escape( $row["user_id"]);
                $author = escape($_SESSION['username']);
                echo  "<a href=''><option name='author'>  $author </option> </a> ";
            //}
            ?>

        </select>
    </div>
    <!-- <div class="form-group">
        <label for="author"> post author </label>
        <input type="text" name="author" class="form-control">
    </div> -->

    <div class="form-group">
    <label for="status">status</label>
        <select name="status" id="">
            <option value="draft">Post status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>

        </select>


    </div>

    <div class="form-group">
        <label for="image"> post image </label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="tages"> post tages </label>
        <input type="text" name="tages" class="form-control">
    </div>
    <div class="form-group">
        <label for="summernote"> post content </label>

        <textarea name="content" id="summernote" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="create_post" value="Publish post">
    </div>
</form>