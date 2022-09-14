<?php  include "db.php";?>
<?php include "functions.php";?>
<?php include "includes/header.php";?>
<?php read();?>


    <div class="container">
        <h1>Read</h1>
        <div class="col-sm-6">

            <?php
                while($row= mysqli_fetch_assoc($result)){
                    print_r($row);
                ?>
                <pre> 
                    <?php print_r($row); ?>
                </pre>
                <?php 

                }
            
            ?>

        </div>
    </div>
    
 <?php include "includes/footer.php";?>