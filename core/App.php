<?php

namespace Core;

class App
{

  private $controller, $action, $params;

  public function __construct()
  {
    $this->checkingRoute();
    $this->render();
  }


  public function checkingRoute()
  {
    global $route;
    $request = new Request;
    $requested_url = $request->server('QUERY_STRING');
    $requested_method = $request->server('REQUEST_METHOD');
    $all_routes = $route->getRoutingTable();

    foreach ($all_routes as $url => $info) {
      if (preg_match($url, $requested_url, $matches)) {
        if ($requested_method == $info['method']) {
          $this->controller = $info['controller'];
          $this->action = $info['action'];
          $this->params = array_slice($matches, 1);
          return true;
        } else {
          die("405 method does not exist");
        }
      }
    }
    die("404  not found");
  }

  public function render()
  {
    //add namespaces to the class name 
    $controller_name = "App\Controllers\\" . $this->controller;
    if (class_exists($controller_name)) {
      $controller_object = new $controller_name;

      if (method_exists($controller_object, $this->action)) {
        //call the method

        call_user_func_array([$controller_object, $this->action], $this->params);
      } else {
        die("$this->action action doesn't exist");
      }
    } else {
      die("$this->controller controller doesn't exist");
    }
  }
}
