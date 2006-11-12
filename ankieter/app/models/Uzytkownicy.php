<?php
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
	

}
?>