<?php

namespace App\Models;

class BaseModel
{
    protected QueryBuilder $query;
    public function __construct()
    {
        $this->query = new QueryBuilder();
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