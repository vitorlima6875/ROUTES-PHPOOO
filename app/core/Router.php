<?php
 namespace  App\Core;

 class Router 
 {
    public static function run ()
    {
        $RouterRegestered = new RoutersFilter;
        $Router =  $RouterRegestered->get();

        dd($Router);
    }
 }