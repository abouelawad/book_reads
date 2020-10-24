<?php 

namespace Core\Validation;

#to connect between the different paths interface(ValidationRule) and (ValidationStrategy)
use Core\Validation\Rules\ValidationRule; #ValidationRule is the interface

require_once "Rules/ValidationRule.php";


class ValidationStrategy 
{
private $validation_rule;

public function __construct(ValidationRule $validation_rule)
{
  $this->validation_rule = $validation_rule;
}


public function validate()
{
 return  $this->validation_rule->validate();
}

}