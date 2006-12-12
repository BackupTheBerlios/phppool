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
		
		$this->view->body = $this->view->render('/respondenci/respondenciIndex.php');
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
	$max_rozmiar = 1024*1024;
            try {
		if (is_uploaded_file($_FILES['Imail']['tmp_name'])) {
			if ($_FILES['Imail']['size'] > $max_rozmiar) {
				throw new Respondenci_Exception('Error! Rozmiar pliku jest za duzy!');
					} else {
	move_uploaded_file($_FILES['Imail']['tmp_name'],
	$_SERVER['DOCUMENT_ROOT'].'/'.$_FILES['Imail']['name']);

		$respondent = new Respondenci();
		$path = $_SERVER['DOCUMENT_ROOT'].'/'.$_FILES['Imail']['name'];
		$respondent->readFiles($path);
		$this->_redirect('/respondenci/'); 
					}
		} else {
		     throw new Respondenci_Exception('Podaj nazwe pliku textowego!');	
			}
		} catch(Respondenci_Exception $e){
	$this->_forward('respondenci','index',array('insertionError'=>$e->getMessage()));
						}
}

        function usunAction()
    {   
       
		$post = new Zend_Filter_Input($_POST);
		$respondent= new Respondenci();
		$db = $respondent->getAdapter();
		
		$params = $this->_action->getParams();
			if(isset($params['id'])) {
				$id = (int)$params['id'];
				$num = (int)$params['page'];
					$where = $db->quoteInto('id_respondent = ?', $id);
					$respondent->delete($where);
			
		$this->_forward('respondenci','edytuj',array('page'=>$num));
						}
			else {
		$what = trim($post->noTags('Umail'));
		$where = $db->quoteInto('e_mail = ?', $what);

		   try{		
				if (empty($what)) {
       				throw new Respondenci_Exception('Podaj adres e-mail.');
       						}
				
				$respondent->delete($where);
				$this->_redirect('/respondenci/');
				
			} catch(Respondenci_Exception $e){
	
	$this->_forward('respondenci','index',array('insertionError'=>$e->getMessage()));
			
							}		
				}
	}

	function edytujAction()
	{
		$respondent = new Respondenci();
		$db = $respondent->getAdapter();
		$where = $db->quoteInto('id_respondent <> ?', 'NULL' );
		$order = 'e_mail';
		$rowset = $respondent->fetchAll($where, $order);
		$num_rows = $rowset->count();
		$params = $this->_action->getParams();
		$limit = 20;
		
		$subpage = ceil($num_rows/$limit);
		
		$offset = ((int)$params['page'] - 1) * $limit;		

		$rowset = $respondent->fetchAll($where, $order, $limit, $offset);
		
		$this->view->page = (int)$params['page']; 
		$this->view->offset = $offset;
		$this->view->subpage = $subpage;
		$this->view->respondent = $rowset;
		$this->view->body = $this->view->render('/respondenci/respondenciEdytuj.php');
		$this->display();
	}

	function usunhashAction()
	{
		$respondent = new Respondenci();		
		$db = $respondent->getAdapter();
		
		$params = $this->_action->getParams();
		$hashEmail = $params['hash']; 
	
		$query = $db->quoteInto('md5(e_mail) = ?', $hashEmail);
		try{
			$respondent->delete($query);
		}catch(Respondenci_Exception $e){;}
		
		$this->_redirect('/index/usunietymail');
	}

}
?>