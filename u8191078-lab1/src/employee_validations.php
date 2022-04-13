<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Validator\Validation;

function is_valid(Employee $employee) : bool {
    $validator = Validation::createValidatorBuilder()->addMethodMapping('loadValidatorMetadata')->getValidator();

    $violations = $validator->validate($employee);

    if (0 !== count($violations)) {
        foreach ($violations as $violation) {
            echo $violation->getMessage().'<br>';
        }
        return false;
    }
    else{
        echo "Employee is valid.<br>";
        return true;
    }
}


?>