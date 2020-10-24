<?php

namespace Core;

class Session 
{
  public function __construct()
  {
   if(!session_id())
   {
     session_start();
   }
  }

   public function get(string $key){
    #1#if statement
    // if(isset($_SESSION[$key]))
    // {
    //   return $_SESSION[$key];
    // }else{
    //   return null;
    // }

    #2#null coalescing operator
    // return $result = ($_SESSION[$key])?? null;

    #3# trenary operator
    // return $result = (isset($_SESSION[$key]))? $_SESSION[$key] : null;

    #4 with code refactor 
    return $result = ($this->has($key)) ? $_SESSION[$key] : null;

  }


  public function set(string $key , $value)
  {
    return $_SESSION[$key] = $value;
  }


  public function has(string $key )
  {
    return isset($_SESSION[$key]);
  }

  public function remove(string $key)
  {
    unset($_SESSION[$key]);
  }

  public function destroy()
  {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
      );
    }
    session_destroy();
  }
 
  public function flash(string $key)
  {
    # get function
    // $value = ($this->has($key)) ? $_SESSION[$key] : null ;

    # remove function
    // unset($_SESSION[$key]);

    #refactor
    $value = $this->get($key);
    $this->remove($key);
    return $value;
  }
}