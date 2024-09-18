<?php 

namespace app\core;



use app\routes\Routes;
use app\support\Uri;
use app\support\RequestType;

class ControllerParams
{
    
    public function filterParams($Router)
    {  
        $uri = Uri::get();
        $exploderUri = explode('/', $uri);
        $exploderRouter = explode('/', $Router);

        $params = [];
        foreach ($exploderRouter as $index => $routerSegment) 
        {
            if($routerSegment !== $exploderUri[$index])
                {
                    $params[$index] = $exploderUri[$index];
                }
        }
                
        return $params;
    }    
            
            
            
        public function get($Router)
            {
                $Routes = Routes::get();
                $requestMethod = RequestType::get();

                $Router = array_search($Router, $Routes[$requestMethod]);

                $params = $this->filterParams($Router);

                return array($params);
            }
    
    
}