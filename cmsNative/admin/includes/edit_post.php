<?php
if (isset($_GET["p_id"])) {
    $the_post_id = $_GET["p_id"];
    $query = " select * from posts where post_id = $the_post_id ";
    $select_myposts_id = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_myposts_id)) {
        $post_id    = escape($row["post_id"]);
        $post_author = escape($row["post_author"]);
        $post_title = escape($row["post_title"]);
        $post_category_id = escape($row["post_category_id"]);
        $post_status = escape($row["post_status"]);
        $post_image = escape($row["post_image"]);
        $post_content = escape($row["post_content"]);
        $post_tages = escape($row["post_tages"]);
        $post_comment_count = escape($row["post_comment_count"]);
        $post_date = escape($row["post_date"]);
    }
}
if (isset($_POST['update_post'])) {
    $post_title = escape($_POST["title"]);
    $post_author = escape($_POST["author"]);
    $post_category_id = escape($_POST["post_category"]);
    $post_status = escape($_POST["status"]);
    $image = escape($_FILES['image']['name']);
    $image_temp = escape($_FILES['image']['tmp_name']);
    $post_tages = escape($_POST["tages"]);
    $post_content = escape($_POST["content"]);
    move_uploaded_file($image_temp, "../images/$image");

    // if(empty($image))
    // {
    //     $query=" select * from posts where post_id = $the_post_id ";
    //     $exec=mysqli_query($connection,$query);
    //     while($row=mysqli_fetch_array($exec))
    //     {
    //         $image=$row['post_image'];
    //     }
    // }

    if (empty($image)) {
        $query = "select post_image from posts where post_id = $the_post_id ";
        $exec = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($exec);
        $image = $row['post_image'];
    }

    $query = "UPDATE posts
  SET
    post_title = '$post_title',
    post_category_id = '{$post_category_id}',
    post_date = now(),
    post_author = '$post_author',
    post_status = '$post_status',
    post_content = '$post_content',
    post_tages='$post_tages',
    post_image = '$image'
  WHERE
    post_id = {$the_post_id};";
    $end = mysqli_query($connection, $query);
    confirm($end);
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$the_post_id'>View Post</a> OR <a href='posts.php'>Edit Other Post</a>
    </p> ";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title"> post title </label>
        <input type="text" value="<?php echo $post_title; ?>" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_category">category</label>
        <select name="post_category" id="">
            <?php
            $query = " select * from category ";
            $select_category = mysqli_query($connection, $query);
            // confirm($select_category);
            while ($row = mysqli_fetch_assoc($select_category)) {
                $category_id    = escape($row["category_id"]);
                $category_title = escape($row["category_title"]);
                if ($category_id == $post_category_id) {
                    echo  "<option selected value='$category_id'> $category_title</option>";
                } else {
                    echo  "<option value='$category_id'> $category_title</option>";
                }
            }
            ?>

        </select>
    </div>


    <div class="form-group">
        <label for="author">User</label>
        <select name="author" id="">
            <?php
            $query = " select * from users ";
            $select_user = mysqli_query($connection, $query);
            // confirm($select_category);
            //echo "<option value='$post_author'>$post_author</option>";
            while ($row = mysqli_fetch_assoc($select_user)) {
                $user_id  = escape($row["user_id"]);
                $author = escape($row["username"]);
                if($author===$post_author)
                {
                    echo"<option selected value='$author' > $author  </option>";
                }
                else{
                    echo  "<option value='$author' >  $author </option>"; 

                }
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="">
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
            if ($post_status == "published") {
                echo  "<option value='draft'> Draft</option>";
            } else {
                echo  "<option value='published'> Publish</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image ?>" alt="">
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <label for="tages"> post tages </label>
        <input type="text" value="<?php echo  $post_tages; ?> " name="tages" class="form-control">
    </div>
    <div class="form-group">
        <label for="content"> post content </label>
        <textarea name="content" id="summernote" class="form-control" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-info" name="update_post" value="update post">
    </div>
</form>

<?php

?>