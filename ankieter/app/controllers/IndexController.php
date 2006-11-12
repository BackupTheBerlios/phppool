<?php
 
class IndexController extends Hamster_Controller_Action 
{
    /**
     * Domyślna akcja dla:	http://
     * lub:                 http://index/
     * lub:                 http://index/index	
     */
    public function indexAction()
    {   
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
  			$this->_forward('ankieter','/index');
  		}else{
  			$this->display();
  		}
  		
  	}
  	public function logoutAction()
  	{
  		$user = Zend::registry('user');
  		$user->logout();
  		$this->display();
  	}
  	public function unauthorizedAction()
  	{
  		echo 'nie masz dostępu do tej akcji';
  	}
}
?>