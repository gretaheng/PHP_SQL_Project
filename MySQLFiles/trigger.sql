-- create log table for Weibo_hashtags(update) 
DROP TABLE IF EXISTS ScandalsChangeLog;
CREATE TABLE ScandalsChangeLog (
        s_id VARCHAR(250),
        column_changed VARCHAR(20),
        old_value VARCHAR(50),
        new_value VARCHAR(50),
        timestamp TIMESTAMP
);

DROP TABLE IF EXISTS CeleChangeLog;
CREATE TABLE CeleChangeLog (
        c_account VARCHAR(250),
        column_changed VARCHAR(20),
        old_value VARCHAR(50),
        new_value VARCHAR(50),
        timestamp TIMESTAMP
);

DROP TABLE IF EXISTS MChangeLog;
CREATE TABLE MChangeLog (
        m_name VARCHAR(250),
        column_changed VARCHAR(20),
        old_value VARCHAR(50),
        new_value VARCHAR(50),
        timestamp TIMESTAMP
);

DROP TABLE IF EXISTS InsertfLog;
CREATE TABLE InsertfLog (
        p_account int,
        c_account VARCHAR(250),
        timestamp TIMESTAMP
);


DROP TABLE IF EXISTS CeleDelLog;
CREATE TABLE CeleDelLog(
        c_account VARCHAR(250),
        c_name VARCHAR(250),
        c_age int,
        c_gender VARCHAR(50),
        c_occupation  VARCHAR(250),
        timestamp TIMESTAMP
);

-- create log table for Scandals(delete) 
DROP TABLE IF EXISTS ScandalsDeleteLog;
CREATE TABLE ScandalsDeleteLog (
		s_id VARCHAR(250),
        old_s_date VARCHAR(250),
        old_s_type VARCHAR(250),
        old_s_intro VARCHAR(250),
        timestamp TIMESTAMP
);

-- create log table for Weibo_hashtags(delete) 
DROP TABLE IF EXISTS hashDeleteLog;
CREATE TABLE hashDeleteLog (
		h_name VARCHAR(250),
        old_h_length int,
        old_h_used_times int,
        timestamp TIMESTAMP
);

DROP TABLE IF EXISTS WUAddLog;
CREATE TABLE WUAddLog (
        wu_account VARCHAR(250),
        wu_follower int,
        wu_post_frequency float,
        wu_influence_score int,
        timestamp TIMESTAMP
);
        
-- Trigger: Delete hashtags
DELIMITER $$        
DROP TRIGGER IF EXISTS DelhTrigger$$
CREATE TRIGGER DelhTrigghashDeleteLoger 
AFTER DELETE ON Weibo_hashtags
FOR EACH ROW
		BEGIN
				INSERT INTO hashDeleteLog
					VALUES(OLD.h_name, OLD.h_length, OLD.h_used_times, NOW());
		END$$
-- set delimiter back to semicolon
DELIMITER ;

-- Trigger: Add Weibo User
DELIMITER $$        
DROP TRIGGER IF EXISTS AddwuTrigger$$
CREATE TRIGGER AddwuTrigger 
before insert ON Weibo_Users
FOR EACH ROW
		BEGIN
				INSERT INTO WUAddLog
					VALUES(NEW.wu_account, NEW.wu_followers, NEW.wu_post_frequncy, NEW.wu_score, NOW());
		END$$
DELIMITER ;

-- Trigger: Add follow relation
DELIMITER $$        
DROP TRIGGER IF EXISTS AddreTrigger$$
CREATE TRIGGER AddreTrigger 
before insert ON Follows_
FOR EACH ROW
		BEGIN
				INSERT INTO InsertfLog
					VALUES(NEW.p_account, NEW.c_account, NOW());
		END$$
DELIMITER ;

-- Trigger Delete Celebrities
DELIMITER $$        
DROP TRIGGER IF EXISTS  DelceleTrigger$$
CREATE TRIGGER DelceleTrigger 
AFTER DELETE ON Celebrities
FOR EACH ROW
		BEGIN
				INSERT INTO CeleDelLog
					VALUES(OLD.c_account,OLD.c_name, OLD.c_age, OLD.c_gender,OLD.c_occupation, NOW());
		END$$
-- set delimiter back to semicolon
DELIMITER ;

-- Trigger: Celebrities update 
DELIMITER $$
DROP TRIGGER IF EXISTS  logCeleUpdate$$
CREATE TRIGGER logCeleUpdate
AFTER UPDATE ON Celebrities
FOR EACH ROW
        BEGIN
                IF (NEW.c_name <> OLD.c_name) THEN
                        INSERT INTO CeleChangeLog
                        VALUES (OLD.c_account,'c_name', OLD.c_name, NEW.c_name, NOW());
                END IF;
                IF (NEW.c_age <> OLD.c_age) THEN
                        INSERT INTO CeleChangeLog
                        VALUES (OLD.c_account, 'c_age', OLD.c_age, NEW.c_age, NOW());
                END IF;
                IF (NEW.c_gender <> OLD.c_gender) THEN
                        INSERT INTO CeleChangeLog
                        VALUES (OLD.c_account, 'c_gender', OLD.c_gender, NEW.c_gender, NOW());
                END IF;
                IF (NEW.c_occupation <> OLD.c_occupation) THEN
                        INSERT INTO CeleChangeLog
                        VALUES (OLD.c_account, 'c_occupation', OLD.c_occupation, NEW.c_occupation, NOW());
                END IF;
        END$$_
DELIMITER $$  

-- Trigger: Media update
DELIMITER $$
DROP TRIGGER IF EXISTS  logMUpdate$$
CREATE TRIGGER logMUpdate
AFTER UPDATE ON Media
FOR EACH ROW
        BEGIN
                IF (NEW.m_level <> OLD.m_level) THEN
                        INSERT INTO MChangeLog
                        VALUES (OLD.m_name, 'm_level', OLD.m_level, NEW.m_level, NOW());
                END IF;
                IF (NEW.m_Type <> OLD.m_Type) THEN
                        INSERT INTO MChangeLog
                        VALUES (OLD.m_name, 'm_Type', OLD.m_Type, NEW.m_Type, NOW());
                END IF;
        END$$

DELIMITER $$  

-- Trigger: Delete Scandal
DELIMITER $$
DROP TRIGGER IF EXISTS DelTruthTrigger2$$
CREATE TRIGGER DelTruthTrigger2 
AFTER DELETE ON Scandals
FOR EACH ROW
		BEGIN
				INSERT INTO ScandalsDeleteLog
					VALUES(OLD.s_id, OLD.s_date, OLD.s_type, OLD.s_intro, NOW());
		END$$
DELIMITER ;
