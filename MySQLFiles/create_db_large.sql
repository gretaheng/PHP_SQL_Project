SET foreign_key_checks = 0;
DROP TABLE IF EXISTS Media;
DROP TABLE IF EXISTS Celebrities;
DROP TABLE IF EXISTS Public;
DROP TABLE IF EXISTS Scandals;
DROP TABLE IF EXISTS Weibo;
DROP TABLE IF EXISTS Weibo_Users;
DROP TABLE IF EXISTS Weibo_hashtags;
DROP TABLE IF EXISTS Reports;
DROP TABLE IF EXISTS Get_involved_in;
DROP TABLE IF EXISTS Reposts;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Includes_;
DROP TABLE IF EXISTS Follows_;
DROP TABLE IF EXISTS Talks_about;
SET foreign_key_checks = 1;

CREATE TABLE Media (
	m_name varchar(255),
    m_level varchar(255),
    m_Type varchar(255),
    primary key (m_name)
);

CREATE TABLE Celebrities (
	c_account varchar(255),
    c_name varchar(255) DEFAULT 'Unkown',
    c_age int, 
    c_gender varchar(255), 
    c_occupation varchar(255),
    primary key (c_account )
);

CREATE TABLE Public (
	p_account varchar(255),
    p_name varchar(255),
    p_edu_level varchar(255),
    primary key (p_account)
);

CREATE TABLE Scandals (
    s_id int,
	s_date date,
    s_type varchar(255),
    s_truth_or_not boolean,
    s_intro varchar(255),
    primary key (s_id)
);

CREATE TABLE Weibo (
	w_datetime datetime,
    c_account varchar(255),
    w_type varchar(255),
    w_content varchar(255),
    primary key (w_datetime, c_account),
	FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);	

CREATE TABLE Weibo_Users (
	wu_account varchar(255),
    wu_followers int,
    wu_post_frequncy float,
    wu_score int,
    primary key (wu_account)
);

CREATE TABLE Weibo_hashtags (
	h_name varchar(255),
    h_length int,
    h_used_times int,
    primary key (h_name)
);

CREATE TABLE Reports (
	m_name varchar(255),
	s_id int,
    primary key (m_name, s_id),
    FOREIGN KEY (s_id) 
		REFERENCES Scandals(s_id) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (m_name) 
		REFERENCES Media(m_name) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Get_involved_in (
	c_account varchar(255),
	s_id int,
    primary key (c_account, s_id),
    FOREIGN KEY (s_id) 
		REFERENCES Scandals(s_id) 
		ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Follows_ (
	p_account varchar(255),
    c_account varchar(255),
    primary key (p_account,c_account),
	FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account) 
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (p_account) 
		REFERENCES Public(p_account) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
    
CREATE TABLE Talks_about (
	w_datetime datetime,
    c_account varchar(255),
	s_id int,
    primary key (w_datetime, c_account, s_id),
    FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (w_datetime) 
		REFERENCES Weibo(w_datetime)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (s_id) 
		REFERENCES Scandals(s_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Includes_ (
	w_datetime datetime,
    c_account varchar(255),
	h_name varchar(255),
    primary key (w_datetime, c_account, h_name),
	FOREIGN KEY (w_datetime) 
		REFERENCES Weibo(w_datetime)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (h_name) 
		REFERENCES Weibo_hashtags(h_name)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE Comments (
	p_account varchar(255),
    c_account varchar(255),
    w_datetime datetime,
    c_attitude varchar(255),
    primary key (p_account, c_account, w_datetime),
    FOREIGN KEY (p_account) 
		REFERENCES Public(p_account)
        ON DELETE CASCADE,
    FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account)
        ON DELETE CASCADE,
	FOREIGN KEY (w_datetime) 
		REFERENCES Weibo(w_datetime)
        ON DELETE CASCADE
);

CREATE TABLE Reposts (
	p_account varchar(255),
    c_account varchar(255),
    w_datetime datetime,
    r_times int,
    primary key (p_account, c_account, w_datetime),
	FOREIGN KEY (c_account) 
		REFERENCES Celebrities(c_account)
        ON DELETE CASCADE,
    FOREIGN KEY (w_datetime) 
		REFERENCES Weibo(w_datetime)
        ON DELETE CASCADE,
    FOREIGN KEY (p_account) 
		REFERENCES Public(p_account)
        ON DELETE CASCADE
);
