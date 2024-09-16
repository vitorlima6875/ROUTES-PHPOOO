<?php
 namespace  app\core;

 class Router 
 {
    public static function run ()
    {
        try {
        $RouterRegistered = new RoutersFilter;
        $Router =  $RouterRegistered->get();

        $controller = new controller;
        $controller ->execute($Router);
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
 }
 