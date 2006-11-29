<?php
class Raporty {
	public $db;
	public function __construct() {
		$this->db=Zend::registry('db');
	}
	public function FindQuestionsWithAnkietaId($id) {

		$select=$this->db->select();
		$select->from('pytania','id_pytanie, pytanie, kolejnosc');
		$select->where('id_ankieta=?',$id);
		$select->order('kolejnosc');
		$sql=$select->__toString();
		//$query="Select pytanie from pytania";
		return $this->db->fetchAssoc($sql);
	}
	public function FindInformationsAboutAnkietaId($id) {
		$sql="Select nazwa, opis, login, status, datediff(data_zakonczenia, data_rozpoczecia) as czas, data_zakonczenia as data ".
			 "from ankiety a, uzytkownicy u ".
			 "where u.id_uzytkownik=a.id_uzytkownik and id_ankieta=:id_ankieta";
		return $this->db->fetchRow($sql,array('id_ankieta'=>$id));
	}
	public function AmountOfFilledId($id) {
		$sql="Select count(*) fill ".
			 "from wypelnione_ankiety ".
			 "where id_ankieta=:id_ankieta";
		return $this->db->fetchRow($sql,array('id_ankieta'=>$id));
	}
	
	public function AmountOfQuestionsId($id) {
		$sql="	Select t.id_typ_odpowiedzi typ, IFNULL(p.ilosc, 0) ". 
			"	from typy_odpowiedzi as t Left Join ".
			"	(Select id_typ_odpowiedzi, count(*) ilosc ".
			"	from pytania ".
			"	where id_ankieta=:id_ankieta ".
			"	group by id_typ_odpowiedzi) as p ".
			"	on p.id_typ_odpowiedzi=t.id_typ_odpowiedzi";
		return $this->db->fetchPairs($sql,array('id_ankieta'=>$id));
	}
	public function InfoAboutQuestionId($id) {
		$sql="Select kolejnosc, pytanie, typ.nazwa nazwa_typu ".
			"from pytania, typy_odpowiedzi typ ".
			"where pytania.id_typ_odpowiedzi=typ.id_typ_odpowiedzi and id_pytanie=:id_pytanie ";
		return $this->db->fetchRow($sql,array('id_pytanie'=>$id));
	}
	
	public function InfoAboutAnswersId($id) {
		$sql="Select w.kolejnosc, w.opis, IFNULL(o.total,0) ilosc ".
			"From warianty_odpowiedzi As w Left Join ".
			"    (Select id_pytanie, odpowiedz, count(*) as total ".
			"     From odpowiedzi ".
			"     Where id_pytanie=:id_pytanie ".
			"     Group By odpowiedz) As o ".
			"On w.id_wariant_odpowiedzi = o.odpowiedz ".
			"where w.id_pytanie=:id_pytanie ".
			"order by w.kolejnosc ";
		return $this->db->fetchAssoc($sql,array('id_pytanie'=>$id));
	}
	public function AnswersOpened($id) {
		$sql="select odpowiedz from odpowiedzi ".
			"where id_pytanie=:id_pytanie";
		return $this->db->fetchCol($sql,array('id_pytanie'=>$id));
	}
	
	public function AmountOfRespondentsWhoAnsweredId($id) {
		$sql="select count(distinct id_wypelniona_ankieta) as ilResp from odpowiedzi ".
			"where id_pytanie=:id_pytanie";
		return $this->db->fetchRow($sql,array('id_pytanie'=>$id));	
	}
}

?>
