<?php
include '../app/models/Uzytkownicy.php';
class AdminController extends Hamster_Controller_Action 
{
    /**
     * Jedyne co musisz tutaj zrobi� to wydoby� z bazy danych dane na temat istnij�cych kont
     * ankieter�w i wrzuci� je do <SELECT> w widoku, tak aby by�o wiadomo jakie konto skasowa�
     * 
     * Domy�lna akcja dla:	http://admin
     * lub:                 http://admin/index/ 			
     */
    public function indexAction()
    {     
        $poll = new Uzytkownicy;
       	$this->view->validationError = $this->_getParam('validationError');
		$this->view->poll = $poll->fetchAll();
        $this->view->body = $this->view->render('/admin/adminIndex.php');
		$this->display();
    }
    /**
     * Akcja odpowiedzialna za dodanie konta ankietera
     * 
     * walidacje danych, czy zakr�tiki login, czy login ju� istnieje itd.
     * zrobisz w modelu (nazwa modela to zapewne Uzytkownicy)
     */
    public function dodajAnkieteraAction()
    {   
       	$post = Zend::registry('post');
		$poll = new Uzytkownicy;
		
		$data = array(
    		'login' => $post->getRaw('ankieter_login'),
   			'haslo'  => $post->getRaw('ankieter_haslo'),
   			
		);
		try {
			$id = $poll->insert($data);
			$this->_forward('uzytkownicy','index');
		} catch (User_Validation_Exception $e){
			$this->_forward('uzytkownicy','index', array('validationError'=>$e->getMessage()));
		}
    }
    /**
     * Akcja odpowiedzialna za usuniecie konta ankietera
     */
    public function usunankieteraAction()
    {   
       $this->display();
    }
}
?>