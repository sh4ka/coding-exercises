<?php


class TripleStep
{
    public $memo = [];

    public function getPossibilities($steps)
    {
        if ($steps == 0) {
            return 0;
        }

        if ($steps == 1) {
            return 1;
        }

        if ($steps == 2) {
            return 2;
        }

        if ($steps == 3) {
            return 3;
        }

        if (!isset($this->memo[$steps]) || $this->memo[$steps] == 0){
            $this->memo[$steps] =
                $this->getPossibilities($steps - 1) +
                $this->getPossibilities($steps - 2) +
                $this->getPossibilities($steps - 3);
        }

        return $this->memo[$steps];
    }
}

$step = new TripleStep();
echo $step->getPossibilities(50);