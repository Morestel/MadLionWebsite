-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: mt05697s
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `athlete`
--

DROP TABLE IF EXISTS `athlete`;
-- /*!40101 SET @saved_cs_client     = @@character_set_client */;
-- /*!40101 SET character_set_client = utf8 */;
CREATE TABLE `athlete` (
  `numathlete` int(20) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `numnation` int(10) DEFAULT NULL,
  PRIMARY KEY (`numathlete`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `athlete`
--


LOCK TABLES `athlete` WRITE;
/*!40000 ALTER TABLE `athlete` DISABLE KEYS */;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/athlete.txt' INTO TABLE athlete FIELDS TERMINATED BY ', ' OPTIONALLY ENCLOSED BY '"'  LINES TERMINATED BY '\r\n'STARTING BY 'AT';

show warnings;
/*!40000 ALTER TABLE `athlete` ENABLE KEYS */;
UNLOCK TABLES;
select * from athlete;

--
-- Table structure for table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epreuve` (
  `numepreuve` int(10) NOT NULL,
  `libelle` varchar(40) DEFAULT NULL,
  `genre` enum('M','F') DEFAULT NULL,
  `typeclass` enum('I','E') DEFAULT NULL,
  `numsport` int(10) DEFAULT NULL,
  PRIMARY KEY (`numepreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epreuve`
--

LOCK TABLES `epreuve` WRITE;
/*!40000 ALTER TABLE `epreuve` DISABLE KEYS */;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/epreuve.txt' INTO TABLE epreuve FIELDS TERMINATED BY ', ' ENCLOSED BY '"'  LINES TERMINATED BY ');\r\n' STARTING BY '(';
/*!40000 ALTER TABLE `epreuve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jeux` (
  `numjeux` int(5) NOT NULL,
  `pays` varchar(40) DEFAULT NULL,
  `ville` varchar(40) DEFAULT NULL,
  `type` varchar(1) DEFAULT NULL,
  `annee` int(4) DEFAULT NULL,
  PRIMARY KEY (`numjeux`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jeux`
--



LOCK TABLES `jeux` WRITE;
/*!40000 ALTER TABLE `jeux` DISABLE KEYS */;

/*!40000 ALTER TABLE `jeux` ENABLE KEYS */;
UNLOCK TABLES;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/jeux.txt' INTO TABLE jeux FIELDS TERMINATED BY '", "' ENCLOSED BY '"' LINES TERMINATED BY '\r\n' STARTING BY '"';

--
-- Table structure for table `nation`
--

DROP TABLE IF EXISTS `nation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nation` (
  `numnation` int(10) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `continent` enum('Europe','Asie','Afrique','Amerique','Oceanie') DEFAULT NULL,
  PRIMARY KEY (`numnation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nation`
--

LOCK TABLES `nation` WRITE;
/*!40000 ALTER TABLE `nation` DISABLE KEYS */;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/nation.txt' INTO TABLE nation FIELDS TERMINATED BY '/ ' LINES TERMINATED BY '\r\n' IGNORE 2 ROWS;
/*!40000 ALTER TABLE `nation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participe`
--

DROP TABLE IF EXISTS `participe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participe` (
  `numjeux` int(5) NOT NULL,
  `numnation` int(10) NOT NULL,
  PRIMARY KEY (`numjeux`,`numnation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participe`
--

LOCK TABLES `participe` WRITE;
/*!40000 ALTER TABLE `participe` DISABLE KEYS */;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/participe.txt' INTO TABLE participe FIELDS TERMINATED BY ', ' ENCLOSED BY '' LINES TERMINATED BY ');\r\n' STARTING BY '(';
/*!40000 ALTER TABLE `participe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultat` (
  `numjeux` int(5) NOT NULL,
  `numepreuve` int(10) NOT NULL,
  `numathlete` int(20) NOT NULL,
  `medaille` ENUM('O', 'A', 'B'),
  PRIMARY KEY (`numjeux`,`numepreuve`,`numathlete`,`medaille`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultat`
--

LOCK TABLES `resultat` WRITE;
/*!40000 ALTER TABLE `resultat` DISABLE KEYS */;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/resultat.txt' INTO TABLE resultat FIELDS TERMINATED BY ',, ' OPTIONALLY ENCLOSED BY '''' LINES TERMINATED BY ');\r\n' starting by '(';
show warnings;
/*!40000 ALTER TABLE `resultat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport` (
  `numsport` int(10) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`numsport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport`
--

LOCK TABLES `sport` WRITE;
/*!40000 ALTER TABLE `sport` DISABLE KEYS */;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/sport.txt' INTO TABLE sport FIELDS TERMINATED BY ', ' LINES TERMINATED BY '\r\n';
show warnings;
/*!40000 ALTER TABLE `sport` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-08 16:28:35

select * from jeux;
select * from nation;
select * from athlete;
select * from epreuve;
select * from participe;
select * from resultat;
select * from sport;


create view vuejeux as
select *
from jeux
where pays = 'France';

select *
from vuejeux;

insert into vuejeux values('6','France','Tokyo','H','1999');/* ne marche pas si pays != 'France' */

delete from vuejeux where numjeux =1;
/* insert et delete possibles sur 1 table vue*/

select *
from vuejeux;


create view nationathlete as
select athlete.nom as athlete,nation.nom as nation
from athlete,nation
where athlete.numnation=nation.numnation;

select * from nationathlete;

insert into nationathlete values('Hugo','Italie');

insert into athlete values('11','Hugo Upo','4');

delete from nationathlete where athlete = 'Hugo Upo';
delete from athlete where nom ='Hugo Upo';

select * from nationathlete;

/*load data infile ne marche pas pour lukas zala car son numathlete est déjà attribué
*/

/* insert sur vue jointée ne marche pas ! 
ERROR 1394 (HY000): Can not insert into join view 'mt05697s.nationathlete' without fields list

pareil pour delete :
ERROR 1395 (HY000): Can not delete from join view 'mt05697s.nationathlete'

*/

set autocommit=1;

start transaction;

insert into athlete values('12','Kevin Gourg','1');
select * from athlete;

rollback;

select * from athlete;

start transaction;

insert into athlete values('12','Kevin Gourg','1');
select * from athlete;

commit;


DELETE FROM athlete;

LOCK TABLES `athlete` WRITE;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/Big+athlete.txt' INTO TABLE athlete FIELDS TERMINATED BY '\t' OPTIONALLY ENCLOSED BY ' '  LINES TERMINATED BY '\r\n' IGNORE 1 ROWS;
UNLOCK TABLES;
select * from athlete;


DELETE FROM nation;
LOCK TABLES nation WRITE;
LOAD DATA LOCAL INFILE '~/L2/BDD/TP2/Big+nation.txt' INTO TABLE nation FIELDS TERMINATED BY '\t' OPTIONALLY ENCLOSED BY ' '  LINES TERMINATED BY '\r\n' IGNORE 2 ROWS;

UNLOCK TABLES;
select * from nation;

select benchmark(1000000000, 'select * from nation where continent="Europe"'); /* 3 secondes approximativement de chargement */


/* CHECK TABLE vérifie les erreurs d'une ou de plusieurs tables. CHECK TABLE peut également rechercher des problèmes dans les vues, telles que les tables référencées dans la définition de vue qui n'existent plus. */

/* OPTIMIZE TABLE réorganise le stockage physique des données de table et des données d'index associées, afin de réduire l'espace de stockage et d'améliorer l'efficacité des E / S lors de l'accès à la table. Les modifications exactes apportées à chaque table dépendent du moteur de stockage utilisé par cette table. */



/* +-----------------+----------+----------+-------------------------------------------------------------------+
| Table           | Op       | Msg_type | Msg_text                                                          |
+-----------------+----------+----------+-------------------------------------------------------------------+
| mt05697s.nation | optimize | note     | Table does not support optimize, doing recreate + analyze instead |
| mt05697s.nation | optimize | status   | OK                                                                |
+-----------------+----------+----------+-------------------------------------------------------------------+
*/

/*
select * from nation; 

*/

delete from nation
where continent = "Amerique";

select* from nation;
select benchmark(1000000000, 'select * from nation where continent="Europe"');
/*
optimize table nation;

select * from nation;

*/
