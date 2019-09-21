<?php

class Bubble
{
    const SIZE = 1000;
    public $unsorted = [];

    public function __construct()
    {
        foreach (range(0, self::SIZE) as $step) {
            $this->unsorted[] = rand(0, self::SIZE);
        }
        $this->sort();
    }

    public function sort()
    {
        $step = 0;
        $unsorted = true;
        while ($unsorted) {
            $unsorted = false;
            foreach ($this->unsorted as $key => $item) {
                if (isset($this->unsorted[$key + 1])) {
                    // not at the end yet
                    if ($item > $this->unsorted[$key + 1]) {
                        $temp = $this->unsorted[$key];
                        $this->unsorted[$key] = $this->unsorted[$key + 1];
                        $this->unsorted[$key + 1] = $temp;
                        $unsorted = true;
                    }
                }
                $step++;
            }
        }
        echo 'Sorted in ' . $step . ' steps' . PHP_EOL;
    }
}
$sort = new Bubble();
print_r($sort->unsorted);