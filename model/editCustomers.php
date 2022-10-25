<?php
$path = str_replace('\model', '', __DIR__);
include_once($path . '\config.php');
$id = $_GET['id'];
$customers = new customers('pdo', 'localhost', 'root', '');
$customers->createConnection();

if (isset($_POST['update'])) {
    $customers->updateUser(['name' => $_POST['name'], 'email' => $_POST['email'], 'mobile' => $_POST['mobile'], 'city' => $_POST['city'], 'country' => $_POST['country'], 'state' => $_POST['state'], 'zipcode' => $_POST['zipcode'], 'created_at' => $_POST['created_at'], 'status' => $_POST['status']], $_POST['id']);
}
$url = $_SERVER['HTTP_REFERER'];
header('location:' . $url);

