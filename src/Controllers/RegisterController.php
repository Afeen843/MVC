<?php

namespace App\Controllers;

use App\Bootstrap\View;
use App\Models\RegisterModel;

class RegisterController extends BaseController
{
    public function register()
    {
        View::render('register',['title'=>'Register']);
    }

    public function registerForm()
    {
        $registerModel = new RegisterModel();
        $registerModel->loadData($this->request->body());
        if($registerModel->validate() && $registerModel->insertUser()){
            echo 'you have registered successfully';
        }else{
            View::render('register',['title'=>'Register','registerModel'=>$registerModel]);
        }
    }

}