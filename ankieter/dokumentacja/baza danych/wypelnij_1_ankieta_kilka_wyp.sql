-- phpMyAdmin SQL Dump
-- version 2.8.2.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Czas wygenerowania: 19 Lis 2006, 15:30
-- Wersja serwera: 4.0.26
-- Wersja PHP: 5.1.5
-- 
-- Baza danych: `projekt5`
-- 


-- 
-- Zrzut danych tabeli `uzytkownicy`
-- 

INSERT INTO `uzytkownicy` (`id_uzytkownik`, `login`, `haslo`) VALUES (1, 'hubert', 'marzec'),
(2, 'seba', 'seba');


-- 
-- Zrzut danych tabeli `ankiety`
-- 

INSERT INTO `ankiety` (`id_ankieta`, `id_uzytkownik`, `nazwa`, `opis`, `data_rozpoczecia`, `data_zakonczenia`, `status`) VALUES
(1, 1, 'Partie polityczne', 'Ankieta bada  poparcie dla danych partii politycznych', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'nieaktywna'),
(28, 2, 'Języki programowania', 'Ankieta bada  poparcie dla danych partii politycznych', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'nieaktywna'),
(29, 1, 'Urzadzenia gosp domowego', 'Ankieta bada  poparcie dla danych partii politycznych', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'nieaktywna'),
(30, 1, 'Sasiedzi', 'Ankieta bada  poparcie dla danych partii politycznych', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'nieaktywna');



-- 
-- Zrzut danych tabeli `typy_odpowiedzi`
-- 

INSERT INTO `typy_odpowiedzi` (`id_typ_odpowiedzi`, `nazwa`, `opis`) VALUES (2, 'otwarte', ' umozliwia podanie wlasnej odpowiedzi'),
(0, 'jednokrotne', 'pytania jednokrotnego wyboru'),
(1, 'wielokrotne', 'pytania wielokrotnego wyboru');


-- 
-- Zrzut danych tabeli `pytania`
-- 

INSERT INTO `pytania` (`id_pytanie`, `id_typ_odpowiedzi`, `id_ankieta`, `kolejnosc`, `pytanie`) VALUES (40, 0, 1, 1, 'Jakie partie polityczne popierasz?'),
(74, 0, 29, 1, 'Jakie urz�?dzenia gospodarctawa domowego posiadasz w domu'),
(57, 1, 1, 2, 'Jakie lubisz kolory'),
(73, 1, 1, 3, 'Giertych'),
(64, 0, 28, 6, 'php'),
(65, 0, 28, 3, 'c++'),
(66, 0, 28, 4, 'java'),
(67, 0, 28, 5, 'pascal'),
(68, 0, 28, 2, 'asembler'),
(69, 0, 28, 3, 'c#'),
(75, 0, 29, 2, 'Czy wiesz co to jest iPod?'),
(76, 0, 30, 2, 'czymasz zaufanie do s�?siadów'),
(77, 1, 30, 1, 'cechy które cenisz u s�?siadów'),
(78, 0, 30, 3, 'czy powierzasz klucze'),
(79, 0, 1, 4, 'Czy Ziobro jestr zerem?');



-- 
-- Zrzut danych tabeli `warianty_odpowiedzi`
-- 

INSERT INTO `warianty_odpowiedzi` (`id_wariant_odpowiedzi`, `id_pytanie`, `kolejnosc`, `opis`) VALUES (24, 57, 1, 'zielony'),
(21, 40, 3, 'lpr'),
(16, 40, 4, 'pis'),
(8, 40, 6, 'sld'),
(25, 57, 2, 'bia�?y'),
(10, 40, 5, 'po'),
(13, 40, 1, 'samoobrona'),
(26, 57, 3, 'czerwony'),
(27, 57, 4, 'zó�?ty'),
(28, 57, 5, 'skraczkowaty'),
(34, 73, 5, 'Oszo�?om'),
(30, 73, 1, 'G�?upi'),
(31, 73, 3, 'Brzydki'),
(32, 73, 2, 'Niebezpieczny'),
(33, 73, 4, 'Gej'),
(35, 74, 3, '1'),
(36, 74, 2, '2'),
(37, 74, 1, '3'),
(38, 74, 4, '4'),
(39, 76, 2, 'tak'),
(40, 76, 1, 'nie'),
(44, 40, 2, 'upl'),
(42, 77, 1, 'czysto�?�?'),
(43, 77, 2, 'solidno�?�?'),
(45, 79, 1, 'tak'),
(46, 79, 2, 'nie');



-- 
-- Zrzut danych tabeli `wypelnione_ankiety`
-- 


INSERT INTO `wypelnione_ankiety` (`id_wypelniona_ankieta`, `id_ankieta`) VALUES (1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1);

-- 
-- Zrzut danych tabeli `odpowiedzi`
-- 

INSERT INTO `odpowiedzi` (`id_odpowiedz`, `id_pytanie`, `id_wypelniona_ankieta`, `odpowiedz`, `kolejnosc`) VALUES (1, 40, 16, '13', 0),
(2, 57, 16, '24', 0),
(3, 57, 16, '25', 0),
(4, 40, 17, '8', 0),
(5, 57, 17, '24', 0),
(6, 57, 17, '25', 0),
(7, 57, 17, '26', 0),
(8, 57, 17, '27', 0),
(9, 57, 17, '28', 0),
(10, 73, 17, '32', 0),
(11, 79, 17, '45', 0),
(12, 40, 18, '8', 0),
(13, 79, 18, '45', 0),
(14, 40, 19, '16', 0),
(15, 57, 19, '27', 0),
(16, 73, 19, '31', 0),
(17, 73, 19, '33', 0),
(18, 79, 19, '45', 0);



-- 
-- Zrzut danych tabeli `respondenci`
-- 




