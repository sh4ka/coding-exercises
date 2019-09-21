<?php

class Quicksort
{
    const SIZE = 100;
    public $unsorted = [];
    public $steps = 0;

    public function __construct()
    {
        foreach (range(0, self::SIZE) as $step) {
            $this->unsorted[] = rand(0, self::SIZE);
        }

        $this->unsorted = $this->quicksort($this->unsorted);
        var_dump($this->unsorted);
        echo 'Steps: ' . $this->steps;
    }

    protected function quicksort($array)
    {
        if (count($array) == 0) {
            return [];
        }

        $pivotElement = $array[0];
        $leftElement = $rightElement = [];

        $arlen = count($array);
        for ($i = 1; $i < $arlen; $i++) {
            if ($array[$i] < $pivotElement) {
                $leftElement[] = $array[$i];
            } else {
                $rightElement[] = $array[$i];
            }
            $this->steps++;
        }

        return array_merge($this->quicksort($leftElement), [$pivotElement], $this->quicksort($rightElement));
    }
}

$sort = new Quicksort();