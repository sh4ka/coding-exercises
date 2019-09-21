<?php


class Merge
{
    const SIZE = 1000;
    public $unsorted = [];
    public $steps = 0;

    public function __construct()
    {
        foreach (range(0, self::SIZE) as $step) {
            $this->unsorted[] = rand(0, self::SIZE);
        }

        $this->unsorted = $this->mergesort($this->unsorted);
        var_dump($this->unsorted);
        echo 'Steps: ' . $this->steps;
    }

    protected function mergesort($numlist)
    {
        if(count($numlist) == 1 ) return $numlist;

        $mid = count($numlist) / 2;
        $left = array_slice($numlist, 0, $mid);
        $right = array_slice($numlist, $mid);

        $left = $this->mergesort($left);
        $right = $this->mergesort($right);

        return $this->merge($left, $right);
    }

    protected function merge($left, $right)
    {
        $result = [];
        $leftIndex = 0;
        $rightIndex = 0;

        while($leftIndex<count($left) && $rightIndex<count($right))
        {
            if($left[$leftIndex] > $right[$rightIndex])
            {
                $result[] = $right[$rightIndex];
                $rightIndex++;
            } else {
                $result[] = $left[$leftIndex];
                $leftIndex++;
            }
            $this->steps++;
        }
        while($leftIndex < count($left))
        {
            $result[]=$left[$leftIndex];
            $leftIndex++;
            $this->steps++;
        }
        while($rightIndex < count($right))
        {
            $result[] = $right[$rightIndex];
            $rightIndex++;
            $this->steps++;
        }
        return $result;
    }
}

$sort = new Merge();