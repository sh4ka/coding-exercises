<?php


class PermutationsWithDupes
{
    public $permutations = [];

    public function __construct($string = '')
    {
        $this->permutations = $this->calcPermutations($string);
        var_dump($this->permutations);
    }

    public function calcPermutations($string)
    {
        $result = [];
        $map = $this->buildHasmap($string);
        $result = $this->printPermutations($map, '', strlen($string), $result);

        return $result;
    }

    public function printPermutations(array $map, string $prefix, int $remaining, array $result): array {
        // base case
        if ($remaining === 0) {
            $result[] = $prefix;
            return $result;
        }

        foreach ($map as $c => $count) {
            if ($count > 0) {
                $map[$c]--;
                $result = $this->printPermutations($map, $prefix . $c, $remaining - 1, $result);
                $map[$c] = $count;
            }
        }

        return $result;
    }

    protected function buildHasmap($string)
    {
        $hashmap = [];
        foreach (str_split($string) as $letter) {
            if (!array_key_exists($letter, $hashmap)) {
                $hashmap[$letter] = 0;
            }
            $hashmap[$letter]++;
        }

        return $hashmap;
    }
}

$perm = new PermutationsWithDupes('test');
