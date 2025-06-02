-- DESCRIBE Referee;
-- DESCRIBE Club;
-- DESCRIBE Stadium;
-- DESCRIBE Player;
-- DESCRIBE GameMatch;

-- SELECT * FROM Referee;
-- SELECT * FROM Club;
-- SELECT * FROM Stadium;
-- SELECT * FROM Player;
-- SELECT * FROM GameMatch;

/* Andres: Query 1
Query 1: must incorporate one of the aggregate commands: 
(COUNT, MIN, MAX, AVG, etc.), GROUP BY, AND ORDER BY. 
This query must be sufficiently different than my query 3. 
The aggregate should use an attribute in a different table than the 
GROUP BY attribute (i.e., you will MUST use a NATURAL JOIN in your query): 
e.g., SELECT album.title, COUNT(track.album_id) FROM album 
JOIN track ON album.id = track.album_id GROUP BY album.title 
ORDER BY album.title;
*/
SELECT Referee_FName AS First_Name,
       Referee_LName AS Last_Name,
       GROUP_CONCAT(Match_Home_Team ORDER BY Match_Home_Team SEPARATOR ', ') AS Matches_Officited,
       CONCAT(Referee_FName, ' ', Referee_LName) AS Full_Name
FROM Referee
JOIN GameMatch ON Referee.Referee_ID = GameMatch.Referee_ID
GROUP BY Referee.Referee_ID;

/* Lauren: Query 2
Query 2: must incorporate nesting: 
e.g., SELECT track.title FROM track WHERE track.album_id = 
(SELECT album.id FROM album WHERE album.artist = 'The Beatles');
The nested query table must be DIFFERENT than the top-level query table - 
use the relationship between foreign keys as shown in my example with album and track.
The nested query WHERE clause may NOT use a primary key - 
e.g., WHERE album.album_id = 12 is not acceptable.
If you use a Natural Join for the outer SQL, then the nested SQL 
should be from yet another table.
*/
SELECT Player_FName, Player_LName, Player_Salary, Club_Name
FROM Player
WHERE Player_Salary > (
    SELECT AVG(Player_Salary)
    FROM Player
    WHERE Club_Name = 'Barcelona'
);

/* Lauren: Query 3
For each Club name, list all players' first and last name on one line.
Use group_concat to list each club name once with its many players.
Use concat to list player's first and last names in one cell.
*/
SELECT Club.Club_Name, GROUP_CONCAT(CONCAT(Player_FName, ' ', Player_LName) SEPARATOR ', ') AS Players
FROM Club
LEFT OUTER JOIN Player ON Club.Club_Name = Player.Club_Name
GROUP BY Club_Name;

/* Andres: Query 3
For each Referee, list their first and last name with all home teams on one line.
Use group_concat to list a referee once with the home teams of the matches they officiated.
Use concat to list the ref's first and last name in one cell.
*/
SELECT Referee.Referee_ID, Referee.Referee_FName, Referee.Referee_LName, COUNT(GameMatch.Match_ID) AS Total_Matches_Refereed
FROM Referee
NATURAL JOIN GameMatch
GROUP BY Referee.Referee_ID, Referee.Referee_FName, Referee.Referee_LName
ORDER BY Total_Matches_Refereed DESC;
