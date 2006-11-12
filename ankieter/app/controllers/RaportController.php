<?php
include '../app/models/Ankiety.php';
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
       
        $this->display();
    }
    /**
     * Akcja dla	:http://raport/tabelaryczny
     * i			:http://raport/tabelaryczny/ankieta/#id
     */
    public function tabelarycznyAction()
    {   
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