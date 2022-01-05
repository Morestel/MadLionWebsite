set foreign_key_checks=1;

drop TABLE jeux;
drop TABLE nation;
drop TABLE athlete;
drop TABLE sport;
drop TABLE epreuve;
drop TABLE participe;
drop TABLE resultat;



CREATE TABLE jeux
( numjeux	INT(5) 	
, pays		VARCHAR(40)
, ville		VARCHAR(40)
, type		VARCHAR(1)	
, annee		INT(4)
, PRIMARY KEY(numjeux)
)ENGINE = InnoDB;




CREATE TABLE nation
	( numnation	INT(10)		
	, nom		VARCHAR(40)
	, continent	ENUM('Europe', 'Asie', 'Afrique', 'Amerique', 'Oceanie')
	,PRIMARY KEY(numnation)
)ENGINE = InnoDB;


CREATE TABLE athlete
	( numathlete	INT(20)	
	, nom		VARCHAR(40)
	, numnation	INT(10) REFERENCES nation(numnation)
	, PRIMARY KEY(numathlete)
	)ENGINE = InnoDB;


CREATE TABLE sport
	( numsport	INT(10)	
	, nom		VARCHAR(40)
	, PRIMARY KEY(numsport)
	)ENGINE = InnoDB;


CREATE TABLE epreuve
	( numepreuve	INT(10)		
	, libelle	VARCHAR(40)
	, genre		ENUM('M', 'F')	
	, typeclass	ENUM('I', 'E')	
	, numsport	INT(10) REFERENCES sport(numsport)
 	, PRIMARY KEY(numepreuve)

	)ENGINE = InnoDB;


CREATE TABLE participe
	( numjeux	INT(5) REFERENCES jeux(numjeux) 		
	, numnation	INT(10) REFERENCES nation(numnation)
	, PRIMARY KEY (numjeux, numnation)
	)ENGINE = InnoDB;

CREATE TABLE resultat
	( numjeux	INT(5) REFERENCES jeux(numjeux)		
	, numepreuve	INT(10) REFERENCES epreuve(numepreuve)		
	, numathlete	INT(20) REFERENCES athlete(numathlete)		
	, medaille	ENUM('O', 'A', 'B')
	, PRIMARY KEY (numjeux, numepreuve, numathlete, medaille)
	)ENGINE = InnoDB;



	
-- Création du jeu de données

-- E veut signifier Eté; H: Hiver


INSERT INTO jeux VALUES (1, 'France', 'Lyon', 'E', 2016);
INSERT INTO jeux VALUES (2, 'Japon', 'Tokyo', 'E', 1964);
INSERT INTO jeux VALUES (3, 'Australie', 'Sidney', 'E', 2004);
INSERT INTO jeux VALUES (4, 'Japon', 'Nagano', 'H', 1998);
INSERT INTO jeux VALUES (5, 'France', 'Alberville', 'H', 1990);


INSERT INTO nation VALUES (1, 'Ethiopie', 'Afrique');
INSERT INTO nation VALUES (2, 'France', 'Europe');
INSERT INTO nation VALUES (3, 'USA', 'Amerique');
INSERT INTO nation VALUES (4, 'Italie', 'Europe');
INSERT INTO nation VALUES (5, 'Maroc', 'Afrique');

INSERT INTO athlete VALUES (1, 'Carl Lewis', 3);
INSERT INTO athlete VALUES (2, 'Laure Manaudou', 2);
INSERT INTO athlete VALUES (3, 'Marie Pierce', 2);
INSERT INTO athlete VALUES (4, 'Ali Zanou', 5);
INSERT INTO athlete VALUES (5, 'Lea Cassoli', 4);
INSERT INTO athlete VALUES (6, 'John Smith', 3);
INSERT INTO athlete VALUES (7, 'Moussad Marah', 1);
INSERT INTO athlete VALUES (8, 'David Douillet', 2);
INSERT INTO athlete VALUES (9, 'Thierry Lhermite', 2);
INSERT INTO athlete VALUES (10, 'Lukas Zala', 1);


select * from athlete;


INSERT INTO sport VALUES (1, 'Judo');
INSERT INTO sport VALUES (2, 'Athletisme');
INSERT INTO sport VALUES (3, 'Tennis');
INSERT INTO sport VALUES (4, 'Velo');

-- M= Masculin; F=Feminin
-- I= individuel, E=Equipe
	
INSERT INTO epreuve VALUES (1, '-52kg', 'M', 'I', 1);
INSERT INTO epreuve VALUES (2, '+52kg', 'F', 'E', 1);
INSERT INTO epreuve VALUES (3, '100m', 'M', 'I', 2);
INSERT INTO epreuve VALUES (4, '200m', 'M', 'I', 2);
INSERT INTO epreuve VALUES (5, 'simple', 'M', 'I', 3);
INSERT INTO epreuve VALUES (6, 'double', 'M', 'E', 3);
INSERT INTO epreuve VALUES (7, 'vitesse', 'M', 'E', 4);
INSERT INTO epreuve VALUES (8, 'sprint', 'M', 'E', 4);

INSERT INTO participe VALUES (1, 1);
INSERT INTO participe VALUES (1, 2);
INSERT INTO participe VALUES (2, 1);
INSERT INTO participe VALUES (2, 3);
INSERT INTO participe VALUES (3, 1);
INSERT INTO participe VALUES (3, 4);
INSERT INTO participe VALUES (4, 2);
INSERT INTO participe VALUES (4, 5);
INSERT INTO participe VALUES (5, 2);
INSERT INTO participe VALUES (5, 4);


-- O=Or; A=Argent; B=Bronze

INSERT INTO resultat VALUES (2, 1, 8, 'A');
INSERT INTO resultat VALUES (2, 1, 2, 'A');
INSERT INTO resultat VALUES (2, 2, 8, 'B');
INSERT INTO resultat VALUES (2, 2, 2, 'B');
INSERT INTO resultat VALUES (1, 3, 1, 'O');
INSERT INTO resultat VALUES (3, 4, 1, 'A');
INSERT INTO resultat VALUES (5, 3, 1, 'B');
INSERT INTO resultat VALUES (2, 5, 7, 'O');
INSERT INTO resultat VALUES (3, 5, 7, 'O');
INSERT INTO resultat VALUES (4, 3, 7, 'O');
INSERT INTO resultat VALUES (1, 6, 8, 'O');
INSERT INTO resultat VALUES (2, 7, 9, 'O');
INSERT INTO resultat VALUES (3, 8, 9, 'O');
INSERT INTO resultat VALUES (3, 6, 9, 'O');

SELECT medaille
FROM resultat, sport
WHERE nom='Tennis'AND numjeux=(SELECT numjeux FROM jeux WHERE type='E' AND ville='Tokyo' AND annee=1964);

SELECT medaille, jeux.ville, jeux.annee, athlete.nom
FROM resultat, jeux, athlete
WHERE resultat.numjeux=jeux.numjeux AND resultat.numathlete=athlete.numathlete AND athlete.nom='Carl Lewis';

SELECT DISTINCT ville, annee
FROM jeux, athlete, resultat
WHERE resultat.numjeux=jeux.numjeux AND resultat.numathlete=athlete.numathlete AND athlete.nom LIKE "D%" OR athlete.nom LIKE "L%";

SELECT ville, annee
FROM jeux, nation, participe, resultat, sport, epreuve
WHERE epreuve.numsport=sport.numsport AND epreuve.numepreuve=resultat.numepreuve AND jeux.numjeux=resultat.numjeux AND resultat.numjeux=participe.numjeux AND participe.numnation=nation.numnation AND  nation.nom='Ethiopie' AND resultat.medaille='O' AND sport.nom LIKE 'Athletisme'; 


SELECT COUNT(medaille), continent
FROM nation, resultat, participe, jeux
WHERE nation.numnation=participe.numnation AND jeux.numjeux=participe.numjeux AND resultat.numjeux=participe.numjeux
GROUP BY continent
ORDER BY COUNT(medaille) DESC;

SELECT ville, annee
FROM nation, participe, jeux, resultat, epreuve
WHERE nation.numnation=participe.numnation AND jeux.numjeux=participe.numjeux AND jeux.numjeux=resultat.numjeux AND epreuve.numepreuve=resultat.numepreuve AND epreuve.typeclass LIKE 'E' AND nation.nom LIKE 'France' AND resultat.medaille LIKE 'O';

SELECT continent, COUNT(medaille)
FROM nation, resultat, participe, jeux
WHERE nation.numnation=participe.numnation AND jeux.numjeux=participe.numjeux AND resultat.numjeux=participe.numjeux
GROUP BY continent
ORDER BY COUNT(medaille) DESC;
