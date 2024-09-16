 <?php


use app\core\Router;
use app\support\RequestType;

 require   '../vendor/autoload.php';
 
 session_start();
 
 //dd(trim(parse_url($_SERVER['REQUEST_METHOD'], PHP_URL_PATH)));

Router::run();
