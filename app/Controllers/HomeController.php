<?php
 namespace  app\Controllers;

 class HomeController extends controller
 {
    public function index()
    {
         $this->view('home', ['title' => 'Home']);
    }
 }