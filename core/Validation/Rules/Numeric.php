<?php

namespace Core\Validation\Rules;

require_once "ValidationRule.php";


class Numeric implements ValidationRule
{
  private $name, $value;

  public function __construct($name, $value)
  {
    $this->name = $name;
    $this->value = $value;
  }

  public function validate()
  {
    if (!is_numeric($this->value)) {
      return "$this->name must be number";
    }
    return "";
  }
}
