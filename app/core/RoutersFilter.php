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

    private function simpleRouter()
{
    // Verifica se a rota simples existe
    if (array_key_exists($this->uri, $this->routesRegistered[$this->method])) {
        return $this->routesRegistered[$this->method][$this->uri];
    }

    return null;
}

    
private function dynamicRouter()
{
    // Caso especial para a URI raiz "/"
    if ($this->uri === '/') {
        return null; // Não processa rotas dinâmicas para "/"
    }

    foreach ($this->routesRegistered[$this->method] as $index => $route) {
        // Verifica apenas rotas que têm parâmetros dinâmicos
        if (strpos($index, '[') !== false) {
            // Escapa as barras e converte parâmetros dinâmicos para regex
            $regex = str_replace('/', '\/', ltrim($index, '/'));
            $regex = preg_replace('/\[0-9\]\+/', '[0-9]+', $regex); // Para números
            $regex = preg_replace('/\[a-z\]\+/', '[a-z]+', $regex); // Para letras

            // Adiciona os delimitadores de regex e verifica a correspondência
            if (preg_match("/^$regex$/", trim($this->uri, '/'))) {
                return $route;
            }
        }
    }

    return null;
}


    
    
    public function get()
    {
        return  $this->dynamicRouter() ?? 
        
        $this->simpleRouter() ??

       
        
        'NotFoundController@index';
    }
    
}
