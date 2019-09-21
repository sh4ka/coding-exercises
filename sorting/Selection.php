<?php

class Selection
{
    const SIZE = 100;
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
        $size = count($this->unsorted);
        $steps = 0;

        for($i=0;$i<=$size - 1;$i++)
        {
            for($j=$i+1;$j<=$size - 1;$j++)
            {
                if($this->unsorted[$j] < $this->unsorted[$i])
                {
                    $min = $this->unsorted[$j];
                    $this->unsorted[$j] = $this->unsorted[$i];
                    $this->unsorted[$i] = $min;
                }
                $steps++;
            }
            $steps++;
            print $this->unsorted[$i]."\n";
        }

        echo 'Sorted in ' . $steps . PHP_EOL;
    }
}

$sort = new Selection();