<?php 
if(isset($_POST["submit"])){

   $username=$_POST["username"];
   $password=$_POST["password"];


$connection = mysqli_connect("localhost","root","","loginpage");
if($connection)
{
    echo "it works ";
}
else 
{
    die("database connection failed");
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="col-sm-6">
            <form action="login.php" method="POST"  >
                <div class="from-group">
                <label for="username">Username</label>
                <input type="text" name="username"class="form-control">
                </div>
                <div class="from-group">
                <label for="password">password</label>
                <input type="password" name ="password"class="form-control">
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
        </div>
    </div>
    
</body>
</html>