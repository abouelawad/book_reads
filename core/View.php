<?php

namespace Core;


class View
{
  public static function load(string $path, array $data = [])
  {
    $filePath =  "../app/Views/$path.php";
    if (file_exists($filePath)) {
      extract($data);
      require_once $filePath;
    }
  }
}
