<?php

namespace App\Models;

class BaseModel
{
    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if(property_exists($this,$key)){
                $this->{$key} = $value;
            }
        }
    }
}