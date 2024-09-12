 <?php

use App\Support\RequestType;

 require   '../vendor/autoload.php';
 
 session_abort();

 dd(RequestType::get());

 //Router::run();
