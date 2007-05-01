/*
Created		2007-03-12
Modified		2007-03-12
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/







drop table IF EXISTS oprogramowanie_temp;
drop table IF EXISTS komp_opr;
drop table IF EXISTS oprogramowanie;
drop table IF EXISTS komputery;




Create table komputery (
	id_komputer Smallint NOT NULL AUTO_INCREMENT,
	nazwa Varchar(20) NOT NULL,
	numer_ip Varchar(15) NOT NULL,
 Primary Key (id_komputer)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8
AUTO_INCREMENT = 0;

Create table oprogramowanie (
	id_oprogramowanie Smallint NOT NULL AUTO_INCREMENT,
	nazwa Varchar(60) NOT NULL,
	producent Varchar(30) NOT NULL,
	wersja Varchar(20),
	nr_seryjny Varchar(30) NOT NULL,
	klucz_licencji Varchar(20),
	termin_licencji Date NOT NULL,
	typ_licencji Varchar(20),
	ilosc_stanowisk Int,
	url_scan Varchar(30),
 Primary Key (id_oprogramowanie)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8
AUTO_INCREMENT = 0;

Create table komp_opr (
	id_komputer Smallint NOT NULL,
	id_oprogramowanie Smallint NOT NULL,
	id_komp_opr Smallint NOT NULL AUTO_INCREMENT,
 Primary Key (id_komp_opr)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8
AUTO_INCREMENT = 0;

Create table oprogramowanie_temp (
	id_oprogramowanie_temp Smallint NOT NULL AUTO_INCREMENT,
	nazwa Varchar(60) NOT NULL,
	producent Varchar(30),
	wersja Varchar(20),
	nr_seryjny Varchar(30),
	klucz_licencji Varchar(20),
	termin_licencji Date,
 Primary Key (id_oprogramowanie_temp)) ENGINE = InnoDB
DEFAULT CHARACTER SET utf8
AUTO_INCREMENT = 0;









Alter table komp_opr add Foreign Key (id_komputer) references komputery (id_komputer) on delete cascade on update cascade;
Alter table komp_opr add Foreign Key (id_oprogramowanie) references oprogramowanie (id_oprogramowanie) on delete cascade on update cascade;






