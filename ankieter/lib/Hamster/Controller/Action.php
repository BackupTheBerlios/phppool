<?php
abstract class Hamster_Controller_Action extends Zend_Controller_Action {
    protected $view;
    protected $layoutTemplate;
    protected $controllerName;
    /**
     *  Konstruktor tworzy obiekt klasy Zend_view, ustawia domyślny szablon 
     * 	korzystając z nazwy kontrolera.
     */
    public function __construct() 
    {
        $this->view = new Zend_View;
        $this->view->setScriptPath('../app/views');
		$name = get_class($this);
		$this->controllerName = strtolower(substr($name, 0, strlen($name)-10)); 
        $this->layoutTemplate = $this->controllerName.'.php';
    }
    public function noRouteAction() 
    {
        $this->_redirect('/');
    }
    /**
     * Jeżeli dana funkcja (akcja) nie zostaje odnaleziona jest łapana przez magiczną 
     * funkcję __call() W samym kontrolerze można ją nadpisać.
     */
	public function __call($metod,$param)
    {
        $this->_redirect('/'.$this->controllerName);
    }
    /**
     *  Wyświetla cały layout strony.
     */    
    protected function display() 
    {
        echo $this->view->render($this->layoutTemplate);
    }
}
?>