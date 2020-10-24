<?php

namespace Core;

// require_once "../routes/web.php";
class App
{

  private $controller, $action , $params ;

  public function __construct()
  {
    $this->checkingRoute();
    $this->render();
  }


  public function checkingRoute()
  {

    /* ANCHOR
    ////public function checkingRoute(Route $route)
    ? in the session we didn't use global to be able to identify $route ($all_routes = $route->getRoutingTable())
     the answer is the method checkingRoute() i did it with out getting Route object 
    ! global $route;
    */

    global $route;
    $request = new Request;
    $requested_url = $request->server('QUERY_STRING');
    //!TEST
    // echo $requested_url;
    // echo '<br />';
    $requested_method = $request->server('REQUEST_METHOD');
    //! TEST
    // echo $requested_method;
    /* 
    // $server_all = $request->serverAll();
    // echo '<pre>';
    // print_r($server_all);
    // echo '</pre>' ;
    // $route_object = new Route;
    */
    $all_routes = $route->getRoutingTable();

    // NOTE
    /*
    ! ezzay ana shayf Class Web and Route min 3'eer use key word 
    ? routes/web.php & Core/Route.php
    */
    //!TEST
    // echo '<pre>';
    // print_r($all_routes);
    // echo '</pre>';

    foreach ($all_routes as $url => $info) {

      /* !//? to test $url returns
      echo '<pre>';
      print_r($url);
      echo '</pre>' ;
      */
      // // if ($requested_url == $url){
      if (preg_match($url,$requested_url , $matches )){
          if( $requested_method == $info['method']) {
            $this->controller = $info['controller'];
            $this->action = $info['action'];
            $this->params = array_slice($matches , 1);
            return true ;
          }else{
          die("405 method does not exist");
          }
        /* //!deprecated if statement (wrong else statement)
        // if ($requested_url != $single_route) {
        //   die('404 url not found');
        // }
        // elseif ($requested_method != $info['method']) {
        //   die('405 method not allowed');
        // }
        // else {
        //   $this->controller = $info['controller'];
        //   $this->method = $info['method'];
        // }
        */
      }
      // echo $this->controller;
      // echo '<br />';
      // echo $this->action ;
      // echo '<br />';
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
        // //$action_name = $this->action;
        // //$controller_object->$action_name();

        call_user_func_array([$controller_name , $this->action] , $this->params);


      } else {
        // echo $this->action .  1 . '<br />'; 
        die("$this->action action doesn't exist");
      }
    } else {
      // echo $this->controller .  1 . '<br />';
      die("$this->controller controller doesn't exist");
    }
  }
}
