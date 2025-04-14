<?php

namespace App\Bootstrap;

class Request
{
    public function methode(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGet(): bool
    {
        return $this->methode() === 'GET';
    }

    public function isPost(): bool
    {
        return $this->methode() === 'POST';
    }

    public function body(): array
    {
        $data = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $data;
    }
}