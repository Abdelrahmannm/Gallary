<?php include "db.php";?>
<?php include "functions.php";?>
<?php include "includes/header.php";?>
<?php update();?>

    <div class="container">
        <h1>Update</h1>
        <div class="col-sm-6">
            <form action="login_update.php" method="POST"  >
                <div class="from-group">
                <label for="username">Username</label>
                <input type="text" name="username"class="form-control">
                </div>
                <div class="from-group">
                <label for="password">password</label>
                <input type="password" name ="password"class="form-control">
                </div>
                <div class="form-group">
                    <select name="id" >
                    <?php showAllDataId(); ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="UPDATE">    
            </form>
        </div>
    </div>
<?php include "includes/footer.php";?>