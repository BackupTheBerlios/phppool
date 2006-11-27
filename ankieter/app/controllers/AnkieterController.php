<?php
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
    /**
     * Wy�wietla pytania nale��ce do danej ankiety, 
     * umo�liwia dodanie nowych pyta�
     */
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
    /**
     * Usuw� dan� ankiet�
     */
    public function usunAction()
    {   
		$post = new Zend_Filter_Input($_POST);
		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$where = $db->quoteInto('id_ankieta = ?', $post->getInt('ankieta_id'));
		$rows_affected = $poll->delete($where);
		$this->_redirect('/ankieter');	
    }
    /**
     * Tworzy now� ankiet� i przekierowuje do akcji edytujAction
     */
    public function nowaAction()
    {   
       	$post = new Zend_Filter_Input($_POST);
       	$user = Zend::registry('user');
		$poll = new Ankiety;
		$data = array(
    		'nazwa' => $post->getRaw('ankieta_nazwa'),
    		'opis' => $post->getRaw('ankieta_opis'),
		);
		try {
			$id = $poll->insert($data);
			$this->_forward('ankieter','edytuj', array('ankieta'=>$id));
		} catch (Hamster_Validation_Exception $e){
			
			$this->_forward('ankieter','index', array('validationError'=>$e->getMessage()));
		}
    }
    /**
     * Dodaje pytanie do danej ankiety
     */
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
     * Usuwa pytanie z danej ankiety
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
    /**
     * Wy�wietla warianty odpowiedzi do danego pytania
     */
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
    /**
     * Dodaje wariant odpowiedzi do danego pytania
     */
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
			//TODO inaczej obsłużyć błąd
			$this->_forward('ankieter','index', array('validationError'=>$e->getMessage()));
		}
    }
    /**
     * Usuwa wariant odpowiedzi
     */
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
  		$obj = new Hamster_JQuery_Sortables;
		$obj->setHash($post->getRaw('hash'));
  		$list = $obj->getSortArray();

  		$question = new Pytania;
    	$ranking = 1;
    	
    	if(isset($list)){
    		foreach($list as $question_id) {
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
  		$obj = new Hamster_JQuery_Sortables;
		$obj->setHash($post->getRaw('hash'));
  		$list = $obj->getSortArray();
  			
  		$variants = new WariantyOdpowiedzi;
  		$ranking = 1;
  		
  		if(isset($list)){
    		foreach($list as $answer_id) {
    			$row = $variants->find($answer_id);
    			$row->kolejnosc = $ranking;
    			$row->save();
    			$ranking++;
    			
    		}
    	}
  	}
  	
}
?>