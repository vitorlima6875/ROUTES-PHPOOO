<?php 

namespace app\support;

class Uri
{
    public static function get()
    {
      return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        
        
        // Captura e exibe a URI para depuração
        //$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
       // echo "URI Capturada: " . $uri; // Para depuração
        //return $uri;
    }
}
