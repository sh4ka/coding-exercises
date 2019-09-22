<?php


class Paren2
{
    public function __construct($n)
    {
        $str = [];
        $list = [];

        $this->addParen($list, $n, $n, $str, 0);
        print_r($list);
    }

    public function addParen(&$list, $lrem, $rrem, $str, $index)
    {
        if ($lrem < 0 || $rrem < $lrem) {
            return false; // error case
        }

        if ($lrem == 0 && $rrem == 0) {
            $list[] = implode('', $str);
        } else {
            $str[$index] = '(';
            $this->addParen($list, $lrem - 1, $rrem, $str, $index + 1);

            $str[$index] = ')';
            $this->addParen($list, $lrem, $rrem - 1, $str, $index + 1);
        }
    }
}

$paren = new Paren2(5);