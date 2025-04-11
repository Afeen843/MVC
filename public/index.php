<?php
error_reporting(E_ERROR);
ini_set('display_errors', 1);
require __DIR__ . '/../vendor/autoload.php';

use App\Bootstrap\Router;
use App\Bootstrap\View;
use App\Controllers\User;

$router = new Router();

$router->get('/',function(){
    echo 'home';
});

$router->get('/',function (){
    View::render('home');
});

$router->get('/user',[User::class ,'index']);


$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


