<?php

interface customerInterface
{

    const CUSTOMER_ID = 'entity_id';
    const CUSTOMER_NAME = 'name';
    const CUSTOMER_MOBILE = 'mobile';
    const CUSTOMER_EMAIL = 'email';
    const CUSTOMER_STATE = 'state';
    const CUSTOMER_STATUS = 'status';
    const CUSTOMER_CITY = 'city';
    const CUSTOMERS_COUNTRY = 'country';
    const CUSTOMERS_ZIPCODE = 'zipcode';
    const CUSTOMERS_CUSTOMERS_GROUP = 'customer_group';


    function createUser($params);

    function updateUser($params, $id);

    function deleteUser($id);

    function viewUser($id);


}