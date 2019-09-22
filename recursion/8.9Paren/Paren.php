<?php


class Paren
{

    public function __construct($n)
    {
        var_dump($this->generateParen($n));
    }

    protected function generateParen($remaining)
    {
        $parens = [];
        if ($remaining == 0) {
            $parens[] = '';
        } else {
            $previous = $this->generateParen($remaining - 1);

            foreach ($previous as $string) {
                foreach (str_split($string) as $i => $item) {
                    if ($item === '(') {
                        // insert here
                        $s = $this->insertInside($string, $i);

                        if (!in_array($s, $parens)) {
                            $parens[] = $s;
                        }
                    }
                }

                $parens[] = '()' . $string;
            }

        }

        return $parens;
    }

    protected function insertInside($base, $position)
    {
        $right = substr($base, $position + 1);
        $left = str_replace($right, '', $base);

        return $left . '()' . $right;
    }

}

$parens = new Paren(3);