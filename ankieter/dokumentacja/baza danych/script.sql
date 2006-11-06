/*
Created		2006-10-27
Modified		2006-10-29
Project		
Model		
Company		
Author		
Version		
Database		mySQL 4.1 
*/








drop table IF EXISTS wypelnione_ankiety;
drop table IF EXISTS uzytkownicy;
drop table IF EXISTS odpowiedzi;
drop table IF EXISTS warianty_odpowiedzi;
drop table IF EXISTS typy_odpowiedzi;
drop table IF EXISTS pytania;
drop table IF EXISTS respondenci;
drop table IF EXISTS ankiety;




Create table ankiety (
	id_ankieta Mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	id_uzytkownik Smallint UNSIGNED NOT NULL,
	nazwa Varchar(200) CHARACTER SET latin2 NOT NULL,
	opis Text CHARACTER SET latin2,
	data_rozpoczecia Datetime NOT NULL,
	data_zakonczenia Datetime NOT NULL,
	status Enum('nieaktywna', 'aktywna','zakonczona') NOT NULL,
 Primary Key (id_ankieta)) ENGINE = MyISAM
AUTO_INCREMENT = 0;

Create table respondenci (
	id_respondent Mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
	e_mail Varchar(30) NOT NULL,
 Primary Key (id_respondent)) ENGINE = MyISAM
AUTO_INCREMENT = 0;

Create table pytania (
	id_pytanie Int UNSIGNED NOT NULL AUTO_INCREMENT,
	id_typ_odpowiedzi Tinyint UNSIGNED NOT NULL,
	id_ankieta Mediumint UNSIGNED NOT NULL,
	kolejnosc Smallint UNSIGNED NOT NULL,
	pytanie Text CHARACTER SET latin2 NOT NULL,
 Primary Key (id_pytanie)) ENGINE = MyISAM
AUTO_INCREMENT = 0;

Create table typy_odpowiedzi (
	id_typ_odpowiedzi Tinyint UNSIGNED NOT NULL,
	nazwa Varchar(50) NOT NULL,
	opis Varchar(250) CHARACTER SET latin2,
	UNIQUE (nazwa),
 Primary Key (id_typ_odpowiedzi)) ENGINE = MyISAM;

Create table warianty_odpowiedzi (
	id_wariant_odpowiedzi Int UNSIGNED NOT NULL AUTO_INCREMENT,
	id_pytanie Int UNSIGNED NOT NULL,
	kolejnosc Smallint UNSIGNED NOT NULL,
	opis Varchar(250) CHARACTER SET latin2 NOT NULL,
 Primary Key (id_wariant_odpowiedzi)) ENGINE = MyISAM
AUTO_INCREMENT = 0;

Create table odpowiedzi (
	id_odpowiedz Int UNSIGNED NOT NULL AUTO_INCREMENT,
	id_pytanie Int UNSIGNED NOT NULL,
	id_wypelniona_ankieta Int UNSIGNED NOT NULL,
	odpowiedz Varchar(250) CHARACTER SET latin2 NOT NULL,
	kolejnosc Smallint NOT NULL,
 Primary Key (id_odpowiedz)) ENGINE = MyISAM
AUTO_INCREMENT = 0;

Create table uzytkownicy (
	id_uzytkownik Smallint UNSIGNED NOT NULL AUTO_INCREMENT,
	login Varchar(10) NOT NULL,
	haslo Varchar(15) NOT NULL,
	grupa Tinyint NOT NULL,
	UNIQUE (login),
 Primary Key (id_uzytkownik)) ENGINE = MyISAM
AUTO_INCREMENT = 0;

Create table wypelnione_ankiety (
	id_wypelniona_ankieta Int UNSIGNED NOT NULL AUTO_INCREMENT,
	id_ankieta Mediumint UNSIGNED NOT NULL,
 Primary Key (id_wypelniona_ankieta)) ENGINE = MyISAM;












Alter table pytania add Foreign Key (id_ankieta) references ankiety (id_ankieta) on delete  restrict on update  restrict;
Alter table wypelnione_ankiety add Foreign Key (id_ankieta) references ankiety (id_ankieta) on delete  restrict on update  restrict;
Alter table warianty_odpowiedzi add Foreign Key (id_pytanie) references pytania (id_pytanie) on delete  restrict on update  restrict;
Alter table odpowiedzi add Foreign Key (id_pytanie) references pytania (id_pytanie) on delete  restrict on update  restrict;
Alter table pytania add Foreign Key (id_typ_odpowiedzi) references typy_odpowiedzi (id_typ_odpowiedzi) on delete  restrict on update  restrict;
Alter table ankiety add Foreign Key (id_uzytkownik) references uzytkownicy (id_uzytkownik) on delete  restrict on update  restrict;
Alter table odpowiedzi add Foreign Key (id_wypelniona_ankieta) references wypelnione_ankiety (id_wypelniona_ankieta) on delete  restrict on update  restrict;



/* Users permissions */




