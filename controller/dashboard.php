<?php
$path = str_replace('\controller', '', __DIR__);
include_once($path . '/head.php');
include_once ($path .'/config.php');

class dashboardController extends  mainController
{

 function ShowDashboard()
 {
 include_once (BASE_DIR .'/dashboard.php');
 }


}

