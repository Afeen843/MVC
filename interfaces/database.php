<?php

interface database
{
    /**
     * Getter
     * @param $tableName
     * @param $id
     * @return mixed
     */
    function getDataById($tableName, $id);

    /**
     * Setter
     * @param $tableName
     * @param $id
     * @return mixed
     */
    function setDataById($tableName, $id);

    /**
     * create
     * @param $tableName
     * @param $params
     * @return mixed
     */

    function create($tableName, $params);

    /**
     * Update
     * @param $tableName
     * @param $params
     * @param $id
     * @return mixed
     */
    function update($tableName, $params, $id);

    /**
     * Delete
     * @param $tableName
     * @param $id
     * @return mixed
     */
    function delete($tableName, $id);

    /**
     * View
     * @param $tableName
     * @param $id
     * @return mixed
     */
    function view($tableName, $id);


    /**
     * @param $tableName
     * @return mixed
     */

    function show($tableName);

}