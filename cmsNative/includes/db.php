<?php ob_start(); ?>
<?php 

$db["host"]="localhost";
$db["user"]="root";
$db["pass"]="";
$db["database"]="cms";

foreach($db as $key=> $value)
{
    
    define(strtoupper($key),$value);
   
}
$connection = mysqli_connect(HOST,USER,PASS,DATABASE);

$query ='SET NAMES utf8 ';
mysqli_query($connection,$query);

// if($connection)
// {
//     echo "i'm superman";
// }

?>