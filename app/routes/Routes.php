<?php

namespace       App\Routes;

class Routes 
{
    public static function get()
    {
        return [
            'get' =>[
                '/' => 'Homecontroller@index',
                '/user/[0-9]+' => 'UserController@index',
                '/register' => 'RegisterController@index'
            ],
            'post' => []
        ];
    }
}