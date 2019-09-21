<?php


class PermutationsWithDupes
{
    protected $rawString;
    protected $permutations = [];

    public function __construct($string = '')
    {
        $this->rawString = $string;
        $this->strlen = strlen($this->rawString);
        $this->calcPermutations($this->rawString);
    }

    public function calcPermutations($base = '')
    {
        $letters = str_split($base);
        foreach ($letters as $letter) {
            $this->permutations[] = $this->getPermutations($letter, $this->rawString);
        }
    }

    public function getPermutations($baseLetter = '', $remainder = '')
    {
        if (strlen($remainder) == 1) {
            return $remainder;
        }
        $letters = str_split($remainder);
        $temp = $letters[0];
        $letters[0] = $letters[1];
        $letters[1] = $temp;
        foreach ($letters as $letter) {
            // take rest of letters and shuffle them, this letter always first
            $remainder = preg_replace('/'.$letter.'/', '', $remainder, 1);
            return $baseLetter . $this->getPermutations($baseLetter, $remainder);
        }
    }

    public function printPermutations() {
        foreach ($this->permutations as $string) {
            echo $string . PHP_EOL;
        }
    }
}

$perm = new PermutationsWithDupes('test');
$perm->printPermutations();