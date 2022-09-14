<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>


<?php
if (isset($_POST['liked'])) {

    $post_id = $_POST["post_idd"];
    $user_id = $_POST["user_idd"];

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $searchPostQuery = mysqli_query($connection, $query);
    $mypost = mysqli_fetch_array($searchPostQuery);
    $likes = $mypost["likes"];

    mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id =$post_id ");
    mysqli_query($connection, "INSERT INTO likes(user_id,post_id) VALUES($user_id,$post_id) ");
    exit();
}
if (isset($_POST['unliked'])) {

    $post_id = $_POST["post_idd"];
    $user_id = $_POST["user_idd"];

    $query = "SELECT * FROM posts WHERE post_id=$post_id";
    $searchPostQuery = mysqli_query($connection, $query);
    $mypost = mysqli_fetch_array($searchPostQuery);
    $likes = $mypost["likes"];

    mysqli_query($connection, "DELETE FROM likes where post_id= $post_id AND user_id=$user_id ");

    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id =$post_id ");
    exit();
}



?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
                $view_count = "UPDATE posts SET post_view_count= post_view_count + 1 WHERE post_id =$the_post_id";
                $sendQuery = mysqli_query($connection, $view_count);
                if (!$sendQuery) {
                    die(" Connection Lost");
                }

                if (isset($_SESSION['user_role']) ) {
                    $query = " select * from posts where post_id = $the_post_id ";
                } else {
                    $query = " SELECT * from posts where post_id = $the_post_id AND  post_status ='published'";
                    echo "<p><h4 class='text-center' > You need to <a href='/cms/login'>Log in </a> to see more functionallity</h4></p>";
                }
                $mycategory = mysqli_query($connection, $query);
                $count = mysqli_num_rows($mycategory);
                if ($count < 1) {
                    echo "<h3 class='text-center' >No Posts Available</h3>";
                } else {
                    while ($row = mysqli_fetch_assoc($mycategory)) {
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = $row["post_content"];
            ?>
                        <!-- <h1 class="page-header">
                        Page Heading
                        <small> secondary text </small>
                    </h1> -->
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="/cms/index"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="/cms/images/<?php echo ifImage($post_image); ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <hr>

                        <div class="row">
                            <p><a  class="<?php echo userLikedthispost($the_post_id)? ' unlike' : ' like';?> btn btn-primary " href="">
                            <span
                            class="glyphicon glyphicon-thumbs-up"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="<?php echo userLikedthispost($the_post_id) ? 'Want to remove the Like' : 'Want to Add Like' ;?>"
                            ></span>
                             <?php echo userLikedthispost($the_post_id) ? 'Unlike' : 'Like' ;?></a></p>
                        </div>
                    
                        <div class="row">
                            <p>Likes: <?php  echo postslike($the_post_id); ?></p>
                        </div>
                        <!-- btn btn-primary pull-left -->

                    <?php }

                    ?>
                    <?php
                    if (isset($_POST['create_comment'])) {

                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_SESSION['username'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $user_id=$_SESSION['user_id'];
                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                            $query = "INSERT into comments (comment_post_id,  comment_author,user_id , comment_email, comment_content, comment_status, comment_date)";
                            $query .= " VALUES ($the_post_id, '$comment_author','$user_id' ,'$comment_email' , '$comment_content', 'unapproved', now()) ";
                            $setting_up = mysqli_query($connection, $query);

                            // $query2 = "UPDATE posts SET post_comment_count = post_comment_count +1 where post_id = $the_post_id ";
                            // $update_comment_count = mysqli_query($connection, $query2);
                            header("Location:/cms/post/$the_post_id");
                            if (!$setting_up) {
                                die("Connection Lost");
                            }
                        } else {
                            echo "<script> alert('your Comment is empty ')</script>";
                        }
                    }


                    ?>

                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                                <label for="comment_author">Author</label>
                                <input type="text" class="form-control" name="comment_author" id="">
                            </div>
                            <div class="form-group">
                                <label for="comment_email">Email</label>
                                <input type="email" class="form-control" name="comment_email" id="">
                            </div>
                            <div class="form-group">
                                <label for="comment_email">comment</label>
                                <textarea class="form-control" name="comment_content" rows="3"></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <hr>


                    <?php
                    $query = "SELECT * FROM comments where comment_post_id= $the_post_id";
                    $query .= " AND comment_status ='approved'";
                    $query .= " ORDER BY comment_id DESC ";
                    $showComments = mysqli_query($connection, $query);
                    if (!$showComments) {
                        die($showComments . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($showComments)) {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                    ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>

            <?php
                    }
                }
            } 
            else {
                header("Location: /cms/index.php");
            }
            ?>

            <!-- Comment -->


        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->
    <hr>
    <?php include "includes/footer.php"; ?>


    <script>
        $(document).ready(function() {
            $("[data-toggle='tooltip']").tooltip();
            var post_id = <?php echo $the_post_id; ?>;
            var user_id = <?php echo loggedInUserId(); ?>;
            $('.like').click(function() {
                $.ajax({
                    url: "/cms/post/<?php echo $the_post_id; ?>",
                    type: "post",
                    data: {
                        'liked': 1,
                        'post_idd': post_id,
                        'user_idd': user_id
                    }
                });
            });
        });
        //unlike
        $(document).ready(function() {
            var post_id = <?php echo $the_post_id; ?>;
            var user_id = 20;
            $('.unlike').click(function() {
                $.ajax({
                    url: "/cms/post/<?php echo $the_post_id; ?>",
                    type: "post",
                    data: {
                        'unliked': 1,
                        'post_idd': post_id,
                        'user_idd': user_id
                    }
                });
            });
        });
    </script>