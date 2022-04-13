<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

date_default_timezone_set('Europe/Moscow');

class Employee
{
    public int $id;
    public string $name;
    public float $salary;
    public DateTime $employment_date;

    public function __construct(int $id, string $name, float $salary, DateTime $employment_date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
        $this->employment_date = $employment_date;
    }

    public function work_experience() : int
    {
        $current_date = new DateTime('now');
        $diff = $current_date->diff($this->employment_date);
        return intval($diff->format('%y'));
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank());
        $metadata->addPropertyConstraint('id', new Assert\PositiveOrZero([
            'message' => 'id should be positive or zero'
        ]));
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\Length([
            'max' => 30,
            'maxMessage' => 'name length should be not greater than 30'
        ]));
        $metadata->addPropertyConstraint('salary', new Assert\Positive([
            'message' => 'salary should be positive'
        ]));
        $metadata->addPropertyConstraint('employment_date', new Assert\NotBlank());
        $metadata->addPropertyConstraint('employment_date', new Assert\LessThanOrEqual([
            'message' => 'employment_date should be not later than today',
            'value' => 'today'
        ]));
    }
}
?>