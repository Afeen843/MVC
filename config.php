<?php

/** defining main config variables */
const BASE_DIR = __DIR__;
const BASE_URL = 'http://localhost/pdo/';
const BASE_DIR__CONTROLLER = BASE_DIR . '/controller';
const BASE_DIR_Frontend = BASE_DIR . '/frontend';
const BASE_DIR_Database = BASE_DIR . '/Database';
const BASE_DIR_MODEL = BASE_DIR . '/model';

/** Database Configuration */
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'pdo';

/**
 * Var Dump function
 *
 * @param $params
 * @return void
 */
function debug($params){
    echo '<pre>';
    var_dump($params);
}

include_once('classes/db.php');
include_once('classes/customers.php');
include_once('classes/mainController.php');


$pageIndexing =
    [
        'products' => 'products.php',
        'categories' => 'categories.php',
        'customers' => 'customers.php',
        'dashboard' => 'dashboard.php'
    ];

$db = new db();




$customer = new customers();

//$customer->createUser(['name'=>'sohail','email'=>'sohail@devbunch.com','mobile'=>'3338448127','city'=>'pesahawer'])

//$db->showAll('customers');
//$db->Show('2');
//$db->namePrams('13','2');


?>