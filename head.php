<?php
/** require once main config file */
require_once 'config.php';

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

    case 'dashboard':
        include_once (BASE_DIR__CONTROLLER . '/dashboard.php');
        $controller=new dashboardController();
        $controller->runAction($action);
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
