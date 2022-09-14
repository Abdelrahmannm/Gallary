<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            $perPage = 2;

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $perPage) - $perPage;
            }
            ?>
            <h1 class="page-header">
                Posts
            </h1>
            <?php
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                $selectPostsCount = " SELECT * from posts";
            } else {
                $selectPostsCount = " SELECT * from posts Where post_status = 'published' ";
            }
            $PostsCount = mysqli_query($connection, $selectPostsCount);
            $count = mysqli_num_rows($PostsCount);
            $count = ceil($count / $perPage);
            if ($count < 1) {
                echo "<h3 class='text-center' >No Posts Available</h3>";
            } else {




                $query = " SELECT * from posts LIMIT $page_1, $perPage";
                $myPosts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($myPosts)) {
                    $post_id = $row["post_id"];
                    $post_title = $row["post_title"];
                    $post_author = $row["post_author"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = substr($row["post_content"], 0, 100);
                    $post_status = $row["post_status"];



            ?>
            
                    <!-- First Blog Post -->
                    <h2>
                        <a href="/cms/post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="/cms/author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <a href="/cms/post/<?php echo $post_id; ?>">
                        <img class="img-responsive" src="images/<?php echo ifImage( $post_image); ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="/cms/post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

            <?php }
            } ?>


        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>
    </div>
    <!-- /.row -->

    <hr>

    <ul class="pager">

        <?php
        for ($i = 1; $i <= $count; $i++) {
            if ($i == $page) {
                echo "<li ><a class='active_link'  href='index.php?page=$i'>$i</a></li>";
            } else {
                echo "<li><a href='/cms/index.php?page=$i'>$i</a></li>";
            }
        }

        ?>
    </ul>

    <?php include "includes/footer.php"; ?>