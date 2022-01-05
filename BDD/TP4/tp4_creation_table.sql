DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Key_word;
DROP TABLE IF EXISTS User_KW;
DROP TABLE IF EXISTS Connection;
DROP TABLE IF EXISTS Browser;

/*Création des tables de la base de données*/

CREATE TABLE User(
       IP VARCHAR(12) PRIMARY KEY
       , name VARCHAR(20)
       ,firstname VARCHAR(20))ENGINE = InnoDB;

CREATE TABLE Key_word(
       ID_KW INT PRIMARY KEY AUTO_INCREMENT
       ,text TEXT(500)
       )ENGINE = InnoDB;

CREATE TABLE User_KW(
       IP VARCHAR(12) REFERENCES User(IP)
       ,ID INT REFERENCES Key_word(ID_KW)
       ,weight INT
       ,lastUpDate DATETIME
       ,PRIMARY KEY(IP, ID))ENGINE = InnoDB;


CREATE TABLE Browser(
       ID_B INT
       ,name_B VARCHAR(20))ENGINE = InnoDB;
       
CREATE TABLE Connection(
       ID_C INT PRIMARY KEY AUTO_INCREMENT
       ,IP VARCHAR(12) REFERENCES User(IP)
       ,date DATE
       ,time TIME
       ,duration INT
       ,browserID INT REFERENCES Browser(ID_B))ENGINE = InnoDB;

