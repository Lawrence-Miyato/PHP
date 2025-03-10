<?php
class EquationSolver
{
    protected $a;
    protected $b;
    protected $c;

    public function __construct($a, $b, $c = 0)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function solve()
    {
        // This method will be overridden by subclasses
    }
}
