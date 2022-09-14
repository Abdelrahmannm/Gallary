<?php


class me
{
    public $my_name = "abdelrahman";
    private $my_age = 22;
    protected $my_tall = 183;

    function gretting()
    {
        return "my tall is " . $this->my_age;
    }
}
class you extends me
{
    public $my_name = "yara";
    protected $my_tall = 159;
    function gretting()
    {
        return "my tall is " . $this->my_tall;
    }
}

$aboda = new you();
$abelrahman = new me();
echo $abelrahman->my_name;
echo "<br>";
echo $abelrahman->gretting();
echo "<br>";
echo $aboda->my_name;
echo "<br>";
echo $aboda->gretting();
echo "<br>";
