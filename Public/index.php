 <?php


 require   '../vendor/autoload.php';
 
 session_abort();
dd($_SERVER);
 Router::run();
