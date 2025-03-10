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

    // Basic salary calculation
    $base_salary = 3000000; // Base salary for scale 1
    $salary = $base_salary * $salary_scale;

    // Deduct salary for absent days
    $salary -= $absent_days * 100000; // Deduct 100,000 VND for each absent day

    // Add bonus for production employees
    if ($employee_type == "production") {
        $salary += $products * 5000; // Add 5,000 VND for each product
    }

    // Add overtime bonus
    if ($overtime == "yes") {
        $salary += 200000; // Add 200,000 VND for overtime
    }

    // Calculate allowance
    $allowance = $children * 100000; // 100,000 VND allowance for each child

    // Calculate net salary
    $net_salary = $salary + $allowance;

    // Format the results
    $formatted_salary = number_format($salary, 0, ',', '.');
    $formatted_allowance = number_format($allowance, 0, ',', '.');
    $formatted_net_salary = number_format($net_salary, 0, ',', '.');

    // Return the results as JSON
    echo json_encode([
        'salary' => $formatted_salary,
        'allowance' => $formatted_allowance,
        'net_salary' => $formatted_net_salary
    ]);
}
