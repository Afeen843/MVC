<?php
$path = str_replace('\controller', '', __DIR__);
include_once($path . '/head.php');
include_once ($path .'/config.php');


class contactController extends mainController
{
    function showCustomers()
    {
        include_once(BASE_DIR . '/showCustomers.php');
    }

    function addCustomers()
    {
        include_once(BASE_DIR . '/customers.php');
    }

  function editUser()
  {
      include_once(BASE_DIR . '/editCustomers.php');
  }

  function viewUser()
  {
   include_once(BASE_DIR . '/viewCustomers.php');

  }

}


?>