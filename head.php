<?php
include_once('config.php');


/**
 * Constants
 */

const BASE_DIR = __DIR__;
const BASE_DIR__CONTROLLER = BASE_DIR . '/controller';
const BASE_DIR_Frontend = BASE_DIR . '/frontend';
const BASE_DIR_Database = BASE_DIR . '/Database';
const BASE_DIR_MODEL = BASE_DIR . '/model';

/**
 * URLS
 */

const BASE_URL = 'http://localhost/peakcok';

/**
 * Page Indexing
 */



$page = $_GET['page'] ?? '';
$action = $_GET['action'] ?? '';

switch ($page) {

    case 'customers':
        include_once(BASE_DIR__CONTROLLER . '/customers.php');
        $controller = new contactController();
        $controller->runAction($action);
        break;

    case 'categories':
        include_once(BASE_DIR__CONTROLLER . '/categories.php');
        break;

    case 'products':
        include_once(BASE_DIR__CONTROLLER . '/products.php');
        break;

}


if (count($pageIndexing) > 0) {
    foreach ($pageIndexing as $key => $pageIndexing) {
        if ($key == $page) {
            include_once(BASE_DIR__CONTROLLER . '/' . $pageIndexing);
        }
    }
}


?>
