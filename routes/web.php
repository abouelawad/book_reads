<?php

use Core\Route;


$route = new Route;
$num = '([\d]+)';
$str = '([\w-]+)';

$route->get("", "HomeController@index");
$route->get("posts/index", "PostController@index");
$route->get("posts/show/$num", "PostController@show");
$route->get("posts/store/$num", "PostController@store");
$route->get("comments/index", "PostController@index");
