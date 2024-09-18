<?php
namespace app\Core;

use Exception;

class controller
{
    public function execute(string $Router)
    {
        if (!str_contains($Router, '@')) {
            throw new Exception("A Rota está errada");
        }

        list($controller, $method) = explode('@', $Router);
        $namespace = "app\\Controllers\\";
        $controllernamespace = $namespace . $controller;

        //echo "<strong>(controllernamespace) Namespace Completo </strong>: " . $controllernamespace , "<br>",  "<strong>(method) Método Requisitado </strong>: " . $method;
        

        if (!class_exists($controllernamespace)) {
            throw new Exception(" O controller {$controllernamespace} não existe");
        }

        $controllerInstance = new $controllernamespace;

        if (!method_exists($controllerInstance, $method)) {
            throw new Exception("O método {$method} não existe no controller {$controllernamespace}");
        }

        $params = new ControllerParams;
        $params = $params->get($Router);
            
        if (empty($params)) {
            throw new Exception("Nenhum parâmetro foi passado para o método {$method}");
        }

        // Chame o método do controlador com os parâmetros
        call_user_func_array([$controllerInstance, $method], $params);
    }
}
