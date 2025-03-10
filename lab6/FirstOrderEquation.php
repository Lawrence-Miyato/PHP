<?php
require_once 'EquationSolver.php';

class FirstOrderEquationSolver extends EquationSolver
{
    public function __construct($b, $c)
    {
        parent::__construct(0, $b, $c);
    }

    public function solve()
    {
        if ($this->b == 0) {
            if ($this->c == 0) {
                return "Phương trình có vô số nghiệm.";
            } else {
                return "Phương trình vô nghiệm.";
            }
        } else {
            $x = -$this->c / $this->b;
            return "Nghiệm của phương trình là: x = " . $x;
        }
    }
}
