<?php
$path = str_replace('\model', '', __DIR__);
include_once($path . '\config.php');


if (isset($_POST['save'])) {
    $customer->createUser
    ([

        customerInterface::CUSTOMER_EMAIL => $_POST['email'],
        customerInterface::CUSTOMER_NAME => $_POST['name'],
        customerInterface::CUSTOMER_MOBILE => $_POST['mobile'],
        customerInterface::CUSTOMER_STATE => $_POST['state'],
        customerInterface::CUSTOMER_STATUS => $_POST['status'],
        customerInterface::CUSTOMER_CITY => $_POST['city'],
        customerInterface::CUSTOMERS_CUSTOMERS_GROUP => $_POST['customers_group']

    ]);


} else {
    $_SESSION['message'] = 'something went wronge';

}

$url = $_SERVER['HTTP_REFERER'];
header('location:' . $url);


?>
