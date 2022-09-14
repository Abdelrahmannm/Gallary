<?php


class people
{
    private $my_name;

    function setName($enter)
    {
        $this->my_name = $enter;
    }
    function getName()
    {
        return "my name is " . $this->my_name;
    }
}

$my_n = new people();
$my_n->setName("Ahmed");
echo $my_n->getName();
