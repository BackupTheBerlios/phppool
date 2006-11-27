<?php
class User_Validation_Exception extends Exception{}
class Users_Exception extends Exception {
    /*
     * Standardowy komunikat po wystapieniu bledu.
     */  
	
	protected $message = "Wystapil blad typu Users_Exception.";	
   
}
class Uzytkownicy extends Zend_Db_Table
{
	protected $_primary = 'id_uzytkownik';
	public function findOneWithLoginAndPass($login, $pass)
	{
		$db = $this->getAdapter();
		$where = $db->quoteInto("login = ?", $login);
        $where.= $db->quoteInto("AND haslo = ?", $pass);
        return $this->fetchrow($where);
	}

	/*
	 * Funkcja sprawdza czy dany login istnieje juz w bazie danych
	 */
	public function ifLogin($login)
	{
		$db = $this->getAdapter();
		$where = $db->quoteInto('login = ?',$login);
		//$where = $db->quoteInto('id_uzytkownik = ?', $login);
		$row = $this->fetchRow($where);
			if($row->idUzytkownik == NULL) 
			return true; 
				else 
					return false;
	}
	/*
	 * Funkcja kontroluje poprawnosc danych podczas
	 * zakladania konta uzytkownika
	 */
	public function insert(&$data)

    {
		if (!$this->ifLogin($data['login'])){
			throw new User_Validation_Exception('Podany login istnieje juz w bazie danych! Wybierz inny.');
		}
    
     	if (empty($data['login']) && empty($data['haslo'])) {
        	throw new User_Validation_Exception('Nie podales loginu ani hasla!');
        }
     	
        if (empty($data['login'])) {
        	throw new User_Validation_Exception('Nie podales loginu!');
        } 
        
		if (strlen($data['login'])<5) {
        	throw new User_Validation_Exception('Login musi skladac sie z co najmniej 5 znakow!');
        }   
        if (empty($data['haslo'])) {
        	throw new User_Validation_Exception('Nie podales hasla!');
        }
        
		if (strlen($data['haslo'])<5) {
        	throw new User_Validation_Exception('Haslo musi skladac sie z co najmniej 5 znakow!');
        }
        if (!eregi('^[a-zA-z]',$data['login'])) {
        	throw new User_Validation_Exception('Login musi zaczynac sie od litery!');
        }
              
        return parent::insert($data);
    }

    /*
     * Funkacja nadpisuje metode delete
     */
    
 
     

}
?>