<?php
namespace app\Controllers;

use app\database\filters;
use app\database\pagination;
use app\database\models\user;

class HomeController extends controller
{
   public function index()
   {
      $filters = new filters;
      $filters->where('users.id', '>', 170);
      //$filters->join('post', 'users.id','=', 'post.userId','left join');
      
      $pagination = new pagination;
      $pagination->setItemPerPages(10);


      
      $user = new user();
      $user->setFields('users.id, firstName, lastName');
      $user->setFilters($filters);
      $user->setPagination($pagination);
      $userFound = $user->fetchAll();
      //dd($userFound);

      

      $this->view('home', ['title' => 'Home', 'users' => $userFound,'pagination'=> $pagination]);
   }
}
