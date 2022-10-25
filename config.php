<?php

include_once('classes/db.php');
include_once('classes/customers.php');
include_once('classes/mainController.php');
$pageIndexing =
    [
        'products' => 'products.php',
        'categories' => 'categories.php',
        'customers' => 'customers.php'
    ];
$db = new db('pdo', 'localhost', 'root', '');
$db->createConnection();
$customer = new customers('pdo', 'localhost', 'root', '');
$customer->createConnection();
//$customer->createUser(['name'=>'sohail','email'=>'sohail@devbunch.com','mobile'=>'3338448127','city'=>'pesahawer'])

//$db->showAll('customers');
//$db->Show('2');
//$db->namePrams('13','2');


?>