<?php  

if(isset($_POST["submit"])){

    $name=["me","you","he","she"];
    $username= $_POST["name"];
    $password= $_POST["pass"];

    if(! in_array($username,$name))
    {
        echo" not welcome";
    }
    else 
    {
        echo "welcome";
    }
    // echo $username . "  ". $password
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="form.php" method="post">
    <input type="text" placeholder="Enter UserName" name="name" >
    <input type="password" placeholder="Enter Password" name="pass">
    <br>
    <input type="submit" name="submit" >


    </form>


</body>
</html>