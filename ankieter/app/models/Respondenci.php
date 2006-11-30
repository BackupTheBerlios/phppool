<?php
   /* klasa wyjatku ktora bede uzywal do 
    * wyswietlenia odpowiedniego komunikatu
    * o bledzie
    */	

class Respondenci_Exception extends Exception {
    /*
     * Standardowy komunikat po wystapieniu bledu.
     */  
	
	protected $message = "Wystapil blad typu Respondenci_Exception.";	
   
 				}

/* Klasa Respondenci w ktora dziedziczy po
 * Zend_Db_Table, nadpisuje niektore metody.
 */

class Respondenci extends Zend_Db_Table{
	protected $_primary = 'id_respondent';
	

/* Metoda sprawdzajac czy dany email jest 
 * wprowadzony poprwanie (jest poprawny).
 */
	public function testMail($email)
	{
          $atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';
	  $domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';
	  $regex = '^' . $atom . '+' . '(\.' . $atom . '+)*\@(' . $domain . '{1,63}\.)+' . $domain . '{2,63}$';
	  
	  if (eregi($regex, $email))
    		{
        		return true;
    		}
		return false;
	}

/* Metoda sprawdzajaca czy dany email przypadkiem
 * nie istnieje juz w bazie
 */
	public function emailExist($email)
	{
		$db = $this->getAdapter();
		$where = $db->quoteInto('e_mail = ?',$email);
		$row = $this->fetchRow($where);
			if($row->idRespondent == NULL) return true; 
			else return false;
	}
	
/* Nadpisana metoda insert() wyrzuca bledy
 * gdy email jest NULL, jest juz taki email
 * w bazie, lub email jest zle wpisany
 */
	public function insert(&$data)
    {
	
     	if (empty($data['e_mail'])) {
       		throw new Respondenci_Exception('Podaj adres e-mail.');
       			}
		else if (!$this->testMail($data['e_mail'])){
        		throw new Respondenci_Exception('Nieprawidlowy adres! 								Przyklad prawidlowego adresu: eS.Ka2002@interia.pl ');
  					     } 	
			else if (!$this->emailExist($data['e_mail'])){
				throw new Respondenci_Exception('Podany adres e-mail istnieje 							juz w bazie danych.');
									}		
		         
        return parent::insert($data);
    } 

/* Nadpisana metoda delete() wyrzuca bledy
 * gdy nie ma danego emaila w bazie lub
 * gdy wpisany email jest NULL
 */
    public function delete($what)
    {
		$db = $this->getAdapter();

		$where = $db->quoteInto('e_mail = ?', $what);	
     	if ($this->emailExist($what)){
			throw new Respondenci_Exception('Podany adres e-mail nie istnieje  w bazie danych.');
     	}
									
		return parent::delete($where);
    } 

}

?>