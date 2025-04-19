<?php

namespace App\Bootstrap;

class Session
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }
    public function has($key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function set($key, $value): void
    {
        $_SESSION[$key] = $value;
    }
    public function get($key):mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function unset($key): void
    {
        unset($_SESSION[$key]);
    }

    public function clear(): void
    {
        $_SESSION = [];
    }

    public function destroy()
    {
        $this->clear();
        session_destroy();
    }

    public function setFlash(string $key, string $value): void
    {
        $_SESSION['flash_'.$key] = $key;
    }

    public function getFlash(string $type):mixed
    {
        $value = $_SESSION['flash_'.$type] ?? null;
        unset($_SESSION['flash_'.$type]);
        return $value;
    }

    public function unsetFlash(string $type): void
    {
        unset($_SESSION['flash_'.$type]);
    }

    public function regenerateId(): void
    {
        session_regenerate_id(true);
    }

}