<?php
include '../app/models/Ankiety.php';
include '../app/models/Pytania.php';
class AnkieterController extends Hamster_Controller_Action 
{
    /**
     * Domyślna akcja dla:	http://ankieter
     * lub:                 http://ankieter/index/ 			
     */
    public function indexAction()
    {     
        $poll = new Ankiety;
        
       	$this->view->validationError = $this->_getParam('validationError');
        
		$this->view->poll = $poll->fetchAll();
        $this->view->body = $this->view->render('/ankieter/ankieterIndex.php');
		$this->display();
    }
    public function edytujAction()
    {   
		$post = Zend::registry('post');
		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$pollId = $this->_getParam('ankieta');
		if(empty($pollId)){
			$pollId = $post->getInt('ankieta_id');
		}
		$this->view->pollId = $pollId;
		$this->view->pool = $poll->find($pollId);
		$view->view->questions = array();
		
		$question = new Pytania();
		$this->view->questions = $question->findAllWithAnkietaId($pollId);
		
		
		$this->view->questionsVariants = array('jednokrotne', 'wielokrotne','otwarte');
		
		$this->view->body = $this->view->render('/ankieter/ankieterEdytuj.php');
		$this->display();
    }
    public function usunAction()
    {   
		$post = Zend::registry('post');
		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$where = $db->quoteInto('id_ankieta = ?', $post->getInt('ankieta_id'));

		$rows_affected = $poll->delete($where);
		
		$this->_redirect('/ankieter');
		
    }
    public function nowaAction()
    {   
       	$post = Zend::registry('post');
       	$user = Zend::registry('user');
		$poll = new Ankiety;
		
		$data = array(
    		'nazwa' => $post->getRaw('ankieta_nazwa'),
   			'opis'  => $post->getRaw('ankieta_opis'),
   			'id_uzytkownik'  => $user->getUserId(),
		);
		try {
			$id = $poll->insert($data);
			$this->_forward('ankieter','edytuj');
		} catch (Hamster_Validation_Exception $e){
			$this->_forward('ankieter','index', array('validationError'=>$e->getMessage()));
		}
    }
    public function dodajpytanieAction()
    {
    	$post = Zend::registry('post');
    	$question = new Pytania;
    	$db = $question->getAdapter();
    	//najpierw potrzebujemy ostatnią kolejność
    	
    	$row = $db->fetchRow(
    	"SELECT MAX(kolejnosc) ostatni FROM pytania WHERE id_ankieta=:id_ankieta", 
    	array('id_ankieta'=>$this->_getParam('ankieta'))
    	);
    	
    	$data = array(
    		'id_typ_odpowiedzi' => $post->getRaw('pytanie_typ'),
   			'id_ankieta'  => $this->_getParam('ankieta'),
   			'kolejnosc'  => ++$row['ostatni'],
   			'pytanie' => $post->getRaw('pytanie_tresc')
		);
		try{
			$id = $question->insert($data);	
			$this->_forward('ankieter','edytuj', array('ankieta'=>$this->_getParam('ankieta')));
		} catch (Hamster_Validation_Exception $e){
			echo $e->getMessage();
		}
    		
    }
    /**
     * http://127.0.0.1/ankieter/usunpytanie/ankieta/1/pytanie/7
     */
    public function usunpytanieAction()
    {
    	$question = new Pytania;
    	$db = $question->getAdapter();
    	
    	
    	$where = $db->quoteInto('id_ankieta = ?', $this->_getParam('ankieta'))
    			.$db->quoteInto(' AND id_pytanie = ?', $this->_getParam('pytanie'));

		$rows_affected = $question->delete($where);
		$this->_forward('ankieter','edytuj', array('ankieta'=>$this->_getParam('ankieta')));
    }
    
    
}
?>