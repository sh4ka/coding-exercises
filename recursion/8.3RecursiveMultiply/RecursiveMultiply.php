<?php


class RecursiveMultiply
{
    public $x;
    public $y;
    public $result;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;

        $this->result = $this->calcResult($this->x, $this->y);
    }

    public function calcResult($x, $y) {
        if ($x === 0 || $y === 0) {
            return 0;
        }

        if ($x == 1) {
            return $y;
        }

        if ($y == 1) {
            return $x;
        }

        return $x + $this->calcResult($x, $y - 1);
    }

    public function printResult(){
        echo $this->result;
    }


}

/*$x = readline('Input X: ');
$y = readline('Input Y: ');*/

$mul = new RecursiveMultiply(2, 3);
$mul->printResult();