<?php

class RespondenciController extends Hamster_Controller_Action 
{
    /**
     * Domyślna akcja dla:	http://respondenci
     * lub:                 http://respondenci/index/ 			
     */
    public function indexAction()
    {     
        $this->view->body = $this->view->render('/respondenci/respondenciIndex.php');
		$this->display();
    }
    /**
     * Dodaje nowy email to bazy danych
     * 
     * walidacja danych (może już taki email istniej) robisz w modelu
     * jak mail istnieje dajesz komunikat że istnieje
     */
    public function dodajAction()
    {   
       $this->display();
    }
    /**
     * Import adresów email z pliku txt
     * 
     * Powiedzmy że w pliku txt adresy email są rozdzielone przecinkami
     * Musisz odczytać plik, rozbić dane do tablicy - funkcja explode.
     * Potem po koleji wywołujesz metoe insert danego modelu (Respondenci)
     * Jeżeli dany email już jest w bazie nie wywalasz błędu tylko dalej
     * lecisz  i dodajesz emaile do bazy
     * 
     */
    public function importAction()
    {   
       
       $this->display();
    }
    /**
     * Usuwa dany email z bazy
     * 
     * walidacja w modelu - np. danego adresu może nie być i wywali się błąd
     */
    public function usunAction()
    {   
       $this->display();
    }
}
?>