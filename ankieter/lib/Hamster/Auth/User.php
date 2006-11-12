<?php
/**
 * Autentykacja u�ytkownika
 * 
 * Je�li login i has�o si� zgadzaj�, do zmiennych lokalnych s� przypisane id
 * u�ytkownika i id grupy. Dla go�cia (niezalogowany) domy�lnie id=0 i grupa=0
 *
 * @category   Hamster
 * @package    Hamster_User
 * @copyright  Hubert Marzec 2006
 * @license    
 */
class Hamster_Auth_User{
	/**
	 * Id użytkownika, gość ma domylśnie id = 0;
	 * @var integer
	 */
	public $userId = 0;
	public $userGroup = 0;
	public $login = null;
	/**
	 * Przypisuje do zmiennych lokalnych id i grup użytkownika
	 * 
	 * @param $login login użytkowika
	 * @param $pass hasło użytkownika
	 */
	public function login($login, $pass)
	{
		$user = new Uzytkownicy;
		$result = $user->findOneWithLoginAndPass($login, $pass);
		if ($result->idUzytkownik != false) {
			$this->userId = $result->idUzytkownik;
			$this->userGroup = $result->grupa;
			$this->login = $result->login;
		} else {
			$this->userId = 0;
			$this->userGroup = 0;
		}
	}
	/**
	 * Wylogowuje użytkownika
	 */
	public function logout()
	{
		$this->userId = 0;
		$this->userGroup = 0;
		$this->login = null;
	}
	public function getId()
    {
        return $this->userId;
    }
    public function getGroup()
    {
    	return $this->userGroup;
    }
}
?>
