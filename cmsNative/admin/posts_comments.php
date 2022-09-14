<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php //if ($connection) echo "conn"; 
    ?>
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php "; ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome comments
                        <small>Author</small>
                    </h1>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
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
                            $post_id=$_GET['id'];
                            $query = " SELECT  * from comments  WHERE comment_post_id = " . mysqli_real_escape_string($connection, $post_id ) . "";
                            $select_comments = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($select_comments)) {
                                $comment_id    = escape($row["comment_id"]);
                                $comment_post_id = escape($row["comment_post_id"]);
                                $comment_author = escape($row["comment_author"]);
                                $comment_content = escape($row["comment_content"]);
                                $comment_email = escape($row["comment_email"]);
                                $comment_status = escape($row["comment_status"]);
                                $comment_date =escape( $row["comment_date"]);

                                echo "<tr>";
                                echo "<td>{$comment_id}</td>";
                                echo "<td>{$comment_author}</td>";
                                echo "<td>{$comment_content}</td>";

                                // $query = " select * from category where category_id = {$post_category_id} ";
                                // $select_mycategory = mysqli_query($connection, $query);
                                // while ($row = mysqli_fetch_assoc($select_mycategory)) {
                                //     $category_id    = $row["category_id"];
                                //     $category_title = $row["category_title"];

                                // echo "<td>{$category_title}</td>";
                                // }


                                echo "<td>{$comment_email}</td>";
                                echo "<td>{$comment_status}</td>";

                                $query = "SELECT * from posts where post_id = $comment_post_id";
                                $exection = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($exection);
                                $title = $row['post_title'];
                                $id = $row['post_id'];

                                echo "<td><a href='../post.php?p_id=$id'>$title</a> </td>";

                                echo "<td>{$comment_date}</td>";
                                echo "<td> <a href='posts_comments.php?approve=$comment_id&id=" .$_GET['id']. "'> Approve </a> </td>";
                                echo "<td> <a href='posts_comments.php?unapprove=$comment_id&id=" .$_GET['id']. "'> Unapprove </a> </td>";
                                echo "<td> <a href='posts_comments.php?delete=$comment_id&id=" .$_GET['id']. "'> Delete </a> </td>";
                                echo "</tr>";
                            }

                            ?>

                        </tbody>
                    </table>

                    <?php
                    if (isset($_GET['unapprove'])) {
                        $mycomment_id = escape($_GET['unapprove']);
                        $query = "UPDATE comments SET comment_status ='Unapproved' where comment_id = $mycomment_id ";
                        $excution = mysqli_query($connection, $query);
                        confirm($excution);
                        header("Location: posts_comments.php?id=". $_GET['id'] . "");
                    }

                    if (isset($_GET['approve'])) {
                        $mycomment_id = escape($_GET['approve']);
                        $query = "UPDATE comments SET comment_status ='Approved' where comment_id = $mycomment_id ";
                        $excution = mysqli_query($connection, $query);
                        confirm($excution);
                        header("Location: posts_comments.php?id=". $_GET['id'] . "");
                    }


                    if (isset($_GET['delete'])) {
                        $mycomment = escape($_GET['delete']);
                        $query = " DELETE from comments where comment_id = {$mycomment}";
                        $excution = mysqli_query($connection, $query);
                        confirm($excution);
                        header("Location: posts_comments.php?id=". $_GET['id'] . "");
                    }

                    ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>