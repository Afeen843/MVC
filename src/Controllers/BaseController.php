<?php

namespace App\Controllers;

use App\Bootstrap\Request;
use App\Bootstrap\Session;

abstract class BaseController
{
    protected Request $request;
    protected Session $session;

    public function __construct()
    {
        $this->request = new Request();
        $this->session = new Session();
    }



}