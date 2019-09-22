<?php


class PermutationsWithoutDupes
{
    protected $rawString;
    protected $permutations = [];

    public function __construct($string = '')
    {
        $this->rawString = $string;
        $this->permutations = $this->calcPermutations($this->rawString);
    }

    public function calcPermutations($remainder)
    {
        // perm a = a
        // perm ab = a + b, b + a
        // perm abc = a + perm(bc), b + perm(ac), c + perm(ab)
        $len = strlen($remainder);
        $result = [];

        if ($len == 0) {
            $result[] = '';
            return $result;
        }

        for ($i = 0; $i < $len; $i++) {
            $before = substr($remainder, 0, $i);
            $after = substr($remainder, $i + 1, $len);
            $partials = $this->calcPermutations($before . $after);

            foreach ($partials as $letter) {
                $result[] = $remainder[$i] . $letter;
            }
        }

        return $result;
    }

    public function printPermutations() {
        foreach ($this->permutations as $string) {
            echo $string . PHP_EOL;
        }
    }
}

$perm = new PermutationsWithoutDupes('nice');
$perm->printPermutations();