<?php
include 'Zend.php';
include '../app/models/Article.php';
include '../app/models/Comments.php';

Zend::loadClass('Zend_Controller_Front');



function __autoload($class)
{
    Zend::loadClass($class);
}

$params = array ('host'     => 'localhost',
                 'username' => 'root',
                 'password' => '',
                 'dbname'   => 'data');

$db = Zend_Db::factory('PDO_MYSQL', $params);
Zend_Db_Table::setDefaultAdapter($db);
Zend::register('db', $db);

$view = new Zend_View;
$view->setScriptPath('../app/views');
Zend::register('view', $view);

$router = new Zend_Controller_RewriteRouter();
$router->addRoute('index', 'strona/:page', array('page' => 1, 'controller' => 'index', 'action' => 'index'));
$router->addRoute('archive', 'archiwum/:year/:month/:day/:title', array('year' => 2006, 'controller' => 'index', 'action' => 'archive'));

$controller = Zend_Controller_Front::getInstance();
$controller->setControllerDirectory('../app/controllers');

$controller->setRouter($router);

$controller->dispatch();
?>
