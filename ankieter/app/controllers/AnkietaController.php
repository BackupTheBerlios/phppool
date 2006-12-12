<?php

class AnkietaController extends Hamster_Controller_Action 
{
    /**
     * Domyślna akcja dla:	http://
     * lub:                 http://ankieta/
     * lub:                 http://ankieta/index	
     */
    public function indexAction()
    {   
         
         $this->display();
    }
    /**
     * Wyświetlenie ankiety do wypełnienia
     */
  	public function pokazAction()
  	{
  		$pool = new Ankiety;
  		$question = new Pytania;
  		$answer = new Odpowiedzi;
  		$variants = new WariantyOdpowiedzi;
  		$filledPool = new WypelnioneAnkiety;
  		$db = $question->getAdapter();
  		
  		unset($_POST['send']);
  		
  		if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
  			$data = array(
  				'id_ankieta' => $this->_getParam('ankieta')
  			);
  			$idFilledPool = $filledPool->insert($data);
  			foreach ($_POST as $questionId=>$answerT){
  				if (is_array($answerT)){
  					foreach ($answerT as $answerId => $value) {
  						
  						$data = array(
  						'id_wypelniona_ankieta' => $idFilledPool,
  						'id_pytanie' => $questionId,
  						'odpowiedz' => $answerId,
  						);
  						$id = $answer->insert($data);
  					}
  				} else {
  					
  					$data = array(
  						'id_wypelniona_ankieta' => $idFilledPool,
  						'id_pytanie' => $questionId,
  						'odpowiedz' => $answerT,
  					);
  					$id = $answer->insert($data);
  				}
  				echo '<br>';
  			}
  			
  		}
  		
  		
  		
  		
  		$this->view->pool = $pool->find($this->_getParam('ankieta'));
  		$temp = $question->findAllWithAnkietaId($this->_getParam('ankieta'));
  		$var = array();
  		
  		
  		
  		foreach($temp as $row){
  			$where = $db->quoteInto('id_pytanie = ?', $row->idPytanie);
  			$order = 'kolejnosc';
  			$var[$row->idPytanie] = $variants->fetchAll($where,$order);
  		}
  		
  		
  		$this->view->questions = $temp;
  		$this->view->variants = $var;
  		$this->view->message = 'Dziękujemy za wypełnienie ankiety';
  		$this->display();
  	}
  	
}
?>