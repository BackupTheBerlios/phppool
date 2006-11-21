<?php
class User_Validation_Exception extends Exception{}
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
	
	public function insert($data)
    {
        if (empty($data['login'])) {
        	throw new User_Validation_Exception('Nie podales loginu.');
        }
        
		if (strlen($data['login'])<6) {
        	throw new User_Validation_Exception('Login musi skladac sie z co najmniej 5 znakow.');
        }   
        if (empty($data['haslo'])) {
        	throw new User_Validation_Exception('NIe podales hasla.');
        }
        
		if (strlen($data['haslo'])<6) {
        	throw new User_Validation_Exception('Haslo musi skladac sie z co najmniej 5 znakow.');
        }     
        return parent::insert($data);
    } 
}
?>