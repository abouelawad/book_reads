<?php

namespace Core\Validation\Rules;

require_once "ValidationRule.php";

class Required implements ValidationRule
{
  private $name, $value;

  public function __construct($name, $value)
  {
    $this->name = $name;
    $this->value = $value;
  }

  public function validate()
  {
    // echo strlen($this->value);
    if(strlen($this->value) == 0)
    {
      return "$this->name is required";
    }
      return "";
  }
}
