USE giraffe;
DROP TABLE IF EXISTS Referee, Stadium, Club, Player, GameMatch;

CREATE TABLE Referee(
	Referee_ID int NOT NULL,
    Referee_FName varchar(50),
    Referee_LName varchar(50),
    Referee_Age varchar(50),
    Referee_Nationality varchar(50),
    Referee_YearsOfExperience int,
		PRIMARY KEY(Referee_ID)
) Engine=InnoDB;

CREATE TABLE Club(
	Club_Name varchar(50) NOT NULL,
    Club_Coach varchar(50),
    Club_President varchar(50),
    Club_League_Position int,
		PRIMARY KEY (Club_Name)
) Engine=InnoDB;

CREATE TABLE Stadium(
	Stadium_Name varchar(50) NOT NULL,
    Stadium_Capacity int,
    Stadium_Location varchar(50),
    Stadium_Year_Built int,
    Club_Name varchar(50),
		PRIMARY KEY (Stadium_Name),
        FOREIGN KEY (Club_Name) REFERENCES Club(Club_Name)
) Engine=InnoDB;

CREATE TABLE Player(
	Player_ID int NOT NULL AUTO_INCREMENT,
	Player_Number int,
    Player_FName varchar(50),
    Player_LName varchar(50),
    Player_Nationality varchar(50),
    Player_Position varchar(50),
    Player_Age int,
    Player_Salary int,
    Club_Name varchar(50),
		PRIMARY KEY (Player_ID),
		FOREIGN KEY (Club_Name) REFERENCES Club(Club_Name)
) Engine=InnoDB;

CREATE TABLE GameMatch(
	Match_ID int NOT NULL AUTO_INCREMENT,
	Match_Date date,
    Match_Home_Team varchar(50),
    Match_Away_Team varchar(50),
    Match_Home_Points int,
    Match_Away_Points int,
    Referee_ID int,
		PRIMARY KEY (Match_ID),
		FOREIGN KEY (Referee_ID) REFERENCES Referee(Referee_ID),
		FOREIGN KEY (Match_Home_Team) REFERENCES Club(Club_Name),
        FOREIGN KEY (Match_Away_Team) REFERENCES Club(Club_Name)
) Engine=InnoDB;

