<?php
 namespace  app\Controllers;

use app\database\filters;
use app\database\models\user;

 class HomeController extends controller
 {
    public function index()
    {
     $filters = new filters;
     /*$filters -> where('id', '>', 50, 'and');
     $filters -> where('firstName', 'like', '%andecar%');*/
     $filters -> where('email', 'IN', [1, 45, 63, 21]);

         $this->view('home', ['title' => 'Home']);
    }
 }