<?php

namespace Core;


class View
{
  public static function load(string $path, array $data = [])
  {
    $filePath =  VIEWS . "$path.php";
    if (file_exists($filePath)) {
      extract($data);
      ob_start();
      require_once $filePath;
      ob_end_flush();
    }
  }
}
