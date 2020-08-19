DROP VIEW IF EXISTS myfans;
CREATE VIEW myfans AS
	SELECT p_account, COUNT(c_account) AS followingstars
	FROM Follows_
	GROUP BY p_account
	ORDER BY p_account;