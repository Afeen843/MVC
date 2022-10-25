<?php
$path = str_replace('\model', '', __DIR__);
include_once($path . '\config.php');
$id = $_GET['id'];
$customers = new customers('pdo', 'localhost', 'root', '');
$customers->createConnection();
$customers->deleteUser($id);
$url = $_SERVER['HTTP_REFERER'];
header('location:' . $url);

