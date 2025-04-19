<?php

namespace App\Models;

use App\Bootstrap\Session;

class BaseModel
{
    protected QueryBuilder $query;
    protected Session $session;

    public function __construct()
    {
        $this->query = new QueryBuilder();

        $this->session = new Session();
    }

    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if(property_exists($this,$key)){
                $this->{$key} = $value;
            }
        }
    }
}