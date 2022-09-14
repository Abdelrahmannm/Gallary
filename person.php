<?php

class person
{
    private $head = 'my head is moving'; 
    private function rotateTheHead()
    {
        echo $this->head;
        echo "<br>";
    }
    private $legs = 'my legs is moving';
    private function moveTheLegs()
    {
        echo $this->legs;
        echo "<br>";
    }
    private $arms = 'my arms is moving'; 
    private function moveTheArms()
    {
        echo $this->arms;
        echo "<br>";
    }
    private $body = 'my body is moving';
    private function rotateTheBody()
    {
        echo $this->body;
        echo "<br>";
    }
    function moving()
    {
        $this->rotateTheHead();
        $this->moveTheLegs();
        $this->moveTheArms();
        $this->rotateTheBody();
    }
}
$moza = new person();
$moza->moving();
