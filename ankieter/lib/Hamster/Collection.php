<?php
/**
 * Klasa kolekcja
 * 
 * Obiektowa wersja tablicy 
 * 
 *
 * @category	Hamster
 * @package		Hamster_Collection
 * @copyright	Hubert Marzec 2006
 * @license    
 */
 
class Hamster_Collection {
	/**
	 * Elementy kolekcji
	 * $var array
	 */
   	private $_members = array();    // elementy kolekcji
	
  	private $_onload;               // funkcja zwrotna

   	private $_isLoaded = false;     // flaga określająca, czy funkcja zwrotna
                                   // została już wywołana
	/**
	 * Dodaje obiekty do kolekcji
	 * 
	 * Można utworzyć podkalsy Collecion i przeciążenia metody addItem
	 * pozwala na wymuszenie typu składowanych obiektów
	 * 
	 * @return void
	 */
	public function addItem($obj, $key = null) 
   	{
      $this->_checkCallback();     

      if ($key) {
         if (isset($this->_members[$key])) {
            throw new KeyInUseException("Klucz \"$key\" jest już zajęty!");
         } else {
            $this->_members[$key] = $obj;
         }
      } else {
         $this->_members[] = $obj;
      }
   	}
	/**
	 * Usuwa obiekty z kolekcji
	 * 
	 * @return void
	 */
   	public function removeItem($key) 
   	{
      $this->_checkCallback();

      if (isset($this->_members[$key])) {
         unset($this->_members[$key]);
      } else {
         throw new KeyInvalidException("Błędny klucz \"$key\"!");
      }
   	}
	/**
	 * Zwraca obiekt o danych kluczu z kolekcji
	 * 
	 * @return object
	 */
	public function getItem($key) 
  	{
      $this->_checkCallback();

      if (isset($this->_members[$key])) {
         return $this->_members[$key];
      } else {
         throw new KeyInvalidException("Błędny klucz \"$key\"!");
      }
   	}
	/**
	 * Zwaca wszystkie klucze obiektów kolekci
	 * 
	 * @return array
	 */
   	public function keys() 
   	{
      $this->_checkCallback();
      return array_keys($this->_members);
   	}
	/**
	 * Zwraca ilość obiektó w kolekcji
	 * 
	 * @return int
	 */
   	public function length() 
   	{
      $this->_checkCallback();
      return sizeof($this->_members);
   	}
   	/**
   	 * Spradza czy obiekt o podanym kluczu istnieje
   	 * 
   	 * @return boolean
   	 */
   	public function exists($key) 
   	{
      $this->_checkCallback();
      return (isset($this->_members[$key]));
   	}
   	/**
   	 * Ta metoda pozwala na zdefiniowanie funkcji,
   	 * którą należy wywołać, aby wypełnić kolekcję (leniwa konkretyzacja)
   	 * Jedynym parametrem tej funkcji powinna być kolekcja do wypełnienia. 
   	 */
   	public function setLoadCallback($functionName, $objOrClass = null) 
   	{
      if ($objOrClass) {
         $callback = array($objOrClass, $functionName);
      } else {
         $callback = $functionName;
      }

      // sprawdzenie, czy funkcję zwrotną da się wywołać
      if (!is_callable($callback, false, $callableName)) {
         throw new Exception("Funkcja zwrotna $callableName nieprawidłowa!");
         return false;
      }
      $this->_onload = $callback;
   	}
   	/**
   	 * Sprawdzenie, czy funkcja zwrotna została zdefiniowana,
   	 * a jeśli tak, czy została już wywołana. Jeśli nie,
   	 * zostaje ona wywołana.
   	 */
   	private function _checkCallback() 
   	{
      if(isset($this->_onload) && !$this->_isLoaded) {
         $this->_isLoaded = true;
         call_user_func($this->_onload, $this);
      }
   	}
}
