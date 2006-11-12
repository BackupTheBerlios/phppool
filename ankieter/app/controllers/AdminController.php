<?php

class AdminController extends Hamster_Controller_Action 
{
    /**
     * Jedyne co musisz tutaj zrobić to wydobyć z bazy danych dane na temat istnijących kont
     * ankieterów i wrzucić je do <SELECT> w widoku, tak aby było wiadomo jakie konto skasować
     * 
     * Domyślna akcja dla:	http://admin
     * lub:                 http://admin/index/ 			
     */
    public function indexAction()
    {     
        $this->view->body = $this->view->render('/admin/adminIndex.php');
		$this->display();
    }
    /**
     * Akcja odpowiedzialna za dodanie konta ankietera
     * 
     * walidacje danych, czy zakrótiki login, czy login już istnieje itd.
     * zrobisz w modelu (nazwa modela to zapewne Uzytkownicy)
     */
    public function dodajankieteraAction()
    {   
       $this->display();
    }
    /**
     * Akcja odpowiedzialna za usuniecie konta ankietera
     */
    public function usunankieteraAction()
    {   
       $this->display();
    }
}
?>