<?php

include 'raportLib/PlotQuestion.php';
include 'raportLib/konwersja.php';
include 'raportLib/tools.php';


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
    
    public function wyborWykresuAction() {
    		
    	$post = new Zend_Filter_Input($_POST);

		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$pollId = $this->_getParam('ankieta');
		if (empty($pollId))$pollId = $post->getInt('ankieta_id');
		
		
		$this->view->pollId = $pollId;
		$this->view->pool = $poll->find($pollId);
		//$view->view->questions = array(); //
		
		$question = new Pytania();
		$this->view->questions = $question->findAllWithAnkietaId($pollId);
	
		$this->view->qV = array('jednokrotne'=>0, 'wielokrotne'=>1,'otwarte'=>2);
		
		$this->view->body=$this->view->render('/raport/wyborWykresu.php');
        $this->display();
    	
    }
    
    /**
     * Akcja dla	:http://raport/graficzny
     * i			:http://raport/graficzny/ankieta/#id
     */
    public function graficznyAction()
    {   
		
		$post = new Zend_Filter_Input($_POST);

		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$pollId = $this->_getParam('ankieta');
		if (empty($pollId))$pollId = $post->getInt('ankieta_id');
		
		
		$this->view->pool = $poll->find($pollId);
		$questions = array(); //
		
		$question = new Pytania();
		$this->view->questions = $question->findAllWithAnkietaId($pollId);
	
		$qV = array('jednokrotne'=>0, 'wielokrotne'=>1,'otwarte'=>2);
		$roz= array(array(x=>400,y=>300), array(x=>640,y=>480), array(x=>800, y=>600), array(x=>1024, y=>768));
		$rozId=$post->getInt('roz_id');
		
    	
    	$rap=new Raporty; 
    	$info=$rap->FindInformationsAboutAnkietaId($pollId);
    	$fill=$rap->AmountOfFilledId($pollId);
    	$ques=$rap->AmountOfQuestionsId($pollId);

    	
    	$licznik=0;
    	$gTypes=array(array());
    	$wyjatki=array();
    	$selected=array();
    	foreach ($this->view->questions as $row) {
    		$queId=$row->idPytanie;	
    		$queInfo=$rap->InfoAboutQuestionId($queId);
    		
    		if ($queInfo["nazwa_typu"]!='otwarte') {
    			$ansInfoA=$rap->InfoAboutAnswersId($queId);
    			
    			$gTypes[$queId]=$post->getRaw("ID".$queId);
    			if (!empty($gTypes[$queId])) $selected[$licznik++]=$queInfo["kolejnosc"]; 

    			$this->view->wyjatki=array();
    			$dane=array();
    			
    			if ($queInfo["nazwa_typu"]=="jednokrotne") {
   					$ilosc=0;
   					foreach($ansInfoA as $kolejnosc => $ansInfo) $ilosc+=$ansInfo["ilosc"];
   				} else $ilosc=$fill["fill"];
   			
    			//foreach($ansInfoA as $kolejnosc => $ansInfo) $suma+=$ansInfo["ilosc"];
    			$suma=0;
    			foreach($ansInfoA as $kolejnosc => $ansInfo) {
   					$dane[$ansInfo['opis']]=($ilosc?($ansInfo["ilosc"]*100/$ilosc):0);
   					$suma+=$ansInfo["ilosc"];
    			}
    			
    			if (!empty($gTypes[$queId]) && in_array(0,$gTypes[$queId])) {
    				$p=new PlotQuestion($row->kolejnosc.". ".$row->pytanie,$dane,$queId,$roz[$rozId]["x"],$roz[$rozId]["y"],'barVPlot');
    				$p->generatePlot();
    			}
    			
    			if (!empty($gTypes[$queId]) && in_array(1,$gTypes[$queId])) {
    				$p=new PlotQuestion($row->kolejnosc.". ".$row->pytanie,$dane,$queId,$roz[$rozId]["x"],$roz[$rozId]["y"],'barHPlot');
    				$p->generatePlot();
    			}
    			
    			if (!empty($gTypes[$queId]) && in_array(2,$gTypes[$queId])) {
    				if ($suma==0) $wyjatki[$queId]=true;
    				if ($queInfo["nazwa_typu"]=="jednokrotne" && $suma>0) {
    					$p=new PlotQuestion($row->kolejnosc.". ".$row->pytanie,$dane,$queId,$roz[$rozId]["x"],$roz[$rozId]["y"],'piePlot');
    					$p->generatePlot();
    				}
    			}		
    		} else {
    			//Pytania otwarte
    			//$this->view->ansInfo=$rap->AnswersOpened($queId);
    			//$this->view->body.=$this->view->render('/raport/PytOtwarte.php');
    		}		
    	}

    	
    	$this->view->wyjatki=$wyjatki;
    	$this->view->gTypes=$gTypes;
    	$this->view->selected=$selected;
    	$this->view->pollId=$pollId;
     	$this->view->body=$this->view->render('/raport/raportGraficzny.php');
        $this->display();
    }
    
    
    /**
     * Akcja dla	:http://raport/tabelaryczny
     * i			:http://raport/tabelaryczny/ankieta/#id
     */
    public function tabelarycznyAction($excel=0, $id_ankieta=0)
    {   
    	$poll = new Ankiety;
		$db = $poll->getAdapter();
		
    	if (!$excel) {
			$post = new Zend_Filter_Input($_POST);

			$pollId = $this->_getParam('ankieta');
			if (empty($pollId))$pollId = $post->getInt('ankieta_id');
    	} else $pollId = $id_ankieta;
		/*
		$pytanie=false;
		$queId=$this->_getParam('pytanie');
		if  (empty($queId)) $queId = $post->getInt('pytanie_id');
		if (!empty($queId)) {$this->view->queId=$queId; $pytanie=true;}
		*/
		
		$this->view->pollId = $pollId;
		$this->view->pool = $poll->find($pollId);
		
		$question = new Pytania();
		$this->view->questions = $question->findAllWithAnkietaId($pollId);
	
		$this->view->qV = array('jednokrotne'=>0, 'wielokrotne'=>1,'otwarte'=>2);
		
    	
    	$rap=new Raporty; 
    	$this->view->info=$rap->FindInformationsAboutAnkietaId($pollId);
    	$this->view->fill=$rap->AmountOfFilledId($pollId);
    	$this->view->ques=$rap->AmountOfQuestionsId($pollId);

    	$this->view->body=$this->view->render('/raport/raportTabelaryczny.php');
    	/*if ($pytanie) { 
    		$this->view->queInfo=$rap->InfoAboutQuestionId($queId);
    		if ($this->view->queInfo["nazwa_typu"]!='otwarte') {
    			$this->view->ansInfo=$rap->InfoAboutAnswersId($queId);
    			$this->view->body.=$this->view->render('/raport/PytZamkniete.php');
    		} else {
    			$this->view->ansInfo=$rap->AnswersOpened($queId);
    			$this->view->body.=$this->view->render('/raport/PytOtwarte.php');
    		}
    			
    	}
    	*/
    	foreach ($this->view->questions as $row) {
    		$queId=$row->idPytanie;
    			
    		$this->view->queInfo=$rap->InfoAboutQuestionId($queId);
    		if ($this->view->queInfo["nazwa_typu"]!='otwarte') {
    			$this->view->ansInfo=$rap->InfoAboutAnswersId($queId);
    			$ilResp=$rap->AmountOfRespondentsWhoAnsweredId($queId);
    			$this->view->ilResp=$ilResp["ilresp"];
    			$this->view->body.=$this->view->render('/raport/PytZamkniete.php');
    		} else {
    			$this->view->ansInfo=$rap->AnswersOpened($queId);
    			$this->view->queId=$queId;
    			$this->view->excel=$excel;
    			$this->view->limit=2; //tu decydujemy ile ma sie wyswietalc odpowiedzi otwartych
    			$this->view->body.=$this->view->render('/raport/PytOtwarte.php');
    			SaveToFile("/documents/raporty/OA_$queId.txt", $this->view->ansInfo);
    		}		
    	}
    	if (!$excel)
        	$this->display();
        else return $this->view->body; 
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
    	
		$post = new Zend_Filter_Input($_POST);

		$poll = new Ankiety;
		$db = $poll->getAdapter();
		$pollId = $this->_getParam('ankieta');
		if (empty($pollId))$pollId = $post->getInt('ankieta_id');
		
    	header("Content-Type: application/vnd.ms-excel");
  		header("Content-Disposition: attachment; filename=ank_$pollId.xls");
  		header("Pragma: no-cache");
  		header("Expires: 0");
  		
		
  		echo $this->view->render('/raport/raportExport.php');
    	echo plCharset($this->tabelarycznyAction($excel=1, $id_ankieta=$pollId), UTF8_TO_ISO88592);
    }
}
?>