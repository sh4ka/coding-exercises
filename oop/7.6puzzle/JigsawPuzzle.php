<?php


class JigsawPuzzle
{
    public $pieces = [];

    public function __construct($ndim = 2)
    {
        if ($ndim < 2) {
            return false;
        }

        $pieces = $this->buildPuzzle($ndim);

    }

    public function buildPuzzle($ndim)
    {
        $placedPieces = [];
        $totalPieces = $ndim * $ndim;
        // we have at least 4, so 4 corners
        $this->pieces[] = new PuzzlePiece(1, [2, $ndim+1]); // ul
        $placedPieces[] = 1;
        $this->pieces[] = new PuzzlePiece($ndim, [$ndim - 1, $ndim+$ndim]); // ur
        $placedPieces[] = $ndim;
        $this->pieces[] = new PuzzlePiece($ndim*($ndim-1)+1, [1 + (($ndim*$ndim-1) - $ndim), $ndim*($ndim-1)+2]); // bl
        $placedPieces[] = $ndim*($ndim-1)+1;
        $this->pieces[] = new PuzzlePiece($ndim*$ndim, [$ndim*$ndim - 1, $ndim*($ndim - 1)]); // br
        $placedPieces[] = $ndim*$ndim;

        // sides, we have ndim-2 in each side
        // top
        for ($i = 1; $i<=$ndim-2; $i++) {
            $position = $i + 1;
            $this->pieces[] = new PuzzlePiece($position, [$position-1, $position+1]);
            $placedPieces[] = $position;
        }
        // left
        for ($i = 1; $i<=$ndim-2; $i++) {
            $position = 1 + ($ndim * $i);
            $this->pieces[] = new PuzzlePiece($position, [$position-$ndim, $position+$ndim]);
            $placedPieces[] = $position;
        }
        // right
        for ($i = 1; $i<=$ndim-2; $i++) {
            $position = ($i + 1) * $ndim;
            $this->pieces[] = new PuzzlePiece($position, [$position-$ndim, $position+$ndim]);
            $placedPieces[] = $position;
        }
        // bottom
        for ($i = 1; $i<=$ndim-2; $i++) {
            $position = $ndim*($ndim-1) + 1 + $i;
            $this->pieces[] = new PuzzlePiece($position, [$position-1, $position+1]);
            $placedPieces[] = $position;
        }

        // rest of the pieces in number equal to the ones that we already have minus the total
        for ($i = 1; $i <= $totalPieces; $i++) {
            if (in_array($i, $placedPieces)) {
                continue;
            }

            $this->pieces[] = new PuzzlePiece($i, [$i-1, $i+1, $position-$ndim, $position+$ndim]);
            $placedPieces[] = $i; // to avoid spooky things
        }

        shuffle($this->pieces);
    }

    public function showBoard()
    {
        $ndim = (int) sqrt(count($this->pieces));
        /** @var PuzzlePiece $piece */
        $loop = 0;
        foreach ($this->pieces as $key => $piece) {
            print_r($piece->number . ' ');
            $loop++;
            if ($loop == $ndim) {
                print_r(PHP_EOL);
                $loop = 00;
            }
        }
    }
}

class PuzzlePiece
{

    public $number;

    public $fits = [];

    public function __construct($position, $fits = [])
    {
        $this->number = $position;
        $this->fits = $fits;
    }

    public function fitsWith($number) {
        if (in_array($number, $this->fits)) {
            return true;
        }

        return false;
    }
}

$puzzle = new JigsawPuzzle(4);
$puzzle->showBoard();
