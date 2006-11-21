<?php
include '../app/models/Ankiety.php';
include '../app/models/Pytania.php';
include '../app/models/WariantyOdpowiedzi.php';
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
		$post = new Zend_Filter_Input($_POST);
		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$poolId = $this->_getParam('ankieta');
		if(empty($poolId)){
			$poolId = $post->getInt('ankieta_id');
		}
		$this->view->poolId = $poolId;
		$this->view->pool = $poll->find($poolId);
		
		
		$question = new Pytania();
		$this->view->questions = $question->findAllWithAnkietaId($poolId);

		$this->view->questionsVariants = array('jednokrotne', 'wielokrotne','otwarte');
		
		$this->view->body = $this->view->render('/ankieter/ankieterEdytuj.php');
		$this->display();
    }
    public function usunAction()
    {   
		$post = new Zend_Filter_Input($_POST);
		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$where = $db->quoteInto('id_ankieta = ?', $post->getInt('ankieta_id'));

		$rows_affected = $poll->delete($where);
		
		$this->_redirect('/ankieter');
		
    }
    public function nowaAction()
    {   
       	$post = new Zend_Filter_Input($_POST);
       	$user = Zend::registry('user');
		$poll = new Ankiety;
		
		$data = array(
    		'nazwa' => $post->getRaw('ankieta_nazwa'),
   			'opis'  => $post->getRaw('ankieta_opis'),
   			'id_uzytkownik'  => $user->getUserId(),
		);
		try {
			$id = $poll->insert($data);
			$this->_forward('ankieter','edytuj', array('ankieta'=>$id));
		} catch (Hamster_Validation_Exception $e){
			$this->_forward('ankieter','index', array('validationError'=>$e->getMessage()));
		}
    }
    public function dodajpytanieAction()
    {
    	$post = new Zend_Filter_Input($_POST);
    	$question = new Pytania;
    	$db = $question->getAdapter();
    	
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
    public function odpowiedziAction()
    {
    	$pool = new Ankiety;
    	$question = new Pytania;
    	$variants = new WariantyOdpowiedzi;
    	$db = $question->getAdapter();
    	
    	$this->view->poolId = $this->_getParam('ankieta');
    	$this->view->questionId = $this->_getParam('pytanie');
    	
    	$this->view->questionsVariants = array('jednokrotne', 'wielokrotne','otwarte');
    	
		$this->view->pool = $pool->find($this->_getParam('ankieta'));
		$this->view->question = $question->find($this->_getParam('pytanie'));
		$where = $db->quoteInto('id_pytanie = ?', $this->_getParam('pytanie'));
		$order = 'kolejnosc';
		$this->view->variants = $variants->fetchAll($where,$order);
		
		
    	$this->view->body = $this->view->render('/ankieter/ankieterOdpowiedzi.php');
		$this->display();
    }
    public function dodajodpowiedzAction()
    {
    	$post = new Zend_Filter_Input($_POST);
    	$variants = new WariantyOdpowiedzi;
    	$db = $variants->getAdapter();
    	
    	$row = $db->fetchRow(
    	"SELECT MAX(kolejnosc) ostatni FROM warianty_odpowiedzi WHERE id_pytanie=:id_pytanie", 
    	array('id_pytanie'=>$this->_getParam('pytanie'))
    	);
    	
    	
    	$data = array(
   			'id_pytanie' => $this->_getParam('pytanie'),
   			'kolejnosc'  => ++$row['ostatni'],
   			'opis' => $post->getRaw('odpowiedz_tresc'),
		);
		try {
			$id = $variants->insert($data);
			$this->_forward('ankieter','odpowiedzi', array(	'ankieta'=>$this->_getParam('ankieta'), 
															'pytanie'=>$this->_getParam('pytanie')));
		} catch (Hamster_Validation_Exception $e){
			//TODO inaczej odsłużyć błąd, gdzie indziej przekazać.. może widok błędu...
			$this->_forward('ankieter','index', array('validationError'=>$e->getMessage()));
		}
    }
    public function usunodpowiedzAction()
    {
    	$variants = new WariantyOdpowiedzi;
    	$db = $variants->getAdapter();
    	
    	
    	$where = $db->quoteInto('id_wariant_odpowiedzi = ?', $this->_getParam('odpowiedz'));
    			

		$rows_affected = $variants->delete($where);
		$this->_forward('ankieter','odpowiedzi', array(	'ankieta'=>$this->_getParam('ankieta'), 
														'pytanie'=>$this->_getParam('pytanie')));
    }
   	/**
	 * Ustala nową kolejność pytań
	 */
    public function ajaxswapAction()
  	{
  		$post = new Zend_Filter_Input($_POST);
  		Zend_Log::registerLogger(new Zend_Log_Adapter_File('../logs/simple.txt'));
  		$temp = $post->getRaw('name');
  		
  		
  		$pos = stripos($temp, '=');
		$temp = substr($temp,++$pos);
  		$temp = explode("&sort1[]=", $temp);
  		
		
  		$question = new Pytania;
    	$ranking = 1;
    	
    	if(isset($temp)){
    		foreach($temp as $question_id) {
    			$row = $question->find($question_id);
    			$row->kolejnosc = $ranking;
    			$row->save();
    			$ranking++;
    			
    		}
    	}
    	
  	}
  	/**
	 * Ustala nową kolejność wariantów odpowiedzi
	 */
  	public function ajaxswapanswerAction()
  	{
  		$post = new Zend_Filter_Input($_POST);
  		Zend_Log::registerLogger(new Zend_Log_Adapter_File('../logs/simple.txt'));
  		$temp = $post->getRaw('name');
  	
  		$pos = stripos($temp, '=');
		$temp = substr($temp,++$pos);
  		$temp = explode("&sort2[]=", $temp);
  			
  		$variants = new WariantyOdpowiedzi;
  		$ranking = 1;
  		if(isset($temp)){
    		foreach($temp as $answer_id) {
    			$row = $variants->find($answer_id);
    			$row->kolejnosc = $ranking;
    			$row->save();
    			$ranking++;
    			
    		}
    	}
  	}
  	
}
?>