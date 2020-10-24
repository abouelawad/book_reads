<?php

namespace Core\Validation\Rules;

require_once "ValidationRule.php";


class Str implements ValidationRule
{
  private $name, $value;

  public function __construct($name, $value)
  {
    $this->name = $name;
    $this->value = $value;
  }

  public function validate()
  {
    if (! is_string($this->value)) {
      return "$this->name must be string ";
    }
    return "";
  }
}
