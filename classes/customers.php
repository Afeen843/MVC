<?php

$path = str_replace('\classes', '', __DIR__);
include_once($path . '\interfaces\customerInterface.php');
include_once($path . '\classes\db.php');

class customers extends db implements customerInterface
{

    var $tableName = 'customers';


    function createUser($params)
    {
        return parent::create($this->tableName, $params);
    }

    function updateUser($params, $id)
    {
        return parent::update($this->tableName, $params, $id);
    }

    function deleteUser($id)
    {
        return parent::delete($this->tableName, $id);
    }

    function viewUser($id)
    {
        return parent::view($this->tableName, $id);
    }

    function showUser()
    {
        return parent::show($this->tableName);
    }

    function activeUser(): int
    {
    return parent::active($this->tableName);
    }

    function totalUser() :int
    {
        return parent::total($this->tableName);
    }

}