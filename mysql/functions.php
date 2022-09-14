<?php

include "db.php";
function showAllDataId(){
global $connection;
$query = 'select * from loginpage2';
$result = mysqli_query($connection,$query);
if(!$result)
{
    die("query failed" );
}
while($row= mysqli_fetch_assoc($result))
{
    $id=$row['id'];
    echo "<option value='$id'>$id</option>";
}}

function update()
{
    global $connection;
    if(isset($_POST["submit"]))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$_POST['id'];
    $query="update loginpage2 set username = '$username',";
    $query .= "password = '$password' where id=$id ";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        die("we are died");
    }}
}

function delete()
{
    global $connection;
    if(isset($_POST["submit"])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $id=$_POST['id'];
    $query="delete from loginpage2 where id=$id ";
    $result = mysqli_query($connection,$query);
    if(!$result)
    {
        die("we are died");
    }
}
}

function create ()
{
    global $connection;
    if(isset($_POST["Create"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    $hashFormat="$2y$10$";  
    $salt="iloveyoumybeautybabythankyouforeverything";
    $hashAndSalt=$hashFormat.$salt;
    $password=crypt($password,$hashAndSalt);
     $query = "INSERT INTO loginpage2(username,password)  ";
     $query.= " VALUES('$username','$password')";
     $result = mysqli_query($connection,$query);
     if(!$result)
     {
         die("query failed" );
     }
     }
}

function read()
{
    global $connection;
    global $result;
    $query = 'select * from loginpage2';
    $result = mysqli_query($connection,$query);
    if(!$result)
{
    die("query failed" );
}
}
?>