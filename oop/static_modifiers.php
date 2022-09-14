<?php


class me
{
    public $my_name = "abdelrahman";
    static $my_age = 22;

   static function gretting()
    {
        return "my age is ". me::$my_age;
    }
}

echo me::gretting();
//echo me::$my_age;

// echo "<br>";
// echo $abelrahman->gretting();
// echo "<br>";
// echo $aboda->my_name;
// echo "<br>";
// echo $aboda->gretting();
// echo "<br>";
