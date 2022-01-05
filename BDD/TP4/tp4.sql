

/*Ecriture des fonctions*/

/* Ajout/Modif User */

DROP FUNCTION IF EXISTS AJOUT_MODIF_USER;

DELIMITER |

CREATE FUNCTION AJOUT_MODIF_USER(ipe VARCHAR(12),nom VARCHAR(20),prenom VARCHAR(20))
RETURNS INT
BEGIN
DECLARE done INT DEFAULT 0;
DECLARE c VARCHAR(12);
DECLARE cursed CURSOR FOR
	SELECT IP FROM User;
DECLARE CONTINUE HANDLER for SQLSTATE value '02000' set done=1;

OPEN cursed;

WHILE done =0 DO
      FETCH FROM cursed INTO c;
      IF ipe = c
      THEN UPDATE User SET name=nom , firstname=prenom WHERE IP=ipe;
      RETURN 1;
      END IF;
END WHILE;
CLOSE cursed;
INSERT INTO User VALUES(ipe, nom, prenom);
RETURN 1;
END|

DELIMITER ;

SELECT AJOUT_MODIF_USER('000.00.000.7','Pattins','Robert');

SELECT * FROM User;

/* Ajout/Modif Mot-clé */

DROP FUNCTION IF EXISTS AJOUT_MODIF_KEYWORD;

DELIMITER |

CREATE FUNCTION AJOUT_MODIF_KEYWORD(Idé INT, texteu TEXT(500))
RETURNS INT
BEGIN
DECLARE done INT DEFAULT 0;
DECLARE c VARINSERT INTO Key_word VALUES(Idé, texteu);
RETURN 1;
END|

DELIMITER ;

SELECT AJOUT_MODIF_KEYWORD(15, 'Binjour');

SELECT * FROM Key_word;


/* Ajout dans User_KW */

SELECT * FROM User_KW;
DROP FUNCTION IF EXISTS AJOUT_PLUS_UN;

DELIMITER |

CREATE FUNCTION AJOUT_PLUS_UN(ipe VARCHAR(12),ide INT)
RETURNS INT
BEGIN
DECLARE done INT DEFAULT 0;
DECLARE c VARCHAR(12);
DECLARE d INT;
DECLARE cursed CURSOR FOR
	SELECT IP,ID FROM User_KW;
DECLARE CONTINUE HANDLER for SQLSTATE value '02000' set done=1;

OPEN cursed;

WHILE done =0 DO
      FETCH FROM cursed INTO c,d;
      IF ipe = c AND ide=d
      THEN UPDATE User_KW SET weight=weight+1,lastUpDate=NOW() WHERE ID=ide AND IP=ipe;
      RETURN 1;
      END IF;
END WHILE;
CLOSE cursed;
INSERT INTO User_KW VALUES(ipe,ide,1,NOW());
RETURN 1;
END|

DELIMITER ;

SELECT AJOUT_PLUS_UN('000.00.000.9',1);

SELECT * FROM User_KW;


/* Maintenace de User_KW */


DROP FUNCTION IF EXISTS MAINTENANCE;

DELIMITER |

CREATE FUNCTION MAINTENANCE(X INT)
RETURNS INT
BEGIN
DECLARE done INT DEFAULT 0;
DECLARE c DATETIME;
DECLARE cursed CURSOR FOR
	SELECT lastUpDate FROM User_KW;
DECLARE CONTINUE HANDLER for SQLSTATE value '02000' set done=1;

OPEN cursed;

WHILE done =0 DO
      FETCH FROM cursed INTO c;
      IF CAST(YEAR(NOW()) AS SIGNED INT) - CAST(YEAR(c) AS SIGNED INT) >= X
      THEN UPDATE User_KW SET weight=0,lastUpDate=NOW() WHERE CAST(YEAR(NOW()) AS SIGNED INT) - CAST(YEAR(c) AS SIGNED INT) >=X;
      RETURN 1;
      END IF;
END WHILE;
CLOSE cursed;
RETURN 1;
END|

DELIMITER ;

SELECT MAINTENANCE(5);

SELECT * FROM User_KW;


/* Création de la table LesSimilaires */

DROP TABLE IF EXISTS LesSimilaires;

CREATE TABLE LesSimilaires(
       U VARCHAR(12) PRIMARY KEY REFERENCES User(IP)
       ,U1 VARCHAR(12) DEFAULT NULL
       ,U2 VARCHAR(12) DEFAULT NULL
       ,U3 VARCHAR(12) DEFAULT NULL
       ,U4 VARCHAR(12) DEFAULT NULL
       ,U5 VARCHAR(12) DEFAULT NULL)Engine=InnoDB;


/* Création procédure Similarité  */

/* On crée une procédure intermédiaire qui nous permettra de peupler une table intermédiaire qui servira lors de la création de la procédure principale. 
Cette première procédure est censée remplir la table temporaire TMP qui contiendra toutes les personnes proches de l'utilisateur qu'on rentre en paramètre.

Suite à celà, on fait la procédure Similarite qui, à l'aide de deux curseurs, appelera récursivement la procédure intermédiaire afin de remplir la table LesSimilaires dans le cas où le champ que l'on veut remplir est vide. Pour finir, on sélectionne la table pour chaque utilisateur. */

DROP PROCEDURE IF EXISTS sim_bis;
DROP TABLE IF EXISTS TMP;

CREATE TABLE TMP AS (SELECT User.IP, text
       	     	     FROM User, Key_word, User_KW
		     WHERE User.IP=User_KW.IP AND User_KW.ID=Key_word.ID_KW);

DELIMITER |

CREATE PROCEDURE sim_bis(IN ip VARCHAR(12), IN texteu TEXT(500))
BEGIN
DECLARE c VARCHAR(12);
DECLARE d TEXT(500);
DECLARE done INT DEFAULT 0;

DECLARE cursed CURSOR FOR
	SELECT IP, text FROM User_KW;
	
DECLARE CONTINUE HANDLER for SQLSTATE value '02000' set done=1;

OPEN cursed;
WHILE done = 0 DO
      FETCH cursed into c, d;
      IF texteu=d
      THEN INSERT INTO TMP VALUES (c, d);
      END IF;
      
END WHILE;
CLOSE cursed;
END|

DELIMITER ;
DROP PROCEDURE IF EXISTS Similarite;

DELIMITER |

DECLARE PROCEDURE Similarite()
BEGIN
DECLARE c VARCHAR(12);
DECLARE d VARCHAR(12);
DECLARE done INT DEFAULT 0;

CREATE cursed CURSOR FOR
       SELECT IP FROM User_KW;
CREATE cur CURSOR FOR
       SELECT IP FROM TMP;
       
DECLARE CONTINUE HANDLER FOR SQLSTATE VALUE '02000' SET done=1;

OPEN cursed;
OPEN cur;
WHILE done = 0 DO
      FETCH cursed INTO c;
      FETCH cur INTO d;
      CALL sim_bis(c, '%');
      INSERT INTO LesSimilaire(U) VALUES (c);
      IF LesSimilaires.U1 IS NOT NULL THEN IF LesSimilaires.U2 IS NOT NULL  THEN IF LesSimilaires.U3 IS NOT NULL THEN IF LesSimilaires.U4 IS NOT NULL THEN IF LesSimilaires.U5 IS NOT NULL THEN INSERT INTO LesSimilaires(U5) VALUES (d) ELSE INSERT INTO LesSimilaires(U4) VALUES (d) INSERT INTO LesSimilaires(U3) VALUES (d) INSERT INTO LesSimilaires(U2) VALUES (d) INSERT INTO LesSimilaires(U1) VALUES (d);
     END IF;
     END IF;
     END IF;
     END IF;
     END IF;
     SELECT * FROM LesSimilaires;
END WHILE;
CLOSE cursed;
CLOSE cur;



END|


DELIMITER ;

CALL Similarite();

DROP FUNCTION IF EXISTS Proche_de;
DELIMITER |

CREATE FUNCTION Proche_De(Utilisateur VARCHAR(20), i INT)
RETURNS VARCHAR(12)

BEGIN
DECLARE c VARCHAR(12);
DECLARE z INT DEFAULT 1;
WHILE z > i DO
      SET z=z+1;
END WHILE;

IF i=1 THEN
SELECT LesSimilaires.U1 INTO c FROM User_KW, LesSimilaires, User WHERE LesSimilaires.U=User_KW.IP AND User.IP=User_KW.IP AND User.name=Utilisateur;  
END IF;

IF i=2 THEN
SELECT  LesSimilaires.U2 INTO c FROM User_KW, LesSimilaires, User WHERE LesSimilaires.U=User_KW.IP AND User.IP=User_KW.IP AND User.name=Utilisateur;  
END IF;

IF i=3 THEN
SELECT LesSimilaires.U3 INTO c FROM User_KW, LesSimilaires, User WHERE LesSimilaires.U=User_KW.IP AND User.IP=User_KW.IP AND User.name=Utilisateur;  
END IF;

IF i=4 THEN
SELECT  LesSimilaires.U4 INTO c  FROM User_KW, LesSimilaires, User WHERE LesSimilaires.U=User_KW.IP AND User.IP=User_KW.IP AND User.name=Utilisateur;  
END IF;

IF i=5 THEN
SELECT LesSimilaires.U5 INTO c FROM User_KW, LesSimilaires, User WHERE LesSimilaires.U=User_KW.IP AND User.IP=User_KW.IP AND User.name=Utilisateur;  
END IF;

RETURN c;
END|

DELIMITER ;

/*
 **********************
 **********************
 * Execution du script*
 **********************
 **********************	*/

/* Ajout d'un utilisateur */
SELECT AJOUT_MODIF_USER('000.00.000.7','Pattins','Robert');

/* Ajout d'un mot clé */
SELECT AJOUT_MODIF_KEYWORD(15, 'Binjour');

SELECT * FROM Key_word;

/* Incrémentation du poids d'une recherche */
SELECT AJOUT_PLUS_UN('000.00.000.9',1);

SELECT * FROM User_KW;

/* On procède à la maintenance de la table User_KW */
SELECT MAINTENANCE(5);

SELECT * FROM User_KW;

/* Recherche des utilisateurs "similaires" */
CALL Similarite();

/* On regarde quel utilisateur est proche d'un autre à un rang donné */

SELECT Proche_De('Pup', 3);

/* Création du fichier de sorti */
TEE tp4.sql;
