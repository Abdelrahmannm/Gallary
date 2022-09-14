<?php include "includes/header.php"; ?> 

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 
            if(isset($_POST['submit'])){
                $search = $_POST['search'];
                $query=" SELECT * from posts where post_tages like '%$search%' ";
                $search_query = mysqli_query($connection,$query);
                $rows= mysqli_num_rows($search_query);
                if($rows<1)
                {
                    echo "<h1>NO Result </h1>" ;
                }
                else{

                while($row= mysqli_fetch_assoc($search_query)){
                $post_title = $row["post_title"];
                $post_author = $row["post_author"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_text = $row["post_content"];
                ?>
                   
                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ;?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ;?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ;?></p>
                    <hr>
                    <img class="img-responsive" src="/cms/images/<?php echo $post_image; ?>" alt="" >
                    <hr>
                    <p><?php echo $post_text ;?></p>

                    <hr>

               <?php }
                }
            }
            ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->
        <hr>
      <?php include "includes/footer.php"; ?>