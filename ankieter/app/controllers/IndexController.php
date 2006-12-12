<?php
 include '../app/models/Ankiety.php';
include '../app/models/Pytania.php';
include '../app/models/WariantyOdpowiedzi.php';
class IndexController extends Hamster_Controller_Action 
{
    /**
     * Domyślna akcja dla:	http://
     * lub:                 http://index/
     * lub:                 http://index/index	
     */
    public function indexAction()
    {   
         $this->view->body = $this->view->render('/index/indexIndex.php');
         $this->display();
    }
    /**
     * Logowanie do systemu i przekierowanie do odpowiedniej podstrony
     */
  	public function loginAction()
  	{
  		//$filterPost = new Zend_Filter_Input($_POST);
  		
  		$user = Zend::registry('user');
  		
  		$user->login($_POST['input_login'], $_POST['input_haslo']);
  		
  		if($user->getGroup()==2){
  			$this->_redirect('/ankieter/index');
  		} else if($user->getGroup()==1){
  			$this->_redirect('/admin/index');
  			
  		}else {
  			$this->_redirect('/index/index');
  		}
  		
  	}
  	public function logoutAction()
  	{
  		$user = Zend::registry('user');
  		$user->logout();
  		$this->_redirect('/index/index');
  	}
  	public function unauthorizedAction()
  	{
  		$this->view->body = 'nie masz dostępu do tej akcji';
  		$this->display();
  	}
  	public function pokazAction()
  	{
  		$pool = new Ankiety;
  		$question = new Pytania;
  		$variants = new WariantyOdpowiedzi;
  		
  		$row = $pool->find($this->_getParam('ankieta'));
  		$this->view->pool = $row;
  		
  		
  		$this->view->body = $this->view->render('/ankieta/ankietaPokaz.php');
  		$this->display();
  	}
  	public function usunietymailAction()
  	{
  		$this->view->body = "Podany email został usuniety z bazy danych";
		$this->display();
  	}
  	public function mailAction()
  	{
  		$respondent = new Respondenci;
  		$post = new Zend_Filter_Input($_POST);
  		
  		if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
  			if ($post->getRaw('akcja')=='dodaj') {
				$data = array('e_mail' => $post->getRaw('email'));
  		   		try{
					$id = $respondent->insert($data);
				} catch (Respondenci_Exception $e){
					//dodaj obslugę błędów
				}
  			} else {
  				$db = $respondent->getAdapter();
  				$where = $db->quoteInto('e_mail = ?', $post->getRaw('email'));
  				try {
  					$respondent->delete($where);	
  				} catch (Respondenci_Exception $e){
					//dodaj obslugę błędów
				}
  				
  			}
  		}
  		$this->_redirect('/');
  	}
}
?>