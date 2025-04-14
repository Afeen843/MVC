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
        if($registerModel->validate()){
            echo 'data is validated';
        }else{
            print_r($registerModel->getErrors());
        }
    }

}