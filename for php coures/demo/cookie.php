<?php 
$name="me";
$value=100;
$exp=time()+(60*60*24*7);
setcookie($name,$value,$exp);
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

<?php 
if(isset($_COOKIE['me']))
{
$someone=$_COOKIE['me'];
echo $someone;
}else{
    $someone="";
}

?>

</body>
</html>