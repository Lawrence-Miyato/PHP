<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $children = $_POST['children'];
    $dob = $_POST['dob'];
    $start_date = $_POST['start_date'];
    $gender = $_POST['gender'];
    $employee_type = $_POST['employee_type'];
    $salary_scale = $_POST['salary_scale'];
    $absent_days = $_POST['absent_days'];
    $products = $_POST['products'];
    $overtime = $_POST['overtime'];


    $base_salary = 3000000;
    $salary = $base_salary * $salary_scale;


    $salary -= $absent_days * 100000;


    if ($employee_type == "production") {
        $salary += $products * 5000;
    }


    if ($overtime == "yes") {
        $salary += 200000;
    }


    $allowance = $children * 100000;


    $net_salary = $salary + $allowance;


    $formatted_salary = number_format($salary, 0, ',', '.');
    $formatted_allowance = number_format($allowance, 0, ',', '.');
    $formatted_net_salary = number_format($net_salary, 0, ',', '.');


    echo json_encode([
        'salary' => $formatted_salary,
        'allowance' => $formatted_allowance,
        'net_salary' => $formatted_net_salary
    ]);
}
