<?php
require_once __DIR__.'/../vendor/autoload.php';

function show_departments(array $departments)
{
    foreach($departments as $department)
    {
        echo ($department->name).'<br>';
        echo ($department->total_salary()).'<br>';
        foreach($department->employees as $employee)
        {
            echo ($employee->name).', ';
        }
        echo '<br>----------<br>';
    }
}

$Tom = new Employee(0, 'Tom', 1000.0, new DateTime('2015-04-13'));
$Jerry = new Employee(-1, 'Jerry', 500.0, new DateTime('2020-04-13'));
$Hori = new Employee(2, 'Hori', 100.0, new DateTime('2023-04-13'));
$Miyamura = new Employee(3, 'Miyamura', 300.0, new DateTime('2023-04-13'));
$Pascal = new Employee(4, 'Pascal', 300.0, new DateTime('2016-04-13'));
$Platon = new Employee(5, 'Platon', 600.0, new DateTime('500-04-13'));
$Hades = new Employee(6, 'Hades', 2000.0, new DateTime('100-04-13'));

$departments = array(
    new Department('dept1', array($Tom, $Jerry, $Hori, $Miyamura, $Pascal, $Platon, $Hades)),
    new Department('dept2', array($Jerry, $Hori)),
    new Department('dept3', array($Miyamura, $Pascal)),
    new Department('dept4', array($Platon, $Hades)),
    new Department('dept5', array($Platon))
);

foreach($departments[0]->employees as $employee)
{
    echo ($employee->name).'<br>';
    echo 'Work experience: '.$Tom->work_experience().'<br>';
    is_valid($employee);
    echo '-----------<br>';
}

echo '<br><br>';

show_departments($departments);

echo '<br><br>';

$total_salaries = array_map(function ($department) { return $department->total_salary(); }, $departments);
$max_total_salary = max($total_salaries);
$min_total_salary = min($total_salaries);

function equals_max(Department $value)
{
    global $max_total_salary;
    return $value->total_salary() == $max_total_salary;
}
function equals_min(Department $value)
{
    global $min_total_salary;
    return $value->total_salary() == $min_total_salary;
}

$departments_max = array_filter($departments, "equals_max");
$departments_min = array_filter($departments, "equals_min");

function only_largest_departments(array $departments) : array
{
    $max_size = max(array_map(function ($department) { return count($department->employees); }, $departments));
    $new_departments = array();
    foreach($departments as $department)
    {
        if(count($department->employees) == $max_size) array_push($new_departments, $department);
    }
    return $new_departments;
}

$departments_max = only_largest_departments($departments_max);
$departments_min = only_largest_departments($departments_min);

echo "Departments with max total salary: <br>";
show_departments($departments_max);
echo "Departments with min total salary: <br>";
show_departments($departments_min);
?>