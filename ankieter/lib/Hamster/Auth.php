<?php
/**
 * Autoryzacja użytkownika
 * 
 *
 * @category	Hamster
 * @package		Hamster_Auth
 * @copyright	Hubert Marzec 2006
 * @license    
 */
class Hamster_Auth{
	/**
	 * Przechowuje obiekt reprezentujacy uzytkownika
	 * 
	 * @var obj obietk klasy Hamser_Auth_User
	 */
	private $user;
	private static $instance = null;
	private $acl = null;
	private $groups = array(0 => 'guest', 1 => 'administrator', 2=> 'ankieter');
	/**
	 * Jeśli trzeba tworzy nowy obiekt klasy Hamster_Auth_User, uruchamia metode init()
	 */
	private function __construct()
	{
		session_start();
		if(empty($_SESSION['user'])){
			$this->user = new Hamster_Auth_User;	
		} else {
			$this->user = $_SESSION['user'];
		}
		
		$this->init();
	}
	public static function getInstance(){
		if (self::$instance == false) {
			self::$instance = new Hamster_Auth();
		}	
		return self::$instance;
		
	}
	/**
	 * Tworzy ARO i ACO
	 */
	public function init()
	{
		$acl = new Zend_Acl();  
 
		$aro = $acl->aroRegistry();  
 
		$aro->add('guest');  
		$aro->add('ankieter', $aro->guest);  
		$aro->add('administrator');  

		// Zabieramy prawa, a potem jak trzeba, przyznajemy je.
		$acl->deny();  
 
		// gość
		$acl->index->allow($aro->guest);  
		$acl->ankieta->allow($aro->guest);   
 
		// ankieter  
		$acl->ankieter->allow($aro->ankieter);
		$acl->raport->allow($aro->ankieter);
		$acl->ankieta->allow($aro->ankieter);      
 
		// admin
		$acl->allow($aro->administrator); 
		$this->acl = $acl;
	}
	public function login($login, $pass)
	{
		$this->user->login($login, $pass);
		$_SESSION['user'] = $this->user;
	}
	/**
	 * Przyznaje dostęp do danego kontrolera i akcji
	 * 
	 * @param string $controller nazwa kontrolera
	 * @param string $action nazwa akcji
	 * @return boolean 
	 */
	public function getPermission($controller, $action)
	{
		
		if ($this->acl->valid($this->groups[$this->user->getGroup()], $action, $controller)) {
			return true;	
		} else {
			return false;
		}	
	}
	public function logout()
	{
		return $this->user->logout();
		$_SESSION['user']=dupa;
		session_destroy();
	}
	public function getUserId()
	{
		return $this->user->userId;
	}
	public function getLogin()
	{
		return $this->user->login;
	}
	public function getGroup(){
		return $this->user->userGroup;
	}
}
	


?>