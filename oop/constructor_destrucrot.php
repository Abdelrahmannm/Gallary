<?php


class people
{
    public $my_name = "abdelrahman";
    static $my_age = 22;
    function display()
    {
        echo  "my name is " . $this->my_name;
        echo "<br>";
        echo  "my age is " . self::$my_age;
        echo "<br>";
    }
    function __construct()
    {
        echo  "my name is " . $this->my_name;
        echo "<br>";
        echo  "my age is " . self::$my_age--;
        echo "<br>";
    }
    function __destruct()
    {
        echo  "my name is " . $this->my_name = "no name";
        echo "<br>";
        echo  "my age is " . self::$my_age = 0;
        echo "<br>";
    }
}

$Abdelrahman = new people();
$Aboda = new people();

echo $Abdelrahman->display();
echo $Aboda->display();
