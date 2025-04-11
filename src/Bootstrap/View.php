<?php

namespace App\Bootstrap;

class View
{
    const string VIEW_DIRECTORY = __DIR__ . '/../../view/';

    public static function render($name, $data=[]): void
    {
        extract($data);
        require_once self::VIEW_DIRECTORY . $name . '.php';
    }


}