DROP PROCEDURE P1;
DROP PROCEDURE P2;
DROP PROCEDURE P3;
DROP FUNCTION F1;
DROP PROCEDURE P4;

DELIMITER |
CREATE PROCEDURE P1(IN p INT,IN n INT)
BEGIN
DECLARE i INT DEFAULT 0;
DECLARE somme INT DEFAULT 0;
	WHILE i<n DO
		SET somme=p+i;
		SET i=i+1;
		SELECT somme;
	END WHILE;
END|
DELIMITER ;

CALL P1(2,10);

DELIMITER |

CREATE PROCEDURE P2(IN n INT, IN p INT, OUT q INT)
BEGIN
	SET q=n*p;
END|


CREATE PROCEDURE P3()
BEGIN
DECLARE q INT;
 CALL P2(2,5,q);
 SELECT q;
END|
DELIMITER ;

CALL P3();


DELIMITER |
CREATE FUNCTION F1(n INT, p INT)
RETURNS INT
BEGIN
DECLARE q INT; 
SET q=n*p;
RETURN q;
END|

CREATE PROCEDURE P4()
BEGIN
 SELECT F1(2,5);
END|
DELIMITER ;

CALL P4();





