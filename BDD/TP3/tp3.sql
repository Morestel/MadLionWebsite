
DROP FUNCTION INSERT_PAYS;
 
DELIMITER |
CREATE FUNCTION INSERT_PAYS(nom VARCHAR(32),code VARCHAR(4),capitale VARCHAR(35),superficie INT,population INT,gouvernement VARCHAR(120),date_independance DATE)
RETURNS INT
BEGIN

DECLARE EXIT HANDLER FOR SQLSTATE '23000'
BEGIN
	RETURN -1;
END;
	INSERT INTO country(Name,Code,Capital,Area,Population) VALUES(nom,code,capitale,superficie,population);
	INSERT INTO politics VALUES(code,date_independance,gouvernement);
RETURN 1;
END|
DELIMITER ;


DELETE FROM politics WHERE Country ='PUP';
DELETE FROM country WHERE Name='Hugoslavie';

SELECT INSERT_PAYS('Hugoslavie','PUP','Noël',2345410,85281024,'military regime',NULL);

SELECT * FROM country WHERE Name='Hugoslavie';

SELECT INSERT_PAYS('Hugoslavie','PUP','Cerf-Panthère',2345410,85281024,'military regime',NULL);

SELECT * FROM country WHERE Name='Hugoslavie';




DROP TABLE IF EXISTS LISTCAP;

CREATE TABLE LISTCAP
(Pays VARCHAR(32) PRIMARY KEY REFERENCES country(Name)
,Capitale VARCHAR(35) REFERENCES country(Capital)
)ENGINE = InnoDB;


DROP PROCEDURE IF EXISTS PAYS_CAP;
DROP PROCEDURE IF EXISTS CHARGE_CAP;
DELIMITER |

CREATE PROCEDURE PAYS_CAP(IN Lecode VARCHAR(4),OUT err INT)
BEGIN
DECLARE v_pays VARCHAR(32);
DECLARE v_cap VARCHAR(35);
DECLARE EXIT HANDLER FOR SQLSTATE '23000'
BEGIN
	SET err=-1;
END; 

SELECT Name,Capital INTO v_pays,v_cap FROM country WHERE Code=Lecode;
INSERT INTO LISTCAP VALUES(v_pays,v_cap);

SET err=1;
END|




CREATE PROCEDURE CHARGE_CAP()
BEGIN
DECLARE err INT DEFAULT 1;
DECLARE done INT DEFAULT 0;
DECLARE c VARCHAR(4);
DECLARE cursed CURSOR FOR
	SELECT Code FROM country;
DECLARE CONTINUE HANDLER for SQLSTATE value '02000' set done=1;

OPEN cursed;

WHILE done =0 DO
      FETCH FROM cursed INTO c;
      CALL PAYS_CAP(c,err);
END WHILE;

CLOSE cursed;

END|

DELIMITER ;


SELECT * from LISTCAP;

CALL CHARGE_CAP();
SELECT * from LISTCAP;





/*Q3*/

ALTER TABLE country ADD COLUMN OldCap VARCHAR(20),ADD COLUMN ChangeDate DATE;

SELECT * FROM country;

DELIMITER |

DROP TRIGGER IF EXISTS changecap|
CREATE TRIGGER changecap BEFORE UPDATE
ON country FOR EACH ROW
BEGIN
	IF OLD.Capital <> NEW.Capital
	THEN
		SET NEW.OldCap = OLD.Capital;
		SET NEW.ChangeDate = NOW();
	END IF;

END |

DELIMITER ;

UPDATE country SET Capital='Bamaco' WHERE Code='PUP';

SELECT * FROM country WHERE Code='PUP';



DELIMITER |

DROP PROCEDURE IF EXISTS AJOUT_POPULA|

CREATE PROCEDURE AJOUT_POPULA(IN x INT, IN pays VARCHAR(4))
BEGIN
UPDATE country SET Population =Population+((x*Population)/100) WHERE Code=pays;
END |

DELIMITER ;
SELECT * FROM country WHERE Code='PUP';
CALL AJOUT_POPULA(20,'PUP');
SELECT * FROM country WHERE Code='PUP';




DELIMITER |
DROP PROCEDURE IF EXISTS SOM_POP|
CREATE PROCEDURE SOM_POP()
BEGIN
SELECT Continent, SUM(Population) AS Population_continent FROM country,encompasses WHERE country.Code=encompasses.Country GROUP BY Continent;
END |
DELIMITER ;

CALL SOM_POP();

DROP TABLE IF EXISTS vue;
CREATE VIEW vue AS
(SELECT country.Code AS Code,
country.Name AS Pays ,
language.Name AS Langue ,
country.Population AS Population,
language.Percentage AS Pourcentage,
((country.Population * language.Percentage )/100) AS PopTot
FROM country, language
WHERE country.Code = language.Country); 

SELECT * FROM vue;

DELIMITER |
DROP TABLE IF EXISTS turbo|
DROP PROCEDURE IF EXISTS LANG_PARLEES|


CREATE PROCEDURE LANG_PARLEES()
BEGIN

	CREATE TABLE turbo AS (SELECT Langue, SUM(PopTot) AS Population FROM vue GROUP BY Langue ORDER BY Population DESC LIMIT 3);
	SELECT * from turbo;

	SELECT vue.Langue, vue.Pays FROM vue, turbo WHERE vue.Langue=turbo.Langue; 
END|

DELIMITER ;

CALL LANG_PARLEES();



/* Q7 */

DELIMITER |
DROP PROCEDURE IF EXISTS LgFront|
DROP TABLE IF EXISTS LG_FRONTIERE|

CREATE PROCEDURE LgFront(IN contiti VARCHAR(20))
BEGIN
	CREATE TEMPORARY TABLE LG_FRONTIERE AS
	(SELECT country.Name AS Pays, SUM(Length) AS Longueur
	FROM country, encompasses, borders
	WHERE country.Code=encompasses.Country AND borders.Country1=country.Code AND encompasses.Continent=contiti
	GROUP BY Country1);
SELECT * FROM LG_FRONTIERE;

END|


DELIMITER ;

CALL LgFront('Europe');

/* Q8 */

DELIMITER |

DROP PROCEDURE IF EXISTS Ouverture|
DROP TABLE IF EXISTS Issou|
DROP TABLE IF EXISTS Parske|
DROP TABLE IF EXISTS Zizou|
DROP TABLE IF EXISTS Zouzi|

CREATE PROCEDURE Ouverture(IN Nom VARCHAR(35))
BEGIN

CREATE TEMPORARY TABLE Issou AS (
       SELECT country.Name AS Nom,
       country.Capital AS Capitale,
       politics.Government AS Gouvernement,
       is_member.Organization AS Organisation,
       economy.GDP AS PIB,
       city.Longitude AS Longitude,
       city.Latitude AS Latitude
       
       
       FROM country, politics, is_member, economy, city
       
       WHERE country.Code=politics.Country
       AND country.Code=city.Country
       AND city.Country=politics.Country
       AND politics.Country=is_member.Country
       AND economy.Country=country.Code
       AND country.Name=Nom );


CREATE TEMPORARY TABLE Parske AS (
       SELECT country.Name AS Nom,
       country.Capital AS Capitale,
       politics.Government AS Gouvernement,
       is_member.Organization AS Organisation,
       economy.GDP AS PIB,
       city.Longitude AS Longitude,
       city.Latitude AS Latitude
       FROM country, politics, is_member, economy, city
       WHERE country.Code=politics.Country
       AND city.Country=country.Code
       AND politics.Country=is_member.Country
       AND economy.Country=country.Code);

CREATE TEMPORARY TABLE Zizou  AS (
       SELECT DISTINCT Parske.Nom
       FROM Parske, Issou, country, city
       WHERE country.Name=Parske.Nom
       AND city.Country=country.Code
       AND Parske.Gouvernement=Issou.Gouvernement
       AND Issou.Organisation=Parske.Organisation
       AND (Issou.PIB-Parske.PIB<500 OR Parske.PIB-Issou.PIB<500));


CREATE TEMPORARY TABLE Zouzi  AS (
       SELECT DISTINCT Issou.Nom AS Country1,
       Parske.Nom AS Country2,
       (SQRT((Issou.Longitude - Parske.Longitude)*(Issou.Longitude - Parske.Longitude)+(Issou.Latitude - Parske.Latitude)*(Issou.Latitude - Parske.Latitude)))  AS Distance
       FROM Parske, Issou, city, country
       WHERE city.Country=country.Code
       AND country.Name=Parske.Nom
       AND Parske.Capitale=country.Capital
       AND Parske.Gouvernement=Issou.Gouvernement
       AND Issou.Organisation=Parske.Organisation
       AND (Issou.PIB-Parske.PIB<500 OR Parske.PIB-Issou.PIB<500))
       ORDER BY Country2 DESC
       LIMIT 44;
       

SELECT * FROM Zouzi;
END|

DELIMITER ;
CALL Ouverture('France');
/*
SELECT (SQRT(POW((Parske.Longitude - Issou.Longitude),2)+POW(Parske.Latitude - Issou.Latitude),2)))  AS Distance FROM Parske, Issou, city, country
       WHERE city.Country=country.Code AND country.Name=Parske.Nom AND Parske.Gouvernement=Issou.Gouvernement AND Issou.Organisation=Parske.Organisation;

SELECT SQRT(city.Longitude) FROM city;
(SQRT(POW((Nom2.Longitude - Nom1.Longitude),2)+POW(Nom2.Latitude - Nom1.Latitude),2)))
*/


