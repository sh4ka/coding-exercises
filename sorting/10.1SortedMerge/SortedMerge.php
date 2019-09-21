<?php


class SortedMerge
{

    protected $a = [1, 3, 5, 7, 9, 11, 12, 13, 14, 22, 50, 120];
    protected $b = [2, 4, 6, 8, 10, 15, 16, 23, 24, 51];


    public function __construct()
    {
        $this->sortedMerge($this->a, $this->b);
    }

    public function sortedMerge($a, $b)
    {
        foreach ($b as $keyB => $itemB) {
            foreach ($a as $keyA => $itemA) {
                if ($itemB <= $itemA) {
                    // put b first
                } else {
                $next = $keyA + 1;
                    while (isset($a[$next]) && $itemB > $a[$next]) {
                        $next++;
                    }

                    if (isset($a[$next]) && $next <= count($a)) {
                        // now next is smaller so we place item b just after next
                        array_splice($a, $next, 1, [$itemB, $a[$next]]);
                    } else {
                        // last position
                        // now next is smaller so we place item b just after next
                        array_splice($a, $next, 1, [$itemB]);
                    }
                }
                break;
            }
        }

        return $a;
    }
}

$sort = new SortedMerge();