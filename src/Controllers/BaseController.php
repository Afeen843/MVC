<?php

namespace App\Controllers;

use App\Bootstrap\Request;

abstract class BaseController
{
    protected Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }



}