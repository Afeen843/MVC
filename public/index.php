<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';


use App\Bootstrap\Router;
use App\Bootstrap\View;
use App\Controllers\RegisterController;
use App\Controllers\User;

$router = new Router();
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();




$router->get('/',function (){
    View::render('home');
});

$router->get('/user',[User::class ,'index']);

$router->get('/register',[RegisterController::class ,'register']);

$router->post('/register',[RegisterController::class ,'registerForm']);

$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


