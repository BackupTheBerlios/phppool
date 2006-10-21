<?php
 
Zend::loadClass('Zend_Controller_Action');
Zend::loadClass('Zend_View');
 
class IndexController extends Zend_Controller_Action 
{
    public function indexAction()
    {
		 /* List the all. */
        
        $view = Zend::registry('view');
        
        echo $view->render('index.php');
    }
	public function dodajAction(){
		echo 'kupa';
	}
    public function noRouteAction()
    {
        $this->_redirect('/');
    }
}
?>