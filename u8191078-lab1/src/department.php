<?php
require_once __DIR__.'/../vendor/autoload.php';

class Department
{
    public string $name;
    public array $employees;

    public function __construct(string $name, array $employees)
    {
        $this->employees = $employees;
        $this->name = $name;
    }

    public static function sum_salaries(float $carry, Employee $item)
    {
    $carry += $item->salary;
    return $carry;
    }

    public function total_salary() : float
    {
        return array_reduce($this->employees, "Department::sum_salaries", 0);
    }
}
?>