<?php
namespace   app\Core;
use app\Core\Router;

use Exception;
class controller
{
    public function execute(string $Router)
    {
        if(str_contains($Router, '@'))
        {
            throw new Exception("A Rota estar errada");
        }
        list($controller, $method) = explode('@', $Router);

        $namespace = "app\controller\\";

        $controllernamespace = $namespace.$controller;
         
        if(!class_exists($controllernamespace))
         {
            throw new Exception("o controller {$controllernamespace} nao existe");
         }

         $controller = new $controllernamespace;

         if (!method_exists($controller, $method))
         {
            throw new Exception("O metodo {$method} não existe no controller {$controllernamespace}");

         }

    }
    
}
