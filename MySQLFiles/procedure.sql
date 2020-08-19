-- insert a row of weibo_user, add it to celebrities/public
-- valid account number either starts with 'c'(celebrities) or consists of only number(public)
DELIMITER $$
DROP PROCEDURE IF EXISTS addweibouser$$
CREATE PROCEDURE addweibouser(
        IN new_account VARCHAR(255),
        IN new_fo INT,
        IN new_post_fre float,
        IN new_score INT
)
BEGIN
		DECLARE FINDC condition for sqlstate '45000';    
        
        IF new_account LIKE 'c%' THEN
			INSERT INTO Celebrities VALUES(new_account, 'Unknown', NULL, NULL, NULL);
		ELSEIF (new_account REGEXP '^[0-9]+$') THEN
			INSERT INTO Public
            VALUES(new_account, NULL, NULL);
		ELSE 
			SIGNAL sqlstate '45000'
			SET message_text = 'account is not valid';
		END IF;
		INSERT INTO Weibo_Users
        VALUES(new_account, new_fo, new_post_fre, new_score);        
END $$
DELIMITER ;