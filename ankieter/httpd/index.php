<?php
/**
 * Bootstrap file
 */


error_reporting(E_ALL|E_STRICT);
function __autoload($class)
{
    Zend::loadClass($class);
}

set_include_path(
    '../lib'
	. PATH_SEPARATOR . '../app/models'
);

include 'Zend.php';

$params = array ('host'     => 'localhost',
                 'username' => 'root',
                 'password' => '',
                 'dbname'   => 'projekt5');

$db = Zend_Db::factory('PDO_MYSQL', $params);
Zend_Db_Table::setDefaultAdapter($db);
Zend::register('db', $db);
$db->query("Set names utf8");

$controller = Zend_Controller_Front::getInstance();
$controller->setControllerDirectory('../app/controllers');
//$controller->registerPlugin(new Hamster_Controller_Plugin_First());

$user =  Hamster_Auth::getInstance();
Zend::register('user', $user);

$controller->dispatch();









?>
