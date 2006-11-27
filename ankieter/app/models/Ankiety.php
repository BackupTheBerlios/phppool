<?php
class Hamster_Validation_Exception extends Exception{}

class Ankiety extends Zend_Db_Table{
	protected $_primary = 'id_ankieta';
	
	public function insert(&$data)
    {
        if (empty($data['nazwa'])) {
        	throw new Hamster_Validation_Exception('Podaj nazwę ankiety.');
        }
        
		if (strlen($data['nazwa'])<6) {
        	throw new Hamster_Validation_Exception('Nazwa ankiety musi miec conamniej 6 znaków.');
        }      
      
        return parent::insert($data);
        
    } 
}
?>
