/* zerowanie tabel */
delete from uzytkownicy;
delete from respondenci;
delete from ankiety;
delete from pytania;
delete from typy_odpowiedzi;
delete from warianty_odpowiedzi;
delete from odpowiedzi;
delete from wypelnione_ankiety;

Alter table uzytkownicy auto_increment=0;
Alter table respondenci auto_increment=0;
Alter table ankiety auto_increment=0;
Alter table pytania auto_increment=0;
Alter table warianty_odpowiedzi auto_increment=0;
Alter table odpowiedzi auto_increment=0;
Alter table wypelnione_ankiety auto_increment=0;


/* dodawanie uzytkownikow */
insert into uzytkownicy(login, haslo, grupa)
	values('Rafal','ziucio',1);
insert into uzytkownicy(login, haslo, grupa)
	values('Hubert','chomik',1);
insert into uzytkownicy(login, haslo, grupa)
	values('Piot_ank','ppp',2);
insert into uzytkownicy(login, haslo, grupa)
	values('Agn_ank','aaa',2);

/* dodawanie respondentow */
insert into respondenci(e_mail)
	values('jacek@wp.pl');
insert into respondenci(e_mail)
	values('wladek@onet.pl');
insert into respondenci(e_mail)
	values('piotrek@vp.pl');
	
/* dodawanie ankiet */
insert into ankiety(id_uzytkownik, nazwa,opis, data_rozpoczecia, data_zakonczenia, status)
	values(1,'Wybory prezydenckie w Białymstoku','jakis tam opis','2006-10-30 20:10:34','2006-11-10 19:12:32','zakonczona');
/** @todo polaczenie statusu z data_rozp i data_zak */
insert into ankiety(id_uzytkownik, nazwa, data_rozpoczecia, data_zakonczenia, status)
	values(1,'Agresja w szkole',NOW(),Date_add(NOW(),interval 1 MONTH),'aktywna');
insert into ankiety(id_uzytkownik, nazwa, data_rozpoczecia, data_zakonczenia, status)
	values(1,'Ankieta jeszcze nieaktywna',Date_add(NOW(),interval 1 MONTH),Date_add(NOW(),interval 3 MONTH),'nieaktywna');

/* dodawanie typow odpowiedzi */
insert into typy_odpowiedzi values (1,'jednokrotne','jednokrotne odpowiedzi');
insert into typy_odpowiedzi values (2,'wielokrotne','wielokrotne odpowiedzi');
insert into typy_odpowiedzi values (3,'otwarte',' odpowiedz komentarz');

/* dodawanie pytan */
insert into pytania(id_typ_odpowiedzi, id_ankieta, kolejnosc, pytanie)
	values(2,1,1,'O którym z kandydatow na fotel prezydenta Białegostoku słyszałes(as)?');
insert into pytania(id_typ_odpowiedzi, id_ankieta, kolejnosc, pytanie)
	values(1,1,2,'Gdybys mial(a) mozliwosc na ktorego kandydata bys glosowal(a)?');
insert into pytania(id_typ_odpowiedzi, id_ankieta, kolejnosc, pytanie)
	values(3,1,3,'Napisz co slyszalas o kandydacie Krzysztofie Kononowiczu?');
	
	
/* dodawanie wariantow odpowiedzi */
insert into warianty_odpowiedzi(id_pytanie, kolejnosc, opis)
	values(1,1,'Marek Kozłowski'),(1,2,'Krzysztof Kononowicz'),(1,3,'Mikołaj Kopernik');
insert into warianty_odpowiedzi(id_pytanie, kolejnosc, opis)
	values(2,1,'Marek Kozłowski'),(2,2,'Krzysztof Kononowicz'),(2,3,'Mikołaj Kopernik'),(2,4,'Na siebie');

/* dodawanie wypelnionych ankiet */
insert into wypelnione_ankiety(id_ankieta) values(1),(1),(1),(1),(1);

/* dodawanie odpowiedzi */
insert into odpowiedzi(id_pytanie, id_wypelniona_ankieta, kolejnosc)
	values(1, 1, 1),(1, 1, 2);
insert into odpowiedzi(id_pytanie, id_wypelniona_ankieta, kolejnosc)
	values(1, 2, 2);
insert into odpowiedzi(id_pytanie, id_wypelniona_ankieta, kolejnosc)
	values(1, 3, 2);
	
insert into odpowiedzi(id_pytanie, id_wypelniona_ankieta, kolejnosc)
	values(2,1,4), (2,2,4), (2,3,2), (2,4,2), (2,5,2);

insert into odpowiedzi(id_pytanie, id_wypelniona_ankieta, odpowiedz)
	values(3, 1, 'Ze to fajny gosc jest'),(3,2,'Ze ma byc prezydentem Polski'),
		  (3, 3, 'Ze wyprowadzi Policje na ulice'),(3,4,'Nie wiele'),(3,5,'Nic nie slyszalem');	
	