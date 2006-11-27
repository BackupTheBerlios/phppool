<?php
/**
 * Autoryzacja u�ytkownika
 * 
 * W zele�no�ci od grupy do jakiej nale�y u�ytkowik, nadawane s� mu prawa dost�pu
 * do kontroler�w i akcji
 *
 * @category	Hamster
 * @package		Hamster_Auth
 * @copyright	Hubert Marzec 2006
 * @license    
 */
class Hamster_Auth{
	/**
	 * Przechowuje obiekt reprezentujacy u�ytkownika
	 * 
	 * @var obj obietk kalsy Hamser_Auth_User
	 */
	private $user;
	/**
	 * Z�o�ona tablica przechowuj�ca informacje o prawach dost�pu
	 * danych grup do kontroler�w i akcji
	 * 
	 * Postaci:
	 * [id grupy][nazwa kontrolera][nazwa akcji lub *], gdzie * oznacza wszyskie akcje kontrolera
	 * np.
	 * [2]['raport']['*'] - u�ytkownicy z grupy 2 maj� dost�p do wszystkich akcji kontorolera raport
	 * [1]['admin']['usunrespondenta']
	 * [1]['admin']['dodajrespondenta'] - u�ytkownicy z grupy 1 maj� dost�p do akcji 
	 * dodajrespondenta, usun respondenta
	 * 
	 * @var	array
	 */
	private $permission = array();
	private static $instance=null;
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
	 * Tworzy zasady praw dostępu
	 * 
	 * @todo dodać możliwość dynamicznego pobierania konfiguracji z pliku xml lub z Zend_Config
	 * @todo zmienić forme zapisu przydziału praw, coś ala Zend_Acl
	 */
	public function init(array $config=NULL)
	{
		if ($config == NULL) {
			//przypisywanie uprawie� na sztywno do z�o ;)
			$permission =  array();
			$permission[2]['ankieter']['*'] = 1;
			$permission[2]['index']['*'] = 1;
			$permission[2]['raport']['*'] = 1;
			$permission[2]['ankieta']['pokaz'] = 1;
			
			$permission[1]['index']['*'] = 1;
			$permission[1]['admin']['*'] = 1;
			$permission[1]['respondenci']['*'] = 1;
			
			$permission[0]['ankieta']['*'] = 1;
			$permission[0]['admin']['dodajrespondent'] = 1;
			$permission[0]['admin']['usunrespondent'] = 1;
			$permission[0]['index']['*'] = 1;
			
			$this->permission = $permission;
		}
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
	 * @return boolean przyznaje dost�p lub nie
	 */
	public function getPermission($controller, $action)
	{
		if (array_key_exists($controller, $this->permission[$this->user->getGroup()])) {
			if (array_key_exists('*', $this->permission[$this->user->getGroup()][$controller])) {
				return true;
			} else if (array_key_exists($action, $this->permission[$this->user->getGroup()][$controller])) {
				return true;
			} else {
				return false;
			}
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