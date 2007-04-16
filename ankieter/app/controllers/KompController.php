<?php
include '../app/models/Komputery.php';
class KompController extends Hamster_Controller_Action 
{
  
    public function indexAction()
    {     
        
       
		$kompy = new Komputery;
        //$soft= new Oprogramowanie;
      	$this->view->validationKompError = $this->_getParam('validationKompError');
       // $this->view->validationSoftError = $this->_getParam('validationSoftError');
		$this->view->komps = $kompy->fetchAll();
		//$this->view->softs = $soft->fetchAll();
        $this->view->body = $this->view->render('/komp/kompIndex.php');
		$this->display();
    }


   
   public function addKompAction()
    {   

       	$post = new Zend_Filter_Input($_POST);
       	$kompy = new Komputery();
		$data = array(
    		'nazwa' => $post->getRaw('komputer_nazwa'),
   			'numer_ip' => $post->getRaw('komputer_numer')
   		 	
   			
		);
		print_r($_POST);
		try {
			$id = $kompy->insert($data);
			$this->_forward('admin','index');
		} catch (Komp_Validation_Exception $e){
			$this->_forward('admin','index', array('validationKompError'=>$e->getMessage()));
		}
		print_r($_POST);
    }
       public function deleteKompAction()
    {   
		
		$post = new Zend_Filter_Input($_POST);
		$kompy = new Komputery;
		$db = $kompy->getAdapter();
		$where = $db->quoteInto('id_komputer = ?', $post->getRaw('komputer_id'));
		$rows_affected = $kompy->delete($where);
		$this->_forward('komp','index');
		
    }
  
     
}
?>