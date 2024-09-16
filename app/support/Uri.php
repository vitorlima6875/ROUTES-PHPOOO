<?php 

namespace   app\support;

class Uri
{
  public static function get()
  {
        return trim(parse_url($_SERVER['REQUEST_METHOD'], PHP_URL_PATH));
  }
}