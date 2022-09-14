<?php


class me
{

    
    var $my_name="abdelrahman";
    var $my_age=22;

     function gretting()
    {
        return "my name is ".$this->my_name;
    }
    
}

$aboda= new me();
$abelrahman= new me();
echo $abelrahman->gretting();
echo "<br>";
echo $abelrahman->my_age;
echo "<br>";
$aboda->my_name="3yad";
echo "<br>";
echo $aboda->gretting();
echo "<br>";
echo $aboda->my_age=23;






?>