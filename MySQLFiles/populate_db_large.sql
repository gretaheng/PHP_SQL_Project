LOAD DATA 
	LOCAL INFILE "data/big_media.txt" 
	INTO TABLE Media
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/big_celebrities.txt" 
	INTO TABLE Celebrities
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/scandals.txt" 
	INTO TABLE Scandals
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/big_weibo.txt" 
	INTO TABLE Weibo
    FIELDS TERMINATED BY '|'
    LINES TERMINATED BY '\n';

LOAD DATA 
	LOCAL INFILE "data/big_weibo_users.txt" 
	INTO TABLE Weibo_Users
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/big_public.txt" 
	INTO TABLE Public
    FIELDS TERMINATED BY '|';
    
    
LOAD DATA 
	LOCAL INFILE "data/weibo_hashtags.txt" 
	INTO TABLE Weibo_hashtags
    FIELDS TERMINATED BY '|'
    LINES TERMINATED BY '\r\n';
    
LOAD DATA 
	LOCAL INFILE "data/comments.txt" 
	INTO TABLE Comments
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/big_follow.txt" 
	INTO TABLE Follows_
    FIELDS TERMINATED BY '|' 
    LINES TERMINATED BY '\r\n';

LOAD DATA 
	LOCAL INFILE "data/GET_INVOLVED_IN.txt" 
	INTO TABLE Get_involved_in
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/INCLUDES.txt" 
	INTO TABLE Includes_
    FIELDS TERMINATED BY '|'
    LINES TERMINATED BY '\r\n';
    
LOAD DATA 
	LOCAL INFILE "data/REPOSTS.txt" 
	INTO TABLE Reposts
    FIELDS TERMINATED BY '|';
    
LOAD DATA 
	LOCAL INFILE "data/TALKS_ABOUT.txt" 
	INTO TABLE Talks_about
    FIELDS TERMINATED BY '|';

LOAD DATA 
	LOCAL INFILE "data/big_reports.txt" 
	INTO TABLE Reports
    FIELDS TERMINATED BY '|';