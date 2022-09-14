<?php  

if(isset($_POST["submit"])){

    $name=["me","you","he","she"];
    $username= $_POST["name"];
    $password= $_POST["pass"];

    if(! in_array($username,$name))
    {
        echo"not welcome";
    }
    else 
    {
        echo "welcome";
    }
    // echo $username . "  ". $password
}


?>