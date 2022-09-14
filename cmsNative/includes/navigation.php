
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/">My CMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = " select * from category ";
                $mycategory = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($mycategory)) {
                    $category_title = $row["category_title"];
                    $category_id = $row["category_id"];
                    $category_class = '';
                    $registration_class = '';
                    $contact_class = '';
                    $login_class = '';
                    $registration = "registration.php";
                    $contact = 'contact.php';
                    $login = 'login.php';
                    //name of the current page we use this function 
                    $pageName = basename($_SERVER['PHP_SELF']);
                    if (isset($_GET['category']) && $_GET['category'] == $category_id) {
                        $category_class = 'active';
                    } else if ($pageName == $registration) {
                        $registration_class = 'active';
                    } else if ($pageName == $contact) {
                        $contact_class = 'active';
                    } else if ($pageName == $login) {
                        $login_class = 'active';
                    }

                    echo "<li class='$category_class' ><a href='/cms/category/$category_id'>{$category_title}</a></li>";
                }
                ?>
                <?php if(isLoggedIN()): ?>
                    <li>
                        <a href="/cms/admin/index.php">Admin</a>
                    </li>
                    <li>
                        <a href="/cms/includes/logout.php">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="<?php echo  $login_class; ?>">
                        <a href="/cms/login">Login</a>
                    </li>
                    <li class="<?php echo  $registration_class; ?>">
                        <a href="/cms/registration">Registration</a>
                    </li>
                <?php endif; ?>

                <li class="<?php echo  $contact_class; ?>">
                    <a href="/cms/contact">Contact</a>
                </li>

                <?php
                if (isset($_SESSION['user_role'])) {
                    if (isset($_GET['p_id'])) {
                        $the_post_id = $_GET['p_id'];
                        echo "<li><a href='/cms/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>