<?php


class men
{
    var $age=33;
    
    function gretting()
    {
        echo "hello me";
    }
    function gretting_again()
    {
        echo "hello me";
    }
}

$me = new men();
echo $me->age;

class women extends men {

}


$yara= new women();
echo "<br>";
echo $yara->age=20;


?>