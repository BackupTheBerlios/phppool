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
       	
       	$post = new Zend_Filter_Input($_POST);
       	$poll = new Uzytkownicy();
		$data = array(
    		'login' => $post->getRaw('ankieter_login'),
   			'haslo' => $post->getRaw('ankieter_haslo'),
   			'grupa' => 2
   			
		);
		try {
			$id = $poll->insert($data);
			$this->_forward('admin','index');
		} catch (User_Validation_Exception $e){
			$this->_forward('admin','index', array('validationError'=>$e->getMessage()));
		}
    }
    /**
     * Akcja odpowiedzialna za usuniecie konta ankietera
     */
    public function usunAction()
    {   
		$post = new Zend_Filter_Input($_POST);
		$poll = new Uzytkownicy;
		$db = $poll->getAdapter();
		$what = trim($post->noTags('ankieter_id'));
		$where = $db->quoteInto('login = ?', $what);
		$rows_affected = $poll->delete($where);
		
		$this->_redirect('/admin');
		
    }
    
    
    
    
}
?>