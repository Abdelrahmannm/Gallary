<?php


class me
{

    function gretting()
    {
        echo "hello me";
    }
    function gretting_again()
    {
        echo "hello me";
    }
}

$my_methods = get_class_methods("me");


// $myclass= get_declared_classes();

foreach ($my_methods as $class) {
    echo $class . "<br>";
}
