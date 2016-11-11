-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2013 at 01:18 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projekat`
--
CREATE DATABASE IF NOT EXISTS `projekat` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `projekat`;

-- --------------------------------------------------------

--
-- Table structure for table `kategorijeproizvoda`
--

CREATE TABLE IF NOT EXISTS `kategorijeproizvoda` (
  `idKategorije` int(11) NOT NULL AUTO_INCREMENT,
  `PunNaziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `KratakNaziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idKategorije`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `kategorijeproizvoda`
--

INSERT INTO `kategorijeproizvoda` (`idKategorije`, `PunNaziv`, `KratakNaziv`) VALUES
(1, 'Specijalni sefovi', 'Specijalni sefovi'),
(2, 'Kancelarijski (nameštaj) sefovi', 'Kancelarijski sefovi'),
(3, 'Menadžerski sefovi', 'Menadžerski sefovi'),
(4, 'Dvodelni sefovi', 'Dvodelni sefovi'),
(5, 'Blagajnički sefovi za zaštitu u slučaju pljačke', 'Blagajnički sefovi'),
(6, 'Ormari za dokumenta', 'Ormari za dokumenta'),
(7, 'TSS sefovi (trezorski ormani)', 'TSS sefovi'),
(8, 'Ormari za oružje (3,5,7,10 pušaka)', 'Ormari za oružje'),
(9, 'Sefovi za oružje', 'Sefovi za oružje');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `idKorisnika` int(11) NOT NULL AUTO_INCREMENT,
  `korisnickoIme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vremeRegistracije` int(11) NOT NULL,
  `vremePristupa` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `mobilni` int(11) NOT NULL,
  PRIMARY KEY (`idKorisnika`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnika`, `korisnickoIme`, `lozinka`, `mail`, `vremeRegistracije`, `vremePristupa`, `status`, `mobilni`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'test@test.com', 1376215723, 1387120754, 1, 695412333),
(2, 'kupac', '81f6498b9e1ef7a9b29885d9ca255ccc3419ca90', 'kupac@gmail.com', 1376215723, 1387116934, 1, 695412333);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_uloga`
--

CREATE TABLE IF NOT EXISTS `korisnik_uloga` (
  `idKorisnika` int(11) NOT NULL,
  `idUloge` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik_uloga`
--

INSERT INTO `korisnik_uloga` (`idKorisnika`, `idUloge`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `narudzbina_proizvod`
--

CREATE TABLE IF NOT EXISTS `narudzbina_proizvod` (
  `idNarudzbine` int(11) NOT NULL,
  `idProizvoda` int(11) NOT NULL,
  `boja` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `narudzbina_proizvod`
--

INSERT INTO `narudzbina_proizvod` (`idNarudzbine`, `idProizvoda`, `boja`, `kolicina`) VALUES
(45, 15, 'Antracit', 1),
(45, 17, 'Crna', 1),
(46, 9, 'Antracit', 1),
(46, 10, 'Antracit', 1),
(46, 16, 'Antracit', 1),
(47, 6, 'Antracit', 4),
(47, 7, 'Antracit', 2),
(47, 16, 'Antracit', 7),
(48, 8, 'Antracit', 9),
(48, 21, 'Crna', 4),
(50, 4, 'Antracit', 10),
(50, 19, 'selected', 6);

-- --------------------------------------------------------

--
-- Table structure for table `narudzbine`
--

CREATE TABLE IF NOT EXISTS `narudzbine` (
  `idNarudzbine` int(11) NOT NULL AUTO_INCREMENT,
  `idKorisnika` int(11) NOT NULL,
  `datum` int(20) NOT NULL,
  `cena` int(11) NOT NULL,
  `poslato` int(11) NOT NULL,
  `datumP` int(11) NOT NULL,
  PRIMARY KEY (`idNarudzbine`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `narudzbine`
--

INSERT INTO `narudzbine` (`idNarudzbine`, `idKorisnika`, `datum`, `cena`, `poslato`, `datumP`) VALUES
(45, 2, 1386535282, 1400, 1, 1387138381),
(46, 1, 1386750975, 6290, 0, 0),
(47, 1, 1386805505, 18330, 0, 0),
(48, 2, 1387117032, 18660, 1, 1387139290),
(50, 1, 1387140116, 24600, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE IF NOT EXISTS `proizvodi` (
  `idProizvoda` int(11) NOT NULL AUTO_INCREMENT,
  `idKategorije` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slikam` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slikav` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `boja` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brava` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opis` text COLLATE utf8_unicode_ci,
  `tip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vs` int(11) NOT NULL,
  `ss` int(11) NOT NULL,
  `ds` int(11) NOT NULL,
  `vu` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `su` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `du` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `police` int(11) DEFAULT NULL,
  `tezina` int(11) NOT NULL,
  `zapremina` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datum` datetime NOT NULL,
  `unutrasnjaBrava` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zabravljivanje` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idProizvoda`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`idProizvoda`, `idKategorije`, `naziv`, `slikam`, `slikav`, `cena`, `boja`, `brava`, `opis`, `tip`, `vs`, `ss`, `ds`, `vu`, `su`, `du`, `police`, `tezina`, `zapremina`, `datum`, `unutrasnjaBrava`, `zabravljivanje`) VALUES
(4, 1, 'EURON 110 P/2S', '/images/product/euron110p2s_o_m.jpg', '/images/product/euron110p2s_o_v.jpg', 2100, 'Antracit', '', 'EURON 110 P/2S', 'Sidrenje u pod', 1030, 600, 500, '910', '480', '360', 2, 248, '151', '2013-12-16 14:34:25', '', 'u 4 smera i 14 tačaka'),
(6, 1, 'EURON 3300 ME', '/images/product/euron3300me_o_m.jpg', '/images/product/euron3300me_o_v.jpg', 2900, 'Antracit', 'Mehanička Kaba – Mauer više klase + Elektronska Time Lock Sophia + unutrašnja od ormarića - Eurolock ', 'III - viši bezbedonosni stepen. Procesor upravlja bravom Timelock - Sophia, na glavnim vratima.\r\nSertifikat: III stepen po EURO normi 1143 - …, TOP SECRET.\r\nUnutrašnjost sefa podeljena je na 2 mehaničkom bravom zaključavajuća dela.\r\nElektronska brava,odbravljuje vrata .Programiranje radnog vremena sefa. Programiranje 1 korisnik ili princip saključarstvo.\r\n10 kodova - 1 administrator.Programiranje trenutne ili vremenske brave.\r\nOčitavanje datoteke : 4090 radnji sa sefom .\r\nSef je 4 – ro SLOJAN -između slojeva VATROOTPORNA SMEŠA ', 'Sidrenje u pod', 1400, 610, 530, '1230', '470', '295', 4, 420, '188', '2000-01-01 00:00:00', NULL, 'u 4 smera i 10 tačaka '),
(7, 1, 'EURON 110 P / P', '/images/product/euron110pp_o_m.jpg', '/images/product/euron110pp_o_v.jpg', 2000, 'Antracit', NULL, 'Sertifikovan u II bezbednosni stepen. Telo sefa troslojno, vrata 4 – ro slojna. Procesor upravlja elektronskom bravom Timelok – Sophia, na glavnim vratima. Unutrašnjost sefa: podešavajuće police po visini + zaključavajući deo U unutrašnji deo se mogu smestiti registratori u 2 reda – oko 12-14 komada. El. Bravom se mogu otvarati vrata pomoću 10 sedmocifrenih kodova, od kojih je 1 Administrativni. Sef ima mogućnost programiranja blokade, u vanradno vreme (praznici, godišnji odmor, vikendi …), i neće se otvoriti uprkos zadatom kodu. Opremljen je meh. bravom Kaba – Mauer za tkz. Nužno otvaranje tj. brava je u funkciji Master ključa. Datoteka pamti zadnjih 4900 radnji sa sefom (otvaranje, zatvaranje, promena koda … ), kako sa glavnim vratima, tako i sa oba unutrašnja dela po datumu i vremenu. ', 'Sidrenje u pod', 1100, 600, 500, '910', '480', '360', 2, 253, '151', '2013-11-05 09:27:20', NULL, 'u 4 smera i 14 tačaka '),
(8, 1, 'EURON 3120 M ', '/images/product/euron3120m_o_m.jpg', '/images/product/euron3120m_o_v.jpg', 1900, 'Antracit', 'Kaba – Mauer više klase ', 'Specijalan sef , višeg bezbednosnog stepena. po EURO normi 1143-...,TOP SECRET …\r\nSertifikat: III stepen po EURO normi 1143 - …, TOP SECRET.\r\nSef je 4 – ro SLOJAN -između slojeva VATROOTPORNA SMEŠA-ODLIČNA VATROOTPORNOST ', 'Sidrenje u pod', 990, 610, 485, '850', '470', '300', 1, 253, '120', '2013-11-09 14:21:19', NULL, 'u 4 smera i 10 tačaka'),
(9, 1, 'EURON 3200 ME / P', '/images/product/euron3200me_o_m.jpg', '/images/product/euron3200me_o_v.jpg', 2600, 'Antracit', 'Mehanička Kaba – Mauer više klase + Elektronska Time Lock Sophia', 'III - viši bezbedonosni stepen. Procesor upravlja bravom Timelock - Sophia, na glavnim vratima.\r\nSertifikat: III stepen po EURO normi 1143 - …, TOP SECRET.\r\nUnutrašnjost sefa podeljena je na 2 mehaničkom bravom zaključavajuća dela.\r\nElektronska brava,odbravljuje vrata .Programiranje radnog vremena sefa. Programiranje 1 korisnik ili princip saključarstvo.\r\n10 kodova - 1 administrator.Programiranje trenutne ili vremenske brave.\r\nOčitavanje datoteke : 4090 radnji sa sefom .\r\nSef je 4 – ro SLOJAN -između slojeva VATROOTPORNA SMEŠA ', 'Sidrenje u pod', 1400, 610, 530, '1230', '470', '295', 4, 420, '188', '2013-11-05 08:21:26', NULL, 'u 4 smera i 10 tačaka '),
(10, 1, 'EURON 3400 ME', '/images/product/euron3400me_o_m.jpg', '/images/product/euron3400me_o_v.jpg', 3300, 'Antracit', 'Mehanička Kaba – Mauer više klase + Elektronska Time Lock Sophia + unutrašnja od ormarića - Eurolock ', 'III - viši bezbedonosni stepen. Procesor upravlja bravom Timelock - Sophia, na glavnim vratima.\r\nSertifikat: III stepen po EURO normi 1143 - …, TOP SECRET.\r\nUnutrašnjost sefa podeljena je na 2 mehaničkom bravom zaključavajuća dela.\r\nElektronska brava,odbravljuje vrata .Programiranje radnog vremena sefa. Programiranje 1 korisnik ili princip saključarstvo.\r\n10 kodova - 1 administrator.Programiranje trenutne ili vremenske brave.\r\nOčitavanje datoteke : 4090 radnji sa sefom .\r\nSef je 4 – ro SLOJAN -između slojeva VATROOTPORNA SMEŠA ', 'Sidrenje u pod', 1750, 730, 620, '1580', '560', '440', 2, 660, '390', '2013-11-13 08:21:52', NULL, 'u 4 smera i 10 tačaka'),
(11, 1, 'NT 39 ME TimeLock SOPHIA', '/images/product/NT-39-ME-TimeLock-SOPHIA_m.jpg', '/images/product/NT-39-ME-TimeLock-SOPHIA_v.jpg', 600, 'Antracit, Crna', 'Elektronska Time Lock Sophia ', 'Karakteristike: - 10 kodova\r\n- otvaranje pomoću 1 koda ili saključarstvo\r\n- trenutna ili vremensak brava\r\n- datoteka radnji ( 4095 radnji )\r\n- programiranje radnog vremena sefa ', NULL, 435, 435, 442, '395', '395', '370', 1, 65, '58', '2013-11-04 13:36:32', NULL, NULL),
(12, 1, 'NT 61 ME TimeLock SOPHIA', '/images/product/nt61metls_o_m.jpg', '/images/product/nt61metls_o_v.jpg', 670, 'Antracit, Crna', 'Kaba-Mauer + elektronska Time Lock Sophia + unutrašnja Eurolock ', 'Karakteristike: - 10 kodova\r\n- otvaranje pomoću 1 koda ili saključarstvo\r\n- trenutna ili vremensak brava\r\n- datoteka radnji ( 4095 radnji )\r\n- programiranje radnog vremena sefa ', NULL, 652, 435, 442, '610', '395', '370', 1, 95, '29+60', '2013-11-01 12:33:37', NULL, NULL),
(13, 2, 'NT 22 M', '/images/product/nt_22_m_m.jpg', '/images/product/nt_22_m_v.jpg', 230, 'Antracit, Crna', 'KABA - MAUER ', 'NT 22 M je najmanji sef iz NT linije. Koristan je za čuvanje dokumenata formata A5, vrednosti manjih dimenzija, novčanica, kratkog oružja itd.', NULL, 282, 352, 257, '240', '310', '185', 1, 37, '14', '2013-11-20 09:29:37', NULL, NULL),
(14, 2, 'NT 22 ME', '/images/product/nt22me_o_m.jpg', '/images/product/nt22me_o_v.jpg', 370, 'Antracit, Crna', 'KABA - MAUER + SAFEtronics ®', NULL, NULL, 282, 352, 257, '240', '310', '185', 1, 37, '14', '2013-11-13 16:57:38', NULL, NULL),
(15, 3, 'M 12', '/images/product/m_12_m.jpg', '/images/product/m_12_v.jpg', 600, 'Antracit', 'KABA - MAUER + SAFEtronics ®', 'SERIJA M12 se proizvodi u ELEKTRONSKOJ (M) i MEHANIČKOJ (MT) varijanti M12 je opremljen elektronskom i mehaničkom bravom (sa 2 ključa). Kod njega se, za razliku od mehaničke varijante, ključevi NE koriste za otključavanje-zaključavanje sefa, već samo u slučajevima kada nije moguće otvoriti sef elektronskom bravom (blokada, baterije nisu zamenjene na vreme, provalnik razbio bravu, ...). Spada u grupu manjih sefova korisnih je čuvanje gotovine, pečata, ... ', NULL, 460, 300, 350, '360', '260', '220', 1, 45, '21', '2013-11-22 08:20:25', NULL, NULL),
(16, 3, 'MT 12', '/images/product/mt_12_m.jpg', '/images/product/mt_12_v.jpg', 390, 'Antracit', 'KABA - MAUER', 'MT12 se zaključava samo mehanički, leptir bravom MAUER. Unutrašnji prostor i dizajn su isti kao kod elektronske varijante. ', NULL, 460, 300, 350, '360', '260', '220', 1, 45, '21', '2013-11-13 05:35:33', NULL, NULL),
(17, 4, 'NTR 61M/61M', '/images/product/ntr_61m-61m_m.jpg', '/images/product/ntr_61m-61m_v.jpg', 800, 'Antracit, Crna', 'MAUER - MAUER', NULL, NULL, 1282, 435, 442, '395, 610', '395, 395', '370, 370', 2, 170, '89, 89', '2013-11-22 06:25:21', 'BURG', NULL),
(18, 4, 'TD 130/46M', '/images/product/td_130-46_m.jpg', '/images/product/td_130-46_v.jpg', 1260, 'Antracit, Crna', 'KABA - MAUER Spodok / MAUER', 'TD 130/46M se sastoji od 2 sefa, drugog nivoa bezbednosti: TN 67/46 jedan iznad drugog i ima dvoja vrata, sa po jednom bravom mehaničkom bravom MAUER. Donji sef ima kasicu a gornji je bez kasice i malo je veći.', NULL, 1300, 460, 460, '580, 550', '340, 340', '300, 300', 2, 205, '59, 56', '2013-11-21 04:25:33', NULL, NULL),
(19, 5, 'SATT 03 (vremenski sef)', '/images/product/satt03_m.jpg', '/images/product/satt03_o_v.jpg', 600, '', '', 'SATT 03 je VREMENSKI SEF koji onemogućava otimanje ili krađu novca od blagajnika, u toku radnog vremena. Blagajnik odlaže novac u sef , a na pultu drži samo manji deo novca , radi vraćanja kusura &amp;amp;amp;hellip;\r\n\r\nOdloženi novac nije moguće ukrasti, a nije moguće ni prisiliti osobu koja radi sa novcem, da izvadi novac iz sefa, jer je brava vremenska a razbojnik nema vremena da čeka da se brava odbravi.\r\n\r\nELEKTRONSKA VREMENSKA BRAVA zaključava sef i uz njega se dobijaju 3 elektronska beskontaktna ključa:\r\nUSER - za blagajnika, sa vremenskim ka&amp;amp;amp;scaron;njenjem otvaranja,\r\nMASTER - za poslovođu, sa vremenskim ka&amp;amp;amp;scaron;njenjem otvaranja,\r\nFLASH - za direktora ili menadžera bezbednosti, koji otvara trenutno.\r\nNa 1 sef se može programirati samo 1 FLASH I 1 MASTER KLJUČ.\r\n1 FLASH i 1 MASTER se mogu programirati na bezbroj sefova\r\n\r\nDok se blagajnik iz 1. smene ne odjavi , blagajnik iz druge smene se ne može prijaviti na sef &amp;amp;amp;hellip;\r\n\r\nMogućnost povezivanja sa alarmom.\r\n\r\nDatoteka zadnjih 4900 radnji sa sefom', '', 600, 200, 250, '', '', '', 0, 30, '', '2013-12-15 23:24:23', '', ''),
(20, 5, 'Casino V (vremenski sef)', '/images/product/casinov1_m.jpg', '/images/product/casinov1_v.jpg', 680, NULL, NULL, 'Karakteristike iste kao za SATT 03.\r\n\r\nRazlika: glavna vrata imaju 2 otvora, kompatibilna sa otvorima na unutrašnjim vratima (2 komada).\r\n\r\nUnutrašnja vrata imaju mehaničku bravu.\r\n\r\nSuština: razdvajanje 2 blagajne ...', NULL, 600, 300, 375, NULL, NULL, NULL, NULL, 45, NULL, '2013-11-20 10:21:28', NULL, NULL),
(21, 5, 'NT 39Msv', '/images/product/nt39mesv1_m.jpg', '/images/product/nt39mesv1_v.jpg', 390, 'Crna', 'KABA - MAUER ', 'NT 39Msv - verzija sa mehaničkom bravom\r\nBLAGAJNIČKI SEFOVI sa VALJKOM - NT 39Msv i NT 39MEsv imaju sertifikat 1. klase bezbednosti. Standardna boja je crna. Sefovi su opremljeni leptir bravom MAUER, sa mehanizmom zaključavanja u pet tačaka.\r\n\r\nKonstrukcija zidova sefa je dvoslojna, od čeličnog lima debljine 3 i 2 mm. Debljina vrata je 10 mm + zaštita brave. Na zadnjem zidu sefa se nalaze dva otvora za učvršćenje sefa za zid, kako ne bi bilo moguće odneti ga.\r\n\r\nNajveće prednosti ovih sefova su: mogućnost ubacivanja novca u sef pomoću valjka, što ne zahteva da blagajnik zna šifru, jednostavnost rukovanja i niska cena u odnosu na bezbednost i funkcionalnost koju pruža. Za otvaranje sefa se koristi elektronska brava a mehanička brava se koristi samo u slučaju da sef nije moguće otvoriti elektronskom bravom (provalnik razbio bravu, iscurila baterija ili nisu zamenjena na vreme,...).\r\n\r\nMala slova "sv" u oznaci sefa pokazuju da je u gornjem delu sefa ugrđen valjak za ubacivanje svežnjeva novčanica, koje padaju u kasicu sa zaklju-čavanjem. ', NULL, 435, 435, 442, '395', '395', '370', 1, 67, '55', '2013-11-13 06:16:28', NULL, NULL),
(22, 5, 'NT 39MEsv', '/images/product/nt39mesv2_m.jpg', '/images/product/nt39mesv2_v.jpg', 530, 'Crna', 'KABA - MAUER ', 'NT 39MEsv - verzija sa mehaničkom i elektronskom bravom\r\n\r\nBLAGAJNIČKI SEFOVI sa VALJKOM - NT 39Msv i NT 39MEsv imaju sertifikat 1. klase bezbednosti. Standardna boja je crna. Sefovi su opremljeni leptir bravom MAUER, sa mehanizmom zaključavanja u pet tačaka.\r\n\r\nKonstrukcija zidova sefa je dvoslojna, od čeličnog lima debljine 3 i 2 mm. Debljina vrata je 10 mm + zaštita brave. Na zadnjem zidu sefa se nalaze dva otvora za učvršćenje sefa za zid, kako ne bi bilo moguće odneti ga.\r\n\r\nNajveće prednosti ovih sefova su: mogućnost ubacivanja novca u sef pomoću valjka, što ne zahteva da blagajnik zna šifru, jednostavnost rukovanja i niska cena u odnosu na bezbednost i funkcionalnost koju pruža. Za otvaranje sefa se koristi elektronska brava a mehanička brava se koristi samo u slučaju da sef nije moguće otvoriti elektronskom bravom (provalnik razbio bravu, iscurila baterija ili nisu zamenjena na vreme,...).\r\n\r\nMala slova "sv" u oznaci sefa pokazuju da je u gornjem delu sefa ugrđen valjak za ubacivanje svežnjeva novčanica, koje padaju u kasicu sa zaklju-čavanjem. ', NULL, 435, 435, 442, '395', '395', '370', 1, 67, '55', '2013-11-21 17:42:30', NULL, NULL),
(23, 6, 'MAXI 5 MS ', '/images/product/maxi5ms_o_m.jpg', '/images/product/maxi5ms_o_v.jpg', 390, 'Antracit', 'KABA - MAUER', 'Jednoslojan sertifikovan ', NULL, 1400, 500, 350, '1395', '495', '295', 1, 80, '203', '2013-11-21 08:39:22', 'BURG', NULL),
(24, 6, 'IVETA SOs (IVETA 5 M)', '/images/product/iveta5m_o_m.jpg', '/images/product/iveta5m_o_v.jpg', 600, 'Antracit', 'KABA - MAUER', 'IVETA SOs - Sertifikovan dvoslojni ormar za čuvanje dokumenata, sa meha-ničkom bravom. Poseduje mehanizam za zaključavanje u tri smera.\r\nIzmeđu slojeva se nalazi vatrootporna smeša. ', NULL, 1436, 536, 368, '1390', '494', '300', 1, 110, '206', '2013-11-13 17:26:08', 'BURG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE IF NOT EXISTS `uloge` (
  `idUloge` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nazivMalaSlova` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idUloge`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`idUloge`, `naziv`, `nazivMalaSlova`) VALUES
(1, 'Administrator', 'administrator'),
(2, 'Kupac', 'kupac');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
