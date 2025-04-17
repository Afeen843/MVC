<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

require __DIR__ . '/../vendor/autoload.php';


use App\Bootstrap\Router;
use App\Bootstrap\View;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\User;
use App\Models\DatabaseConnection;



$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();
$db = new DatabaseConnection($_ENV['DB_DSN'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);

$router->get('/',function (){
    View::render('home',['title'=>'Home']);
});

$router->get('/user',[User::class ,'index']);

$router->get('/register',[RegisterController::class ,'register']);

$router->post('/register',[RegisterController::class ,'registerForm']);

$router->get('/login',[RegisterController::class,'signIn']);

$router->post('/login',[RegisterController::class,'signInForm']);

$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


