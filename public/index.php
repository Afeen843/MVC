<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require __DIR__ . '/../vendor/autoload.php';


use App\Bootstrap\Router;
use App\Bootstrap\Session;
use App\Bootstrap\View;
use App\Controllers\AuthController;
use App\Controllers\User;
use App\Models\DatabaseConnection;



$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();
$session = new Session();
$db = new DatabaseConnection($_ENV['DB_DSN'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);

$router->get('/',function (){
    View::render('home',['title'=>'Home']);
});

$router->get('/user',[User::class ,'index']);

$router->get('/register',[AuthController::class ,'register']);

$router->post('/register',[AuthController::class ,'registerForm']);

$router->get('/login',[AuthController::class,'signIn']);

$router->post('/login',[AuthController::class,'signInForm']);

$router->get('/logout',[AuthController::class,'logout']);

$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


