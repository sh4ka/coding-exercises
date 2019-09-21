<?php

class Board {

    public $dimensions;
    public $squares = [];

    const WHITE = true;
    const BLACK = false;

    public $lastmove = self::BLACK;

    public function __construct($ndim)
    {
        if($ndim % 2 !== 0) {
            print_r('solamente se aceptan multiplos de 2');
        }
        $this->dimensions = $ndim*$ndim;

        foreach (range(1, $ndim) as $row) {
            foreach (range(1, $ndim) as $column) {
                if ($row === ($ndim / 2) && $column === ($ndim / 2)) {
                    // add initial tokens from this position
                    $this->squares[$row][$column] = new Piece(self::WHITE, [$row, $column]);
                    $this->squares[$row][$column+1] = new Piece(self::BLACK, [$row, $column+1]);
                    $this->squares[$row+1][$column] = new Piece(self::BLACK, [$row+1, $column]);
                    $this->squares[$row+1][$column+1] = new Piece(self::WHITE, [$row+1, $column+1]);
                }

                if (!isset($this->squares[$row][$column])) {
                    $this->squares[$row][$column] = null;
                }

                asort($this->squares[$row]);
            }
        }

        $this->printBoard();
        $this->waitForInput();
    }

    public function waitForInput()
    {
        $toMove = $this->lastmove === self::WHITE ? 'B' : 'W';
        $prompt = sprintf("Enter a location, %s to move (x y): ", $toMove);
        $colorToMove = !$this->lastmove;
        $location = readline($prompt);
        $moveLocation = explode(' ', $location);

        if (!is_numeric($moveLocation[0]) || !is_numeric($moveLocation[1])) {
            $this->waitForInput();
        }

        if ($this->squares[$moveLocation[0]][$moveLocation[1]] !== null) {
            echo 'That location is occupied' . PHP_EOL;
            $this->waitForInput();
        }

        $this->squares[$moveLocation[0]][$moveLocation[1]] = new Piece($colorToMove, [$moveLocation[0], $moveLocation[1]]);

        $this->checkForDeaths();
        $this->lastmove = $colorToMove;
        $this->printBoard();
        $this->waitForInput();
    }

    public function checkForDeaths()
    {
        $ndim = (int) sqrt($this->dimensions);

        foreach (range(1,  $ndim) as $row) {
            foreach (range(1, $ndim) as $column) {
                if ($this->squares[$row][$column] !== null) {
                    /** @var Piece $piece */
                    $piece = $this->squares[$row][$column];
                    $piece->isDead($this);
                }
            }
        }
    }

    public function getPiece($xpos, $ypos)
    {
        if (isset($this->squares[$ypos][$xpos])) {
            $this->squares[$ypos][$xpos];
        }
        return ;
    }

    protected function printBoard()
    {
        $ndim = (int) sqrt($this->dimensions);

        foreach (range(1,  $ndim) as $row) {
            foreach (range(1,  $ndim) as $column) {
                if (is_null($this->squares[$row][$column])) {
                    echo ' . ';
                } else {
                    if($this->squares[$row][$column]->color === self::WHITE) {
                        echo ' W ';
                    } else {
                        echo ' B ';
                    }
                }
            }
            echo PHP_EOL;
        }
    }
}


class Piece {

    public $color = 0; // 0 black 1 white
    public $position = [0, 0]; // [x, y]

    public function __construct(bool $color, $position)
    {
        $this->color = $color;
        $this->position = $position;
    }

    public function isDead(Board $board)
    {
        if (
        ($board->getPiece($this->position[0] - 1, $this->position[1]) !== $this->color &&
            $board->getPiece($this->position[0] + 1, $this->position[1]) !== $this->color) ||
        ($board->getPiece($this->position[0], $this->position[1] - 1) !== $this->color &&
            $board->getPiece($this->position[0], $this->position[1] + 1) !== $this->color)) {

            $this->color = !$this->color;
            return true;
        }

        return false;
    }

    public function ypos()
    {
        return $this->position[0];
    }

    public function xpos()
    {
        return $this->position[1];
    }
}

$board = new Board(4);
