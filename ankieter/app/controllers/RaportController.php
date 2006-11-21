<?php
include '../app/models/Ankiety.php';
include '../app/models/Pytania.php';
include '../app/models/Raporty.php';


class RaportController extends Hamster_Controller_Action 
{
    /**
     * Domyślna akcja dla:	http://raport
     * lub:                 http://raport/index/ 			
     */
    public function indexAction()
    {        
		$polls = new Ankiety;
		$this->view->polls = $polls->fetchAll();
		
		$this->view->body = $this->view->render('/raport/raportIndex.php');
		$this->display();
    }
    /**
     * Akcja dla	:http://raport/graficzny
     * i			:http://raport/graficzny/ankieta/#id
     */
    public function graficznyAction()
    {   
    	
     	$this->view->body=$this->view->render('/raport/raportGraficzny.php');
        $this->display();
    }
    /**
     * Akcja dla	:http://raport/tabelaryczny
     * i			:http://raport/tabelaryczny/ankieta/#id
     */
    public function tabelarycznyAction()
    {   
		$post = new Zend_Filter_Input($_POST);

		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$pollId = $this->_getParam('ankieta');
		if (empty($pollId))$pollId = $post->getInt('ankieta_id');
		
		$pytanie=false;
		$queID=$this->_getParam('pytanie');
		if  (empty($queId)) $queId = $post->getInt('pytanie_id');
		if (!empty($queId)) {$this->view->queId=$queId; $pytanie=true;}
		
		$this->view->pollId = $pollId;
		$this->view->pool = $poll->find($pollId);
		$view->view->questions = array(); //
		
		$question = new Pytania();
		$this->view->questions = $question->findAllWithAnkietaId($pollId);
	
		$this->view->qV = array('jednokrotne'=>0, 'wielokrotne'=>1,'otwarte'=>2);
		
    	
    	$rap=new Raporty; 
    	$this->view->info=$rap->FindInformationsAboutAnkietaId($pollId);
    	$this->view->fill=$rap->AmountOfFilledId($pollId);
    	$this->view->ques=$rap->AmountOfQuestionsId($pollId);
    	$this->view->body=$this->view->render('/raport/raportTabelaryczny.php');
    	if ($pytanie) { 
    		$this->view->queInfo=$rap->InfoAboutQuestionId($queId);
    		$this->view->ansInfo=$rap->InfoAboutAnswersId($queId);
    		$this->view->body.=$this->view->render('/raport/raportTabelarycznyPytanie.php');
    	}
        $this->display();
    }
    
    
    /**
     * Tworzony jest w locie plik exela i wysyłany jest odpowiedni nagłówek (header)
     * do przeglądarki internetowej tak że pojawia się okienko dialogowe (ie,opera, itd)
     * z zapytaniem co chcemy zrobić danym plikiem (otworzyć, zapisać)
     * 
     * Akcja dla	:http://raport/export
     * i			:http://raport/export/ankieta/#id
     */
    public function exportAction()
    {   
         $this->display();
    }
}
?>