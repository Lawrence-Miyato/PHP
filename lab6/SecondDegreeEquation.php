<?php
require_once 'EquationSolver.php';
require_once 'FirstOrderEquation.php'; // Đảm bảo rằng file này được yêu cầu

class QuadraticEquationSolver extends EquationSolver
{
    public function __construct($a, $b, $c)
    {
        parent::__construct($a, $b, $c);
    }

    public function solve()
    {
        $delta = $this->b * $this->b - 4 * $this->a * $this->c;
        if ($delta < 0) {
            return "Phương trình vô nghiệm.";
        } elseif ($delta == 0) {
            $x = -$this->b / (2 * $this->a);
            return "Phương trình có nghiệm kép: x = " . $x;
        } else {
            $x1 = (-$this->b + sqrt($delta)) / (2 * $this->a);
            $x2 = (-$this->b - sqrt($delta)) / (2 * $this->a);
            return "Phương trình có hai nghiệm phân biệt: X1 = " . $x1 . ", X2 = " . $x2;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];

    if ($a == 0) {
        $solver = new FirstOrderEquationSolver($b, $c);
    } else {
        $solver = new QuadraticEquationSolver($a, $b, $c);
    }

    echo $solver->solve();
}
