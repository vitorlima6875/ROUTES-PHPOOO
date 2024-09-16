<?php
namespace App\core;

use app\routes\Routes;
use app\support\RequestType;
use app\support\Uri;

class RoutersFilter
{
    private  string $uri;
    private string $method;
    private array $routesRegistered;
    
    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequestType::get();
        $this->routesRegistered = Routes::get();
       
    }

    private  function simpleRouter()
    {
        //  '/login'
        if (array_key_exists(key: $this->uri, array: $this->routesRegistered[$this->method])) {
            return $this->routesRegistered[$this->method][$this->uri];
        }
        return null;
    }
    

    private function dynamicRouter()
    {
        foreach ($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            if ($index !== '/' && preg_match("/^$regex$/", trim($this->uri, '/'))) {
                $routerRegisteredFound = $route;
                break;
            } else {
                $routerRegisteredFound = null;
            }
        }

        return $routerRegisteredFound;
    }
    
    public function get()
    {
        return  $this->dynamicRouter() ?? 
        
        $this->simpleRouter() ??

       
        
        'NotFoundController@index';
    }
    
}
