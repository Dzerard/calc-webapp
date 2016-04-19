-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Czas wygenerowania: 19 Kwi 2016, 12:59
-- Wersja serwera: 5.5.48-cll
-- Wersja PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `lukaszg1_soccer`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'news'),
(2, 'strefa'),
(4, 'article');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `coach`
--

CREATE TABLE IF NOT EXISTS `coach` (
  `coach_id` int(11) NOT NULL AUTO_INCREMENT,
  `coach_email` varchar(255) NOT NULL,
  `coach_phone` varchar(255) NOT NULL,
  `coach_desc` text NOT NULL,
  `coach_name` varchar(255) NOT NULL,
  `coach_img` varchar(255) NOT NULL,
  PRIMARY KEY (`coach_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `coach`
--

INSERT INTO `coach` (`coach_id`, `coach_email`, `coach_phone`, `coach_desc`, `coach_name`, `coach_img`) VALUES
(1, 'dawid.wasko@wp.pl', '791-969-094', '<p style="font-weight: bold;">WYKSZTA?ï¿½CENIE</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width="110">2011</td>\r\n<td>Kurs wyr??wnawczy UEFA B Grodzisk Wielkopolski - Barsinghausen</td>\r\n</tr>\r\n<tr>\r\n<td>2007- 2008</td>\r\n<td>Akademia Wychowania Fizycznego, Studium Doskonalenia i Kszta??cenia Kadr ï¿½?? kierunek: Instruktor Pi??ki No??nej, zaoczne, 1-letnie</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="font-weight: bold;">KURSOKONFERENCJE I SZKOLENIA</p>\r\n<ul>\r\n<li>Akademia Pi??karska Grassroots - konferencja szkoleniowa dla nauczycieli, trener??w i animator??w pi??ki no??nej ï¿½?? My??lenice 2012</li>\r\n<li>Konferencja COERVER COACHING dla trener??w i instruktor??w pi??ki no??nej oraz nauczycieli wychowania fizycznego ï¿½?? Wieliczka 2012</li>\r\n<li>Kursokonferencja Trener??w i Instruktor??w dotyczï¿½?ca szkolenia dzieci i m??odzie??y Krak??w 2012</li>\r\n<li>Kursokonferencja Trener??w i Instruktor??w MZPN AWF Krak??w 2011</li>\r\n<li>Miï¿½?dzynarodowa konferencja dla trener??w: Szkolenie dzieci i m??odzie??y - Warszawa 2011</li>\r\n<li>Konferencja COERVER COACHING dla trener??w pi??ki no??nej AWF Katowice 2011</li>\r\n<li>Kursokonferencja Trener??w i Instruktor??w dotyczï¿½?ca szkolenia dzieci i m??odzie??y Krak??w 2011</li>\r\n<li>Kursokonferencja Trener??w i Instruktor??w MZPN AWF Krak??w 2010</li>\r\n<li>Kursokonferencja Trener??w i Instruktor??w MZPN AWF Krak??w 2009</li>\r\n<li>z asas</li>\r\n</ul>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width="110">2010 ï¿½?? obecnie</td>\r\n<td>D.T.S. Tramwaj Krak??w ï¿½?? Trampkarze, M??odziki, Orliki, ??aki</td>\r\n</tr>\r\n<tr>\r\n<td>2010</td>\r\n<td>Letni ob??z pi??karski POLSAT SOCCER SKILLS ï¿½?? Wa??cz</td>\r\n</tr>\r\n<tr>\r\n<td>2009 ï¿½?? 2009</td>\r\n<td>Szk????ka pi??karska ï¿½??OR?ï¿½Yï¿½?ï¿½ ï¿½?? M??odziki</td>\r\n</tr>\r\n<tr>\r\n<td>2008 ï¿½?? 2009</td>\r\n<td>KS Prï¿½?dniczanka Krak??w ï¿½?? M??odziki - II trener</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'wasko', 'wasiek.png'),
(2, '', '7888', '<p style="font-weight: bold;">WYKSZTA?ï¿½CENIE</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width="110">2010</td>\r\n<td>Instruktor rekreacji ruchowej specjalno??ï¿½? pi??ka no??na</td>\r\n</tr>\r\n<tr>\r\n<td>2010</td>\r\n<td>Instruktor dyscypliny sportu pi??ka no??na</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="font-weight: bold;">KURSOKONFERENCJE I SZKOLENIA</p>\r\n<ul>\r\n<li>Akademia Pi??karska Grassroots - konferencja szkoleniowa dla nauczycieli, trener??w i animator??w pi??ki no??nej ï¿½?? My??lenice 2012</li>\r\n<li>Kursokonferencja BOLTON CAMP - Wronki 2011</li>\r\n</ul>\r\n<p style="font-weight: bold;">DO??WIADCZENIE ZAWODOWE</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td width="110">2012 ï¿½?? obecnie</td>\r\n<td>D.T.S. Tramwaj Krak??w ï¿½?? ??aki</td>\r\n</tr>\r\n<tr>\r\n<td>2010 - obecnie</td>\r\n<td>Football Academy Olkusz - Orliki</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'Michal', 'coach_2.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_title` varchar(255) NOT NULL,
  `gallery_desc` text NOT NULL,
  `gallery_insert` int(11) NOT NULL,
  `gallery_visible` enum('yes','no') NOT NULL DEFAULT 'no',
  `gallery_update` int(11) NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `gallery_title`, `gallery_desc`, `gallery_insert`, `gallery_visible`, `gallery_update`) VALUES
(3, 'test 3', '<p>adsadaafa</p>', 1379189645, 'yes', 1379189645);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_login` varchar(255) NOT NULL,
  `login_pass` varchar(255) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `login`
--

INSERT INTO `login` (`login_id`, `login_login`, `login_pass`) VALUES
(1, 'admin', 'dawid87wasko');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) NOT NULL,
  `news_desc` text NOT NULL,
  `news_user` int(11) NOT NULL,
  `news_insert` int(11) NOT NULL,
  `news_update` int(11) NOT NULL,
  `news_visible` enum('yes','no') NOT NULL,
  `news_top` enum('yes','no') NOT NULL DEFAULT 'no',
  `news_category_id` int(10) unsigned NOT NULL,
  `news_subcategory` enum('zawodnik','rodzic','trening') DEFAULT NULL,
  `news_image` varchar(255) NOT NULL,
  `news_video` varchar(255) NOT NULL,
  `news_file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_desc`, `news_user`, `news_insert`, `news_update`, `news_visible`, `news_top`, `news_category_id`, `news_subcategory`, `news_image`, `news_video`, `news_file`) VALUES
(25, 'Treningi', '<p><span style="font-size: small; color: #ff0000;"><strong>Klub D.T.S. Tramwaj Krak&oacute;w organizuje nab&oacute;r do sekcji piĹkarskiej na sezon 2013/2014 dla dzieci i mĹodzieĹźy w nastepujÄcych kategoriach wiekowych:</strong></span></p>\r\n<p style="text-align: left;"><strong>JUNIORZY MĹODSI - 1997/1998 </strong>wtorek - czwartek 17.30-19.00</p>\r\n<p style="text-align: left;"><strong>TRAMPKARZE - 1999/2000&nbsp; </strong>wtorek - czwartek 17.30-19.00</p>\r\n<p align="left"><strong>MĹODZIKI - 2001/2002</strong> wtorek - czwartek 16.00-17.25<strong><br /></strong></p>\r\n<p align="left"><strong>ORLIKI - 2003/2004 </strong>Ĺroda - piÄtek 16.00-17.25<strong><br /></strong></p>\r\n<p align="left"><strong>ĹťAKI - 2005 /2006 </strong>Ĺroda - piÄtek 17.30-19.00<strong><br /></strong></p>\r\n<p align="left"><strong>SKRZATY- 2007 i mĹodsi </strong>-Ĺroda - piÄtek 17.30-19.00</p>\r\n<p>ZajÄcia odbywajÄ siÄ na obiektach klubowych przy<strong>&nbsp;ulicy Praskiej 61a.</strong></p>\r\n<p>Dojazd autobusowy z ronda grunwaldzkiego liniami&nbsp;<strong>112, 162 i 412</strong> na przystanek os. Robotnicze.</p>\r\n<p>WiÄcej informacji pod numerem:</p>\r\n<p><strong>791-969-094</strong></p>\r\n<p>&nbsp;</p>', 1, 1363554192, 1376938712, 'yes', 'yes', 1, NULL, '', '', NULL),
(51, 'PORAĹťKA ĹťAKĂW Z SOKOĹEM KOCMYRZĂW', '<p style="text-align: justify;">DruĹźyna Ĺťak&oacute;w DTS przegraĹa w Kocmyrzowie z miejscowym SokoĹem 2:12. Bramki dla Tramwaju zdobyli: Szymon JeleĹ i PaweĹ Zborowski. Nasz zesp&oacute;Ĺ przystÄpiĹ do tego spotkania osĹabiony brakiem podstawowego bramkarza.</p>', 1, 1371404807, 1371404866, 'yes', 'no', 1, NULL, '', '', NULL),
(33, 'Wysoka poraĹźka OrlikĂłw ', '<p><strong><span style="font-size: small; font-family: arial,helvetica,sans-serif;">W swoim drugim meczu tej wiosny Orliki Tramwaju wysoko przegraĹy mecz na wĹasnym stadionie z druĹźynÄ SĹowika Olkusz 1-25. Strzelcem jedynej bramki dla Tramwaju zostaĹ Dawid GĹ&oacute;wczyk.</span></strong></p>', 1, 1367762594, 1367762798, 'yes', 'no', 1, NULL, '', '', NULL),
(31, 'GOL-CHAMPIONSHIP 2013', '<h5 class="uiStreamMessage userContentWrapper" data-ft="{"><span class="messageBody" style="font-family: arial,helvetica,sans-serif; font-size: small;" data-ft="{"><span class="userContent">Gratulacje dla ORLIK&Oacute;W Tramwaju Krak&oacute;w z rocznika 2003 za zajÄcie 2 miejsca w turnieju GOL-CHAMPIONSHIP 2013 w Bieruniu !!!</span></span></h5>\r\n<p><strong><span class="messageBody" style="font-size: small;" data-ft="{"><span class="userContent"><span style="font-family: arial,helvetica,sans-serif;">Najlepszym strzelcem druĹźyny Tramwaju zostaĹ Dawid GĹ&oacute;wczyk</span> </span></span></strong></p>', 1, 1365972155, 1365972161, 'yes', 'no', 1, NULL, '', '', NULL),
(24, 'ZalegĹy mecz ĹťakĂłw', '<p><span style="font-size: xx-large;"><strong>ZalegĹy mecz wyjazdowy Ĺťakow z TrzcianÄ odbÄdzie siÄ w Piatek 21 czerwca o godzinie 18.</strong></span></p>', 1, 1363520215, 1371037584, 'yes', 'no', 1, NULL, '', '', NULL),
(26, 'Letni obĂłz piĹkarski 2013', '<p><span style="color: black; font-family: ''Verdana'',''sans-serif''; font-size: xx-small;">Termin obozu: 09.08.2013 &ndash; 16.08.2013</span><br /><br /><span style="color: black; font-family: ''Verdana'',''sans-serif''; font-size: xx-small;">Miejsce wyjazdu: MiÄdzybrodzie Ĺťywieckie &ndash; OĹrodek NIAGARA&nbsp; <strong><span style="color: black; font-family: ''Verdana'',''sans-serif''; font-size: xx-small;">Koszt: 840zĹ</span></strong></span><br /><br /><span style="color: black; font-family: ''Verdana'',''sans-serif''; font-size: xx-small;">Uczestnicy: zawodnicy z rocznik&oacute;w 2006 &ndash; 1998</span></p>\r\n<p><span style="color: black; font-family: ''Verdana'',''sans-serif''; font-size: xx-small;">OĹrodek dysponuje pokojami dwu i trzy osobowymi z Ĺazienkami.&nbsp;W kaĹźdym pokoju jest dostÄp do internetu. dodatkowo na terenie oĹrodka ,znajduje siÄ restauracja na 100 miejsc oraz kawiarnia ,dwie sale konferensyjne z rzutnikami i ekranami, kaĹźda na 40 os&oacute;b. OĹrodek dysponuje salÄ do tenisa stoĹowego, kortami tenisowymi. na oĹrodku znajduje siÄ bezpĹatny basen letni oraz boisko do piĹki plaĹźowej. na obiekcie sÄ wyznaczone miejsca do grilowania. trzysta metr&oacute;w od oĹrodka jest kompielisko wraz z plaĹźÄ ,moĹźna tam wypoĹźyczaÄ odpĹatnie rowerki wodne oraz kajaki. oĹrodek dysponuje gabinetami odnowy bilogicznej.<br />400m od oĹrodka znajdujÄ siÄ boiska trawiaste w bardzo dobrym stanie a 150m od oĹrodka Orlik z sztucznÄ nawierzchniÄ.</span><br /><br /><span style="font-size: xx-small;"><span style="color: black; font-family: ''Verdana'',''sans-serif'';"><strong>www.owniagara.pl</strong><br /></span></span></p>\r\n<p><span style="font-size: xx-small;"><strong><span style="color: black; font-family: ''Verdana'',''sans-serif'';">zapisy: <a href="mailto:kontakt@akademiawawel.pl">kontakt@akademiawawel.pl</a><br />Do dnia 10 czerwca naleĹźy wpĹaciÄ 150 zĹ zaliczki nr konta:&nbsp; <span style="font-size: xx-small;"><strong><strong><span style="color: #555555; line-height: 115%; font-family: ''Arial'',''sans-serif'';">64-15001979-1219700361310000</span></strong></strong></span><span style="font-size: xx-small;"><strong><br /></strong></span></span></strong></span></p>\r\n<p><span style="color: #555555; line-height: 115%; font-family: ''Arial'',''sans-serif''; font-size: xx-small;">Wszelkich dodatkowych informacji udziela Trener MichaĹ Peterman tel.505-951-525</span></p>', 1, 1363554209, 1371596638, 'yes', 'no', 1, NULL, '', '', NULL),
(30, 'Najnowsze informacje', '<p>26.04 nowa odsĹona strony ! ;] - niestety zmiana terminu</p>', 1, 1363647597, 1367762244, 'no', 'no', 1, NULL, '', '', NULL),
(32, 'Wysoka wygrana ĹťakĂłw', '<h5 class="uiStreamMessage userContentWrapper" data-ft="{"><span class="messageBody" style="font-family: arial,helvetica,sans-serif; font-size: small;" data-ft="{"><span class="userContent">W pierwszym meczu rundy wiosennej druĹźyna Ĺźak&oacute;w Tramwaju Krak&oacute;w wysoko pokonaĹa swoich r&oacute;wieĹnik&oacute;w z Radziszowa 12-2 !!! Gole dla Tramwaju strzelili: PaweĹ Zborowski 5 Dorian Pulchny 5 a po jednym golu doĹoĹźyli Szymon JeleĹ i Maciej Ĺťelazowski.<br /> Gratulujemy wspaniaĹej postawy !!!</span></span></h5>', 1, 1365972327, 1365972622, 'yes', 'no', 1, NULL, '', '', NULL),
(34, 'Wysokie zwyciÄstwo Trampkarzy', '<h5 class="uiStreamMessage userContentWrapper" data-ft="{"><span class="messageBody" style="font-family: arial,helvetica,sans-serif; font-size: small;" data-ft="{"><span class="userContent">W swoim pierwszym meczu rundy wiosennej druĹźyna Trampkarzy Tramwaju Krak&oacute;w wysoko pokonaĹa druĹźynÄ Strzelc&oacute;w Korona Krak&oacute;w 14-0 !!! Gole dla Tramwaju strzelili: Grzegorz Bednarczyk 4, Jakub Liszka 3, PrzemysĹaw Bartyzel 2, Ĺukasz Lipowski 1, Kamil Sikorski 1, Dominik Wrona 1, Mateusz BrygoĹa 1<br /> Gratulujemy wspaniaĹej postawy !!!</span></span></h5>', 1, 1367763260, 1368258823, 'yes', 'no', 1, NULL, '', '', NULL),
(35, 'PoraĹźka Trampkarzy z Zwierzynieckim ', '<p><strong><span style="font-size: small; font-family: arial,helvetica,sans-serif;">W zalegĹym meczu III ligi Trampkarzy osĹabiona druĹźyna Tramwaju ulegĹa Zwieczynieckiemu 1-4. Strzelcem bramki zostaĹ Grzegorz Bednarczyk popisujÄc siÄ piÄknym wolejem. ZnakomitÄ asystÄ wykazaĹ siÄ Kamil Sikorski !!! Szkoda tylko Ĺźe jednÄ !!!</span></strong></p>', 1, 1367763983, 1367778964, 'yes', 'no', 1, NULL, '', '', NULL),
(36, 'Wysoka poraĹźka ĹťakĂłw', '<p><strong><span style="font-size: small; font-family: arial,helvetica,sans-serif;">W swoim drugim meczu tej wiosny Ĺťaki Tramwaju wysoko przegraĹy mecz na wĹasnym stadionie z druĹźynÄ Garbarni Krak&oacute;w 2-21. Strzelcami bramek dla Tramwaju byli PaweĹ Zborowski i Dorian Pulchny <br /></span></strong></p>', 1, 1367764368, 1367764374, 'yes', 'no', 1, NULL, '', '', NULL),
(37, 'Pewna wygrana OrlikĂłw', '<p style="text-align: justify;"><img style="float: left;" src="https://lh5.googleusercontent.com/-a7Bp7i6hfw4/UYaDGtPL06I/AAAAAAAAABs/ja3Xjamy63w/w740-h416/DSC_0075.jpg" alt="" width="194" height="156" /><span style="font-family: arial,helvetica,sans-serif; font-size: small;"><strong>W poniedziaĹkowe popoĹudnie druĹźyna Orlik&oacute;w, wyjÄtkowo mocna <strong>tego dnia&nbsp;</strong>kadrowo, wybraĹa siÄ na mecz wyjazdowy do Mnikowa. Spotkanie od poczÄtku przebiegaĹo pod dyktando zawodnik&oacute;w Tramwaju, kt&oacute;rzy ostatecznie zwyciÄzyli rywali aĹź 15:3. Spory wpĹyw na wynik meczu i liczbÄ strzelonych bramek miaĹa wyjÄtkowo sĹaba jakoĹÄ murawy.</strong></span></p>\r\n<p style="text-align: justify;"><span style="font-family: arial,helvetica,sans-serif; font-size: small;"><strong>Bramki dla Tramwaju strzelali: Maciej Nowak (trzy), Krystian ? (trzy), MichaĹ Luty (dwie), Karol Potoniec (dwie) Bartosz Rojewski, JÄdrzej Jackowski, Kacper Heretyk, Wojciech Czechowski.</strong></span></p>', 1, 1367770195, 1367788743, 'yes', 'no', 1, NULL, '', '', NULL),
(38, 'PoraĹźka Trampkarzy w Radziszowie ', '<p style="text-align: justify;"><strong><span style="font-family: arial,helvetica,sans-serif; font-size: small;">DruĹźyna Trampkarzy Tramwaju Krak&oacute;w przegraĹa wyjazdowe spotkanie z RadziszowiankÄ Radzisz&oacute;w 0:10</span></strong><strong><span style="font-family: arial,helvetica,sans-serif; font-size: small;">. Miejscowi okazali siÄ o klasÄ lepsi i pewnie zwyciÄĹźyli nasz zesp&oacute;Ĺ.</span></strong></p>', 1, 1367776443, 1367787214, 'yes', 'no', 1, NULL, '', '', NULL),
(39, 'CiÄzki mecz MĹodzikĂłw w WoĹowicach', '<p style="text-align: justify;"><span style="font-size: x-small;"><strong>Po bardzo ciÄĹźkim i wyr&oacute;wnanym meczu MĹodzicy Tramwaju pokonali Piast WoĹowice 5:3. ZwyciÄstwo jednak nie przyszĹo Ĺatwo, a w wielu fragmentach spotkania to zawodnicy Piasta przewaĹźali. Tramwaj groĹşnie kontratakowaĹ i wypunkotwaĹ gospodarzy aplikujÄc im 5 bramek.<br /></strong></span><br /><span style="font-size: x-small;"><strong>Bramki dla Tramwaju zdobywali: Krystian BiaĹosiewicz (trzy) oraz Jacek Sendor i MichaĹ Mirocha.<br /></strong></span></p>\r\n<p><img src="https://lh3.googleusercontent.com/-K_iDk3dgfUQ/UYaDnMftDYI/AAAAAAAAAA8/XckUlUBpbQE/w740-h416/DSC_0096.jpg" alt="" width="350" height="197" /></p>', 1, 1368386110, 1368386430, 'yes', 'no', 1, NULL, '', '', NULL),
(40, 'Orlicy rozbici przez ProszowiankÄ', '<p style="text-align: justify;">W minionÄ ĹrodÄ zesp&oacute;Ĺ Orlik&oacute;w Tramwaju Krak&oacute;k&oacute;w zostaĹ rozbity na wĹasnym boisku przez ProszowiankÄ Proszowice 3:14. GoĹcie dominowali od pierwszej do ostatniej minuty, odnaszÄc w peĹni zasĹuĹźone zwyciÄstwo.</p>\r\n<p style="text-align: justify;">Gole dla Tramwaju padaĹy po strzaĹach: Bartosza Rojewskiego, Piotra HaĹasa i JÄdzeja Jackowskiego.</p>', 1, 1368387290, 1368387547, 'yes', 'no', 1, NULL, '', '', NULL),
(41, 'WSTYDLIWA PORAĹťKA TRAMPKARZY', '<p style="text-align: justify;">Tramkarze Tramwaju Krak&oacute;w w sobotnie popoĹudnie zaliczyli fatalny wystÄp przeciwko Piastowi WoĹowice. Nasi zaowdnicy - choÄ byli piĹkarsko lepsi - ulegli goĹciom z WoĹowic, aĹź 5:10 (4:3). Piast zastosowaĹ prostÄ, ale bardzo skutecznÄ taktykÄ, polegajÄcÄ gĹ&oacute;wnie na zagrywaniu dĹugich podaĹ w kierunku napastnik&oacute;w. Jak siÄ okazaĹo, tego dnia to wystarczyĹo do pokonania Tramwaju. Gospodarze tracli bramki po prostych, indywidualnych bĹÄdach, do tego doszĹa teĹź tragiczna skutecznoĹÄ pod bramkÄ rywali. Okzja do rehabilitacji nadarza siÄ juĹź w najbliĹźszÄ sobotÄ, w spotkaniu przeciwko OrĹowi Piaski Wielkie.</p>\r\n<p style="text-align: justify;">Bramki dla Tramwaju strzelali: Krystian BiaĹosiewicz, Kamil Sikorski, Hubert LipiĹski, Tomasz ZieliĹski i Igor StrzyĹźewski.</p>', 1, 1368388977, 1368388987, 'yes', 'no', 1, NULL, '', '', NULL),
(42, 'Pewne zwyciÄstwo OrlikĂłw', '<p style="text-align: justify;">Bardzo przekonujÄce zwyciÄstwo odnieĹli dzisiaj Orlicy Tramwaju, kt&oacute;rzy ograli Ĺwit Krzeszowice 9:5. Mecz lepiej rozpoczÄli goĹcie, kt&oacute;rzy prowdzili juĹź 2:0, ale mĹodzi zawodnicu Tramwaju szybko przjÄli inicjatywÄ i zeszli na przerwÄ prowadzÄc 4:3. Druga odsĹona to juĹź wyraĹşna dominacja gospodarzy, kt&oacute;rzy doĹoĹźyli kolejne piÄÄ bramek.</p>\r\n<p style="text-align: justify;">Strzelcy goli dla Tramwaju: Maciej Nowak (cztery), Bartosz Rojewski, Piotr HaĹas, MichaĹ Luty, Kacper MaĹodobry i samob&oacute;jcza.</p>', 1, 1368389827, 1368389827, 'yes', 'no', 1, NULL, '', '', NULL),
(43, 'MĹODZICY ROZGROMILI PIASTA SKAWINÄ', '<p>W pierwszym z trzech rozegranych w mijajÄcym tygodniu spotkaĹ, MiĹodzicy Tramwaju Krak&oacute;w bez problem&oacute;w uporali siÄ z r&oacute;wieĹnikami&nbsp; ze Skawiny, wygrywajÄc aĹź 10:1. GoĹcie ze Skawiny byli tylko tĹem dla Ĺwietnie prezentujÄcych tego dnia mĹodych piĹkarzy Tramwaju. WiÄkszÄ czÄĹÄ drugiej poĹowy gospodarze grali w osĹabieniu, po czerwonej kartce MikoĹaja Rejtera.<br />Bramki dla Tramwaju zdobywali: Krystian BiaĹoszewicz (siedem), MichaĹ Mirocha (dwie) oraz Maciej Nowak.</p>', 1, 1368991234, 1368991277, 'yes', 'no', 1, NULL, '', '', NULL),
(44, 'Wysoka poraĹźka MĹodzikĂłw w Radziszowie', '<p style="text-align: justify;">W rozegranym w czwartek zalegĹym spotkaniu, MĹodzicy Tramwaju Krak&oacute;w nie sprostali Radziszowiance Radzisz&oacute;w, przegrywajÄc 1:7. ChoÄ to nasz zesp&oacute;Ĺ otworzyĹ wynik (pierszwsze trafienie Adama G&oacute;rki w barwach Tramwaju), to p&oacute;Ĺşniej na boisku dominowali juĹź gospodarze.</p>', 1, 1368992208, 1368992246, 'yes', 'no', 1, NULL, '', '', NULL),
(45, 'TRAMPKARZE ZREHABILITOWALI SIÄ ZA MECZ Z WOĹOWICAMI', '<p style="text-align: justify;">DruĹźyna Trampkarzy Tramaju odkupiĹa winy za nieudany wystÄp przeciwko Piastowi WoĹowice i bez problemu poradziĹa sobie z OrĹem Piaski Wielkie, zwycieĹźajÄc 10:3.<br />Bramki dla Tramwaju strzelali: PrzemysĹaw Bartyzel (trzy), Grzegorz Bednarczyk (trzy), Kamil Sikorski (dwie), Jakub Liszka i Hubert LipiĹski.</p>', 1, 1368992953, 1368992960, 'yes', 'no', 1, NULL, '', '', NULL),
(46, 'ZWYCIÄSTWO MĹODZIKĂW SIDZINIE', '<p style="text-align: justify;">MĹodzicy Tramwaju Krak&oacute;w w dobrym stylu zdobyli koljeny komplet puntk&oacute;w, wygrywajÄc na boisku OrĹa II Sidzina 4:1. Nasz zesp&oacute;Ĺ przystÄpiĹ do tego bez kilku podstawowych zawidnik&oacute;w, ale ich zmiennicy nie zawiedli.<br />Dla Tramwaju trafiali: Jacek Sendor (dwie), Konrad Stach i MichaĹ Mirocha.</p>', 1, 1368995740, 1368995740, 'yes', 'no', 1, NULL, '', '', NULL),
(47, 'MACIEJ NOWAK DAJE WYGRANÄ W GIEBUĹTOWIE', '<p>Orlicy Tramwaju Krak&oacute;w, po zaciÄtym meczu, wygrali wyjazdowe spotkanie z JutrzenkÄ GiebuĹt&oacute;w 5:3. Wszyskie piÄÄ bramek dla nszej druĹźyny zdobyĹ Maciej Nowak.</p>', 1, 1368996058, 1368996058, 'yes', 'no', 1, NULL, '', '', NULL),
(48, 'TRAMPKARZE DTS-u REMISUJÄ W TYĹCU', '<p style="text-align: justify;">W meczu 8. kolejki, Trampkarze DTS-u doĹÄ nieoczekiwanie zaledwie zremisowali na boisku Tynieckiego KS. Gospodarze w peĹni wykorzystali atuty swojego obiektu i zasĹuĹźenie odebrali dwa punkty naszym zawodnikom. Tramwaj przez wiÄkszoĹÄ spotkania utrzymywaĹ jednobramkowe prowadzenie (gol Grzegorza Bednarczyka), ale w koĹc&oacute;wce - po strzale niemal z poĹowy boiska - piĹkarze z TyĹca doprowadzili do wyr&oacute;wnania...</p>\r\n<p style="text-align: justify;">&nbsp;</p>', 1, 1370808566, 1370808579, 'yes', 'no', 1, NULL, '', '', NULL),
(49, 'PORAĹťKA ORLIKĂW Z POGONIÄ MIECHĂW', '<p style="text-align: justify;">Orlicy Tramwaju Krak&oacute;w zanotowali wysokÄ poraĹźkÄ z PogoniÄ Miech&oacute;w 2:12. GoĹcie z Miechowa przewaĹźali od pierwszej do ostatniej minuty, odnoszÄc zasĹuĹźone zwyciÄstwo. Trafienia dla DTS-u zaliczyli Maciej Nowak i Bartosz Synowiec.</p>', 1, 1370809609, 1370809616, 'yes', 'no', 1, NULL, '', '', NULL),
(50, 'SWOSZOWICE LEPSZE W MECZU NA WODZIE', '<p style="text-align: justify;">Trampkarze Krakusa Swoszowice pokonali Tramwaj Krak&oacute;w 2:1. Mecz rozgrywany byĹ w yjÄtkowo trudnych warunkach atmosferycznych, przy mocno padajÄcym deszczu. Autorem jedynej bramki dla DTS-u byĹ Szymon Turcza-JurczyĹski.</p>', 1, 1370809842, 1370810085, 'yes', 'no', 1, NULL, '', '', NULL),
(52, 'TRAMPKARZE PEWNIE OGRYWAJÄ BRONOWIANKÄ', '<p style="text-align: justify;">Tramkarze Tramwaju, w meczu 10. kolejki pokonali BronowiankÄ Krak&oacute;w 9:3. Spotkanie toczyĹo siÄ w napiÄtej atmosferze, a sporo do Ĺźyczenia pozostawiaĹa praca arbitra. GoĹcie wystÄpili w tym meczu w 8-osobowym skĹadzie. Gole dla DTS-u padĹy po strzaĹach: Krystiana BiaĹosiewicza (cztery), PrzemysĹawa Bartyzela (dwa), Igora StrzyĹźewskiego, Szymona Turczy i Kuby Liszki. Krystian BiaĹoszewicz swoje cztery bramki zdobyĹ w samej koĹcowce i to one rozstrzygnÄĹy losy spotkania.</p>', 1, 1371407085, 1371407085, 'yes', 'no', 1, NULL, '', '', NULL),
(53, 'ZWYCIÄSTWO ORLIKĂW NAD AZS AWF KRAKĂW', '<p>Orliki Tramwaju zanatowaĹy efektownÄ wygranÄ 17:5 w meczu z&nbsp; AZS AWF Krak&oacute;w.</p>', 1, 1371407353, 1371596102, 'yes', 'no', 1, NULL, '', '', NULL),
(54, 'ĹťAKI OGRYWAJÄ KRAKUSA', '<p style="text-align: justify;">Ĺťaki DTS-u bez wiÄkszych trudnoĹci uporaĹy siÄ z Krakusem Swoszowice, ogrywajÄc go 13:1. Gole dla Tramwaju strzelali: Dorian Pulchny (piÄÄ), Szymon JeleĹ (trzy), PaweĹ Zborowski (trzy). MiĹosz Frej oraz Kamil Rojewski.</p>', 1, 1371407695, 1371407771, 'yes', 'no', 1, NULL, '', '', NULL),
(55, 'DÄBSKI BEZ SZANS W STARCIU Z MĹODZIKAMI', '<p style="text-align: justify;">MĹodziki Tramwaju rozbiĹy DÄbskiego Krak&oacute;w 17:0. Autorem aĹź dwunastu (!) bramek byĹ Krystian BiaĹosiewicz, trzy trafienia dorzuciĹ Maciej Nowak, a po jednym Konrad Stach i Bartek Mruk.</p>', 1, 1371408398, 1371408402, 'yes', 'no', 1, NULL, '', '', NULL),
(56, 'ĹťAKI LEPSZE OD POGONI II SKOTNIKI', '<p style="text-align: justify;">DruĹźyna Ĺťak&oacute;w DTS wygraĹa z PogoniÄ II Skotniki 17:3.&nbsp;<span>&nbsp;Bramki dla Tramwaju zdobywali: PaweĹ Zborowski (dziewiÄÄ), Szymon JeleĹ (cztery), MichaĹ Ĺťelazowski (dwie),&nbsp;Maciej Ĺťelazowski i Iwo Szlachetko.</span></p>', 1, 1371409365, 1371409367, 'yes', 'no', 1, NULL, '', '', NULL),
(57, 'MĹODZIKI WYGRYWAJÄ Z BIEĹťANOWIANKÄ', '<p style="text-align: justify;">Mecz MĹodzik&oacute;w Tramwaju z BieĹźanowiankÄ Krak&oacute;w zakoĹczyĹ siÄ efektownÄ wygranÄ naszych zawodnik&oacute;w 6:0. ZwyciÄstwo zapewniĹy trafienia: Jacka Sendora (trzy), Krystiana BiaĹosiewicza (dwa) i Macieja Nowaka.</p>', 1, 1371410105, 1371410111, 'yes', 'no', 1, NULL, '', '', NULL),
(58, 'WYJAZDOWA WYGRANA TRAMPKARZY Z BRONOWIANKï¿½?', '<p style="text-align: justify;">W spotkaniu 11. kolejki rundy wiosennej, &nbsp;zawodnicy Tramwaju, nie bez problem&oacute;w, uprali siï¿½? z dziewczï¿½?tami z Bronowianki II Krak&oacute;w. Mecz ??wietnie rozpoczï¿½??? siï¿½? dla Bronowianki, kt&oacute;ra po do??rodkowaniu z rzutu wolnego i nieporadno??ci naszej obrony, objï¿½???a prowadzenie. Tramaj szybko wyr&oacute;wna??, za sprawï¿½? niezawodnego Grzegorza Bednarczyka. Na prowadzenie nasz zesp&oacute;?? wyprowadzi?? ?ï¿½ukasz Lipowski. W ko??c&oacute;wce pierwszej po??owy zawodniczki Bronowianki doprowadzi??y do wyr&oacute;wnania.</p>\r\n<p style="text-align: justify;">W drugiej po??owie przewaga DTS-u nie podlega??a ju?? dyzskusji, a kolejne trafienia Kamila Sikorskiego i Grzegorza Bednarczyka zapewni??y ko??cowy sukces. Rewelacyjne zawody rozgrywa??a bramkarka gospody??, i to dziï¿½?ki jej postawie Bronowianka nie straci??a jeszcze kilku bramek.</p>', 1, 1371411072, 1379249349, 'yes', 'no', 1, '', '', '', NULL),
(59, 'Letni ob??z pi??karski 2013asas', '<p>Termin obozu: 09.08.2013 &ndash; 16.08.2013</p>\r\n<p><span>Godzina wyjazdu:&nbsp;</span><strong>9.30 Stadion WKS Wawel</strong><span>&nbsp;(09.08.2013 - piï¿½?tek)</span></p>\r\n<p>Miejsce wyjazdu: Miï¿½?dzybrodzie ??ywieckie &ndash; O??rodek NIAGARA</p>\r\n<p>Koszt: 840z??<br /><br />Uczestnicy: zawodnicy z rocznik&oacute;w 2006 &ndash; 1998</p>\r\n<p>O??rodek dysponuje pokojami dwu i trzy osobowymi z ??azienkami.&nbsp;W ka??dym pokoju jest dostï¿½?p do internetu. dodatkowo na terenie o??rodka ,znajduje siï¿½? restauracja na 100 miejsc oraz kawiarnia ,dwie sale konferensyjne z rzutnikami i ekranami, ka??da na 40 os&oacute;b. O??rodek dysponuje salï¿½? do tenisa sto??owego, kortami tenisowymi. na o??rodku znajduje siï¿½? bezp??atny basen letni oraz boisko do pi??ki pla??owej. na obiekcie sï¿½? wyznaczone miejsca do grilowania. trzysta metr&oacute;w od o??rodka jest kompielisko wraz z pla??ï¿½? ,mo??na tam wypo??yczaï¿½? odp??atnie rowerki wodne oraz kajaki. o??rodek dysponuje gabinetami odnowy bilogicznej.<br />400m od o??rodka znajdujï¿½? siï¿½? boiska trawiaste w bardzo dobrym stanie a 150m od o??rodka Orlik z sztucznï¿½? nawierzchniï¿½?.<br /><br /><strong>www.owniagara.pl</strong><br />&nbsp;<br />Wstï¿½?pny plan dnia:<br /><br />7-8 - Gimnastyka poranna / rozruch<br /><br />9-9.30 - ??niadanie<br /><br />10.30 &ndash; Trening<br /><br />13-14 &ndash; Obiad<br /><br />16-17 - Trening <br /><br />19-20 - Kolacja<br /><br />20.30 &ndash; Trening taktyczny / analiza gry</p>\r\n<p><strong>zapisy: <a href="mailto:kontakt@akademiawawel.pl">kontakt@akademiawawel.pl</a><br /><strong>po dokonaniu zg??oszenia nale??y wp??aciï¿½? 150 z?? zadatku nr konta:<br /><br />RESZTï¿½? NALE??Y WP?ï¿½ACIï¿½? DO DNIA 6.08.2013<br /><br /><strong>64 1500 1979 1219 7003 6131 0000<br /><br />UWAGA !!!<br /><br /></strong>Osoby, kt&oacute;re chcï¿½? otrzymaï¿½? fakturï¿½? powinny wp??aciï¿½? jednorazowo ca??ï¿½? kwotï¿½? za wyjazd i udaï¿½? siï¿½? do ksiï¿½?gowo??ci klubu WKS Wawel(I piï¿½?tro, budynek g??&oacute;wny) w celu otrzymania faktury.&nbsp;<strong>FV nale??y odebraï¿½? do 7-dni po zaksiï¿½?gowaniu wp??aty na koncie.</strong><br /><strong><br />KARTA OBOZOWA DO POBRANIA:</strong></strong><br /><strong><strong><a href="http://www.akademiawawel.pl/images/Karta%20kwalifikacyjna%20uczestnika%20wypoczynku.%201-1.pdf" target="_blank"><br /><span style="font-size: small;">Karta obozowa_pobierz</span><br /><br /></a></strong></strong></strong></p>\r\n<p>Wszelkich dodatkowych informacji udziela Trener Micha?? Peterman tel.505-951-525</p>', 1, 1371594747, 1379251090, 'yes', 'no', 1, '', '0c85e_toystory.jpg', '', NULL),
(63, 'WYGRANA ORLIK??W', '<p style="text-align: justify;">Dru??yna Orlik&oacute;w DTS pokona??a w inauguracyjnym meczu sezonu Orilk&oacute;w Mnik&oacute;w 12:2. A?? siedmiokrotnie do siatki rywali trafi?? Krystian Lelek, po jednym golu do??o??yli: Bartek Rojewski, Dorian Pulchny, Jï¿½?drzej Jackowski, Szymon Jele??, Piotr Ha??as.</p>', 1, 1378757253, 1379250075, 'yes', 'no', 4, '', '5262d_walle.jpg', '', NULL),
(60, 'Krakowska bieda w dotacjach na sport', '<p>Organizacje pozarzÄdowe, a tym samym piĹkarskie kluby sportowe Gminy Krak&oacute;w, muszÄ ponownie przygotowaÄ siÄ na bardzo powaĹźne uszczuplenie swoich budĹźet&oacute;w w roku 2012. Pow&oacute;d? Kolejne ciÄcia Rady Miasta Krakowa, miÄdzy innymi w zakresie Ĺrodk&oacute;w na zadania publiczne - wspieranie i upowszechnianie kultury fizycznej.</p>\r\n<p>Prezydent Miasta Krakowa zarzÄdzeniem nr 146/2012 z 20 stycznia bieĹźÄcego roku ogĹosiĹ otwarty konkurs ofert w powyĹźszym obszarze, tak zwane granty. Wymieniony rodzaj zadaĹ publicznych i wysokoĹÄ planowanych Ĺrodk&oacute;w przeznaczonych w roku 2012 sÄ rekordowo skromne. Gdy przeanalizowaÄ dotacje w tym zakresie w stosunku do lat 2010-2011, to uĹźycie sĹ&oacute;w - skandaliczne ciÄcia - jest odpowiednie.</p>\r\n<p>JuĹź w roku minionym budĹźet Gminy Krak&oacute;w zostaĹ znacznie okrojony w stosunku do 2010. W&oacute;wczas o 26 procent zmniejszono dotacje w zakresie zadania pod nazwÄ &bdquo;Droga do mistrzostwa&rdquo;, o 20 procent &bdquo;Realizacja wydarzeĹ sportowych o charakterze og&oacute;lnopolskim i miÄdzynarodowym&rdquo;. Obszary z zadaĹ priorytetowych dzielnic otrzymaĹy o 33 procent Ĺrodk&oacute;w mniej na organizacjÄ lokalnych imprez sportowo-rekreacyjnych oraz zimowo-letnich oboz&oacute;w sportowych.We wszystkich wymienionych dziaĹach zmniejszone byĹy dotacje w sumie o kwotÄ w wysokoĹci 1.195.000 zĹotych. Tak byĹo rok temu.</p>\r\n<p>A jak to wyglÄda obecnie?</p>\r\n<p>Fatalnie. ZĹa to wieĹÄ dla wĹodarzy klub&oacute;w sportowych i sportowej mĹodzieĹźy. W roku 2012 ciÄcia w dotacjach dla sportowych organizacji sÄ bardziej dotkliwe niĹź rok temu, gdyĹź inflacja duĹźo wiÄksza, a podejrzewam, Ĺźe wiele organizacji sportowych nie moĹźe siÄ jeszcze pozbieraÄ po biednym minionym niedawno roku. Na zadania publiczne &bdquo;Droga do mistrzostwa&rdquo; Gmina Krak&oacute;w w tym roku przeznacza zaledwie 2.500.000 zĹotych, to jest o 22 procent mniej niĹź w roku 2011 i o 42 procent niĹź w roku 2010. Gdyby uwzglÄdniÄ stopÄ realnej inflacji, to zapewne wysokoĹÄ dotacji w ciÄgu ostatnich dw&oacute;ch lat kalendarzowych bÄdzie mniejsza o ponad 50 procent.</p>\r\n<p>Na kolejne zadania z zakresu upowszechniania kultury fizycznej - &bdquo;Aktywny Krak&oacute;w&rdquo; - Gmina przeznacza w tym roku 400 tys. zĹotych, mniej o 300 tysiÄcy w stosunku do roku 2011, zaĹ na &bdquo;RealizacjÄ wydarzeĹ sportowych o charakterze og&oacute;lnopolskim i miÄdzynarodowym&rdquo; kwotÄ w wysokoĹci zaledwie 100 tysiÄcy zĹotych, mniej o kolejne 100 tysiÄcy w stosunku do ubiegĹego roku.</p>\r\n<p>Mniejsze sÄ Ĺrodki budĹźetu Gminy Krak&oacute;w w zakresie upowszechniania kultury fizycznej w ramach zadaĹ priorytetowych dzielnic, o prawie 28 procent. Do tego zadania przystÄpiĹo tylko 5 dzielnic Krakowa &ndash; VII, IX, XII, XIV i XV. Gdzie reszta?</p>\r\n<p>OpowiedziaĹ mi znajomy, Ĺźe kiedy pytaĹ jednego z radnych miejskich, tuĹź po zatwierdzeniu budĹźetu Gminy Krak&oacute;w, dlaczego tak dotkliwie zmniejsza siÄ kolejny raz dotacje na kulturÄ fizycznÄ wĹr&oacute;d mĹodzieĹźy, to usĹyszaĹ w odpowiedzi &ndash; musicie zapĹaciÄ za wydatki na stadiony piĹkarskie. Zgody nie mam na ujawnienie nazwiska radnego &ndash; autora tejĹźe odpowiedzi, ponoÄ siÄ wahaĹ, a to r&oacute;wnieĹź z tego powodu, Ĺźe ma ĹwiadomoĹÄ swojej racji, lecz ta moĹźe byÄ niepopularna wĹr&oacute;d kibic&oacute;w piĹki noĹźnej. No c&oacute;Ĺź, jest w tym prawda, ale jest teĹź zĹoĹliwoĹÄ. Nie ma jednak odpowiedzialnoĹci za sportowÄ mĹodzieĹź i dzieci.</p>\r\n<p>Za to mamy gminnÄ biedÄ, kt&oacute;ra nie tylko zatrzyma rozw&oacute;j sportowy czĹonk&oacute;w klub&oacute;w, ale zniszczy to co budowano przez dĹugie lata w wielu oĹrodkach piĹkarskich Krakowa, maĹych i duĹźych. Mniejsze dotacje samorzÄd&oacute;w, to r&oacute;wnieĹź mniejsze zainteresowanie sponsor&oacute;w i wiÄkszy b&oacute;l gĹowy dziaĹaczy. Oby tym ostatnim wystarczyĹo odpowiedzialnoĹci i wytrwaĹoĹci na ten trudny czas w swoich organizacjach sportowych.</p>\r\n<p><span>ZDZISĹAW WAGNER&nbsp;</span></p>', 1, 13412212, 1377209921, 'yes', 'no', 4, NULL, '', '', NULL),
(64, 'UDANY POCZÄTEK TRAMPKARZY', '<p style="text-align: justify;">Tramkarze Tramwaju w 2. kolejce nowego sezonu pokonali AlfÄ Morawice 8:3. PiÄÄ bramek dla DTS-u strzeĹiĹ Krystian BiaĹosiewicz, a pozostaĹe trafienia zanotowali: Jacek Sendor, MikoĹaj Knurowski i Mateusz BrygoĹa.</p>', 1, 1378757625, 1378787745, 'yes', 'no', 4, NULL, '', '', NULL),
(65, 'PECHOWA PORA??KA ??AK??W', '<p style="text-align: justify;">Wyjazdowy mecz ??ak&oacute;w Tramwaju z Lotnikiem Kryspin&oacute;w zako??czy?? siï¿½? minimalnï¿½? pora??kï¿½? naszego zespo??u. Rywale zwyciï¿½???yli 8:7, strzelajï¿½?c zwyciï¿½?skï¿½? bramkï¿½? w ostatnich sekundach spotkania. Sze??ï¿½? goli dla DTS-u strzeli?? Jan - si&oacute;dmï¿½? bramkï¿½? do??o??y?? Kamil Rojewski.</p>', 1, 1378757993, 1379250415, 'yes', 'no', 4, '', 'cf00a_nemo.jpg', '', NULL),
(66, 'afaf', '<p>adada</p>', 1, 1379251356, 1401847211, 'yes', 'no', 2, 'trening', '7e240_piramida.jpg', 'http://www.dailymotion.com/embed/video/k4RtDzR4xWqM7S38T1v', 'a3982_money.xlsx');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pic`
--

CREATE TABLE IF NOT EXISTS `pic` (
  `pic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pic_gallery_id` int(10) unsigned NOT NULL,
  `pic_name` varchar(255) NOT NULL,
  PRIMARY KEY (`pic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleId` int(11) NOT NULL AUTO_INCREMENT,
  `scheduleDate` varchar(20) NOT NULL,
  `scheduleDateName` varchar(255) NOT NULL,
  `scheduleGameTime` varchar(255) NOT NULL,
  `scheduleMeetTime` varchar(255) NOT NULL,
  `scheduleTeamHosts` varchar(255) NOT NULL,
  `scheduleTeamAway` varchar(255) NOT NULL,
  `scheduleScore` varchar(255) NOT NULL,
  `schedulePlayers` text NOT NULL,
  `scheduleUpdate` int(11) NOT NULL,
  `scheduleType` enum('orlik','zak','mlodzik','trampkarz') NOT NULL,
  PRIMARY KEY (`scheduleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `schedule`
--

INSERT INTO `schedule` (`scheduleId`, `scheduleDate`, `scheduleDateName`, `scheduleGameTime`, `scheduleMeetTime`, `scheduleTeamHosts`, `scheduleTeamAway`, `scheduleScore`, `schedulePlayers`, `scheduleUpdate`, `scheduleType`) VALUES
(1, '10.04.2014', 'aa', 'aa', 'aa', 'aa', 'a', 'aa', 'aa', 1396991085, 'zak'),
(3, '10.04.2014', 'aa', 'aa', 'aa', 'aa', 'a', 'aa', 'aa', 1396990092, 'orlik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `score_id` int(11) NOT NULL AUTO_INCREMENT,
  `score_team_win` varchar(255) NOT NULL,
  `score_team_win_goals` int(11) NOT NULL,
  `score_team_loss` varchar(255) NOT NULL,
  `score_team_loss_goals` int(11) NOT NULL,
  `score_time` varchar(255) NOT NULL,
  `score_insert` int(11) NOT NULL,
  `score_category` enum('t','z','o','m') NOT NULL,
  PRIMARY KEY (`score_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Zrzut danych tabeli `score`
--

INSERT INTO `score` (`score_id`, `score_team_win`, `score_team_win_goals`, `score_team_loss`, `score_team_loss_goals`, `score_time`, `score_insert`, `score_category`) VALUES
(1, 'Tramwaj Krakow', 4, 'Bronowianka II Krakow (dziewczeta)', 2, 'no', 1363474889, 't'),
(2, 'Borek II Krakow', 3, 'Tramwaj Krakow', 0, 'no', 1363474889, 'm'),
(3, 'Sokol Kocmyrzow', 9, 'Tramwaj Krakow', 2, 'no', 1341984914, 'z'),
(4, 'Proszowianka Proszowice', 15, 'Tramwaj Krakow', 3, 'no', 1341984914, 'o'),
(5, 'MaÅ‚y Tramwaj', 12, 'BÄ…ki', 2, '11-09-2013', 0, 't'),
(6, 'MaÅ‚y Tramwaj', 0, 'BÄ…ki', 12, '03-09-2013', 1379072102, 't'),
(7, 'MaÅ‚y', 33, '11212', 22, '11-09-2013', 1379072132, 'm'),
(8, 'adad', 2, 'afafafaf', 2, '17.09.2013', 1379072509, 't'),
(9, 'MaÅ‚y Tramwaj', 0, 'Bronowianka II ', 2, '02.09.2013', 1379074770, 't'),
(10, 'MaÅ‚y Tramwaj', 3, 'Bronowianka II ', 22, '01.09.2013', 1379075278, 't'),
(11, 'MaÅ‚y Tramwaj', 2, 'Bronowianka II ', 12, '11.09.2013', 1379075296, 'z'),
(12, 'MaÅ‚y Tramwaj', 0, 'Bronowianka II ', 0, '18.09.2013', 1379075722, 'z'),
(13, '', 0, '', 0, '', 1396989087, 't'),
(14, '', 0, '', 0, '', 1396989168, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_desc` text NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_img` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_phone`, `user_desc`, `user_mail`, `user_img`) VALUES
(1, 'Dawid WaÅ›ko', '791', '', '', 'wasiek.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
