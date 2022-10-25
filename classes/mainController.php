<?php

class mainController
{

    function runAction($actionName)
    {
        if (method_exists($this, $actionName)) {
            $this->$actionName();
        } else {
            include_once(BASE_DIR . '/error404.php');
        }
    }

}