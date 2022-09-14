<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in())
{
    redirect('login.php');
}
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/admin_navigation.php"); ?>
    <?php include("includes/admin_sidebar.php"); ?>
</nav>

<div id="page-wrapper">

    <?php include("includes/admin_content.php"); ?>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>