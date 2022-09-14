<?php


class me
{
    static $my_name = "abdelrahman";
    static $my_age = 22;

   static function gretting()
    {
        echo "my name is ". self::$my_name;
        echo "<br>";
        echo "my age is ". self::$my_age;

    }
}

class you extends me
{
   static function display()
    {
         parent::gretting();
    }
}

 you::display();