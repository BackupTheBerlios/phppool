<?php
include 'Zend.php';
include '../app/models/Uzytkownicy.php';

function __autoload($class)
{
    Zend::loadClass($class);
}

Zend::loadClass('Zend_Filter_Input');

Zend::register('post', new Zend_Filter_Input($_POST));



$params = array ('host'     => 'localhost',
                 'username' => 'root',
                 'password' => '',
                 'dbname'   => 'projekt5');

$db = Zend_Db::factory('PDO_MYSQL', $params);
Zend_Db_Table::setDefaultAdapter($db);
Zend::register('db', $db);

$controller = Zend_Controller_Front::getInstance();
$controller->setControllerDirectory('../app/controllers');
//$controller->registerPlugin(new Hamster_Controller_Plugin_First());


$user =  Hamster_Auth::getInstance();
Zend::register('user', $user);



$controller->dispatch();








?>
