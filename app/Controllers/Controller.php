<?php
namespace   app\Controllers;

use Exception;
use League\Plates\Engine;

abstract class Controller
{
    protected function view(string $view, array $data = [0])
    {
        $viewPath = "../app/Views/".$view.'.php';
        if(!file_exists($viewPath)){
            throw new Exception("a view {$view} não exite");
        }
       
        $templates = new Engine("../app/Views/");
        echo $templates->render( $view, $data);
        
    }  
}