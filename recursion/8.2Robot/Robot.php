<?php


class Robot
{
    public $ndim;

    const BLOCKS = 5;
    public $squares = [];

    public function __construct($ndim)
    {
        $this->ndim = $ndim;
        $this->setBoard();
        $this->printBoard();

        $this->moveRobot();
    }

    public function setBoard()
    {
        $this->squares[0][0] = 'R';
        $this->squares[$this->ndim - 1][$this->ndim - 1] = 'G';
        $this->blocks = $this->getBlocks();
        foreach (range(0, $this->ndim - 1) as $row) {
            foreach (range(0, $this->ndim - 1) as $column) {
                if (in_array([$row, $column], $this->blocks)) {
                    $this->squares[$row][$column] = 'X';
                    continue;
                }
                if (!isset($this->squares[$row][$column])) {
                    $this->squares[$row][$column] = '.';
                }
            }
        }
    }

    public function printBoard()
    {
        foreach (range(0, $this->ndim - 1) as $row) {
            foreach (range(0, $this->ndim - 1) as $column) {
                echo ' ' . $this->squares[$row][$column] . ' ';
            }
            echo PHP_EOL;
        }

        echo PHP_EOL;
        echo 'Waiting for next move';
        echo PHP_EOL;
    }

    public function getBlocks()
    {
        $blocks = [];
        $added = 0;
        while (true) {
            $blockY = rand(1, ($this->ndim - 1));
            $blockX = rand(1, ($this->ndim - 1));
            if (!in_array([$blockY, $blockX], $blocks) && !isset($this->squares[$blockY][$blockX])) {
                $blocks[] = [$blockY, $blockX];
                $added++;
            }

            if ($added == self::BLOCKS) {
                break;
            }
        }

        return $blocks;
    }

    public function moveRobot($moves = [[0, 0]], $badmoves = [])
    {
        $position = $this->getCursorPosition($moves);

        if (isset($this->squares[$position[0]][$position[1] + 1]) &&
            $this->squares[$position[0]][$position[1] + 1] !== 'X' &&
            !$this->isABadMove([$position[0], $position[1] + 1], $badmoves)
        ) {
            // valid move
            $moves[] = [$position[0], $position[1] + 1];
        } elseif (isset($this->squares[$position[0] + 1][$position[1]]) &&
            $this->squares[$position[0] + 1][$position[1]] !== 'X' &&
            !$this->isABadMove([$position[0] + 1, $position[1]], $badmoves)
        ) {
            // valid move
            $moves[] = [$position[0] + 1, $position[1]];
        } else {

            if($this->getCursorPosition($moves) == [$this->ndim - 1, $this->ndim - 1]) {
                // play moves
                $this->squares[$this->ndim - 1][$this->ndim - 1] = 'R';
                $this->squares[0][0] = '.';
                echo 'The robot wins: '. PHP_EOL;
                print_r($moves);
                echo PHP_EOL;
                $this->printBoard();
                return true;
            }

            // change last move in direction if possible
            $badmoves[] = array_pop($moves);
            $this->moveRobot($moves, $badmoves);
            return false;
        }

        $this->moveRobot($moves, $badmoves);
    }

    public function isABadMove($desiredPosition, $badmoves = [])
    {
        if (in_array($desiredPosition, $badmoves)) {
            return true;
        }

        return false;
    }

    public function getRobotPosition()
    {
        foreach (range(0, $this->ndim - 1) as $row) {
            foreach (range(0, $this->ndim - 1) as $column) {
                if ($this->squares[$row][$column] === 'R') {
                    return [$row, $column];
                }
            }
        }

        return [];
    }

    public function getCursorPosition($moves = [])
    {
        return array_pop($moves);
    }
}

$robot = new Robot(8);