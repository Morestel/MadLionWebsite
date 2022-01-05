/*Peuplement des tables de la base de données*/

INSERT INTO User VALUES('000.00.000.0','Pup','Hugo');
INSERT INTO User VALUES('111.11.111.1','Gourg','Kévin');
INSERT INTO User VALUES('222.22.222.2','Rous','Guigui');
INSERT INTO User VALUES('333.33.333.3','Mores','Thomas');
INSERT INTO User VALUES('444.44.444.4','Sins','John');
INSERT INTO User VALUES('555.55.555.5','Borja','Juan');
INSERT INTO User VALUES('666.66.666.6','Kalif','Mia');
INSERT INTO User VALUES('777.77.777.7','Hornet','Andréas');
INSERT INTO User VALUES('888.88.888.8','Ferra','Manu');
INSERT INTO User VALUES('999.99.999.9','Lewis','Carl');
INSERT INTO User VALUES('001.01.001.1','Chaze','Claire');
INSERT INTO User VALUES('002.02.002.2','Queen','Théa');
INSERT INTO User VALUES('003.03.003.3','Smoak','Felicity');

INSERT INTO Key_word(text) VALUES('Bonjour');
INSERT INTO Key_word(text) VALUES('Au revoir');
INSERT INTO Key_word(text) VALUES('Salut');
INSERT INTO Key_word(text) VALUES('Bye');
INSERT INTO Key_word(text) VALUES('Bonsoir');
INSERT INTO Key_word(text) VALUES('Coucou');
INSERT INTO Key_word(text) VALUES('A la revoyure');
INSERT INTO Key_word(text) VALUES('Cocote');
INSERT INTO Key_word(text) VALUES('Amixem');
INSERT INTO Key_word(text) VALUES('Bonsoir');
INSERT INTO Key_word(text) VALUES('Bonne nuit');
INSERT INTO Key_word(text) VALUES('Etudes');
INSERT INTO Key_word(text) VALUES('Etudiants');

INSERT INTO User_KW VALUES('000.00.000.0',1,1,NOW());
INSERT INTO User_KW VALUES('111.11.111.1',2,2,NOW());
INSERT INTO User_KW VALUES('222.22.222.2',3,3,NOW());
INSERT INTO User_KW VALUES('333.33.333.3',4,4,NOW());
INSERT INTO User_KW VALUES('444.44.444.4',5,0,NOW());
INSERT INTO User_KW VALUES('555.55.555.5',6,1,NOW());
INSERT INTO User_KW VALUES('666.66.666.6',7,2,NOW());
INSERT INTO User_KW VALUES('777.77.777.7',8,8,NOW());
INSERT INTO User_KW VALUES('888.88.888.8',9,9,NOW());
INSERT INTO User_KW VALUES('999.99.999.9',10,8,NOW());
INSERT INTO User_KW VALUES('001.01.001.1',11,4,NOW());
INSERT INTO User_KW VALUES('002.02.002.2',12,5,NOW());
INSERT INTO User_KW VALUES('003.03.003.3',13,6,NOW());

INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('000.00.000.0',CURDATE(),CURTIME(),5,3);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('111.11.111.1',CURDATE(),CURTIME(),4,3);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('222.22.222.2',CURDATE(),CURTIME(),24,2);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('333.33.333.3',CURDATE(),CURTIME(),8,1);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('444.44.444.4',CURDATE(),CURTIME(),4,2);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('555.55.555.5',CURDATE(),CURTIME(),16,3);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('666.66.666.6',CURDATE(),CURTIME(),1,1);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('777.77.777.7',CURDATE(),CURTIME(),48,1);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('888.88.888.8',CURDATE(),CURTIME(),12,3);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('999.99.999.9',CURDATE(),CURTIME(),9,2);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('001.01.001.1',CURDATE(),CURTIME(),3,1);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('002.02.002.2',CURDATE(),CURTIME(),7,2);
INSERT INTO Connection(IP, date, time, duration, browserID) VALUES('003.03.003.3',CURDATE(),CURTIME(),14,3);

INSERT INTO Browser VALUES(1,'Firefox');
INSERT INTO Browser VALUES(2,'Chrome');
INSERT INTO Browser VALUES(3,'Internet Explorer');
