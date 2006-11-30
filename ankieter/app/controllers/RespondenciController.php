<?php

require_once '../app/models/Respondenci.php';
Zend::loadClass('Zend_Filter_Input');

class RespondenciController extends Hamster_Controller_Action 
{

	function indexAction()
	{
		$respondent= new Respondenci();
		$this->view->insertionError = $this->_getParam('insertionError');
		$this->view->respondent = $respondent->fetchAll();
		
		$this->view->body = 			$this->view->render('/respondenci/respondenciIndex.php');
		$this->display();
	}

	function dodajAction()
	{	
		$post = new Zend_Filter_Input($_POST);
       		$respondent= new Respondenci();

		$another = trim($post->getRaw('email'));
		$data = array('e_mail' => $another);

  		    try{
				$id = $respondent->insert($data);
				$this->_redirect('/respondenci/');
				
			} catch(Respondenci_Exception $e){
	
	$this->_forward('respondenci','index',array('insertionError'=>$e->getMessage()));
			
							}	
	}

	
	function importAction()
	{	
	
		//import pliku;
														}


        function usunAction()
    {   
       
		$post = new Zend_Filter_Input($_POST);
		$respondent= new Respondenci();
		
		$what = trim($post->noTags('Umail'));

		try{
				$respondent->delete($what);
				$this->_redirect('/respondenci/');
				
			} catch(Respondenci_Exception $e){
	
	$this->_forward('respondenci','index',array('insertionError'=>$e->getMessage()));
			
							}		
	}

}
?>