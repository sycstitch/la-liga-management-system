# La Liga Management System - Query Analysis

This document provides detailed analysis of the four advanced SQL queries implemented in the La Liga Management System, showcasing different database techniques and their real-world applications.

## Overview

Each query demonstrates a different SQL concept while providing meaningful insights into Spanish football league operations:

- **Referee Analytics**: Aggregate functions and performance ranking
- **Salary Analysis**: Nested subqueries for cross-team comparisons  
- **Referee History**: GROUP BY with string concatenation
- **Club Rosters**: LEFT OUTER JOIN for complete data coverage

---

## 1. Referee Performance Analytics (`referee-analytics.php`)

### Query Type: Aggregate Functions with NATURAL JOIN

**Purpose:** Analyze referee workload distribution and identify the most active officials in La Liga.

### SQL Query
```sql
SELECT Referee.Referee_ID, 
       Referee.Referee_FName, 
       Referee.Referee_LName, 
       COUNT(GameMatch.Match_ID) AS Total_Matches_Refereed
FROM Referee
NATURAL JOIN GameMatch
GROUP BY Referee.Referee_ID, Referee.Referee_FName, Referee.Referee_LName
ORDER BY Total_Matches_Refereed DESC;
```

### Results
```
+------------+----------------------+---------------------+------------------------+
| Referee_ID | Referee_FName        | Referee_LName       | Total_Matches_Refereed |
+------------+----------------------+---------------------+------------------------+
|         17 | Víctor García        | Verdura             |                      8 |
|         19 | Isidro Díaz de Mera  | Escuderos           |                      8 |
|         21 | Alejandro Ruiz       | Aguilera            |                      6 |
|          3 | Miguel Ángel         | Ortiz Arias         |                      5 |
|         18 | Javier               | Alberola Rojas      |                      4 |
|         20 | Mario                | Melero López        |                      4 |
|         11 | Francisco José       | Hernández Maeso     |                      4 |
|          8 | Jesús Gil            | Manzano             |                      4 |
|          5 | Jorge Figueroa       | Vázquez             |                      4 |
|         13 | Guillermo Cuadra     | Fernández           |                      4 |
|          1 | César                | Soto Grado          |                      4 |
|          9 | De Burgos            | Bengoetxea          |                      3 |
|          6 | Juan Luis            | Pulido Santana      |                      3 |
|         14 | Alejandro Hernández  | Hernández           |                      3 |
|          2 | Pablo                | González Fuertes    |                      3 |
|         10 | José María           | Sánchez Martínez    |                      3 |
|          4 | Javier               | Iglesias Villanueva |                      3 |
|         16 | Alejandro            | Muñiz Ruiz          |                      2 |
|          7 | Mateo                | Busquets Ferrer     |                      2 |
|         15 | Juan Martínez        | Munuera             |                      1 |
|         12 | José Luis            | Munuera Montero     |                      1 |
+------------+----------------------+---------------------+------------------------+
```

### Key Insights
- **Workload Distribution**: Víctor García Verdura and Isidro Díaz de Mera lead with 8 matches each
- **Balanced Assignment**: Most referees handle 3-4 matches, indicating fair workload distribution
- **Underutilized Officials**: Two referees have only officiated 1 match, suggesting potential for better scheduling
- **Performance Ranking**: Clear hierarchy established for referee performance evaluation

### Technical Features
- **NATURAL JOIN**: Automatically matches Referee_ID between tables
- **Aggregate COUNT**: Totals matches per referee
- **GROUP BY**: Ensures proper aggregation per referee
- **ORDER BY DESC**: Ranks referees by activity level

---

## 2. Cross-Team Salary Analysis (`salary-analysis.php`)

### Query Type: Nested Subquery with Cross-Table Comparison

**Purpose:** Identify Real Madrid players earning above Barcelona's average salary, revealing salary dynamics between rival clubs.

### SQL Query
```sql
SELECT CONCAT(Player_FName, ' ', Player_LName) AS Player_Name, 
       Player_Salary, 
       Club_Name
FROM Player
WHERE Player_Salary > (
    SELECT AVG(Player_Salary)
    FROM Player
    WHERE Club_Name = 'Barcelona'
) AND Club_Name = 'Real Madrid';
```

### Results
```
+--------------+---------------+-------------+
| Player_Name  | Player_Salary | Club_Name   |
+--------------+---------------+-------------+
| Thibaut      |      15000000 | Real Madrid |
| Courtois     |               |             |
| Daniel       |      10420000 | Real Madrid |
| Carvajal     |               |             |
| Éder         |      14580000 | Real Madrid |
| Militão      |               |             |
| David        |      22500000 | Real Madrid |
| Alaba        |               |             |
| Jude         |      20830000 | Real Madrid |
| Bellingham   |               |             |
+--------------+---------------+-------------+
```

### Key Insights
- **Salary Benchmark**: Barcelona's average salary serves as a comparison metric
- **Elite Compensation**: 5 Real Madrid players exceed Barcelona's team average
- **Highest Earner**: David Alaba leads at €22.5M annually
- **Investment Strategy**: Real Madrid appears to invest heavily in top-tier talent
- **Market Analysis**: Provides insight into competitive salary structures in La Liga

### Technical Features
- **Nested Subquery**: Inner query calculates Barcelona's average salary
- **WHERE Clause**: Filters for Real Madrid players above the calculated average
- **CONCAT Function**: Combines first and last names for better readability
- **Cross-Team Comparison**: Demonstrates complex business logic implementation

---

## 3. Referee Match Assignment History (`referee-history.php`)

### Query Type: GROUP BY with String Concatenation

**Purpose:** Track complete match assignment history for each referee, showing which home teams they've officiated.

### SQL Query
```sql
SELECT Referee_FName AS First_Name,
       Referee_LName AS Last_Name,
       GROUP_CONCAT(Match_Home_Team ORDER BY Match_Home_Team SEPARATOR ', ') AS Matches_Officiated,
       CONCAT(Referee_FName, ' ', Referee_LName) AS Full_Name
FROM Referee
JOIN GameMatch ON Referee.Referee_ID = GameMatch.Referee_ID
GROUP BY Referee.Referee_ID;
```

### Results
```
+----------------------+---------------------+----------------------------------------------------------------------------------------+----------------------------------+
| First_Name           | Last_Name           | Matches_Officiated                                                                     | Full_Name                        |
+----------------------+---------------------+----------------------------------------------------------------------------------------+----------------------------------+
| César                | Soto Grado          | Almería, Valencia, Villareal, Villareal                                               | César Soto Grado                 |
| Pablo                | González Fuertes    | Getafe, Getafe, Sevilla                                                               | Pablo González Fuertes           |
| Miguel Ángel         | Ortiz Arias         | Athletic Club, Las Palmas, Osasuna, Rayo Vallecano, Villareal                         | Miguel Ángel Ortiz Arias         |
| Javier               | Iglesias Villanueva | Granada, Rayo Vallecano, Real Madrid                                                  | Javier Iglesias Villanueva       |
| Jorge Figueroa       | Vázquez             | Barcelona, Girona, Granada, Valencia                                                  | Jorge Figueroa Vázquez           |
| Juan Luis            | Pulido Santana      | Atlético Madrid, Celta, Mallorca                                                      | Juan Luis Pulido Santana         |
| Mateo                | Busquets Ferrer     | Osasuna, Valencia                                                                     | Mateo Busquets Ferrer            |
| Jesús Gil            | Manzano             | Celta, Celta, Girona, Real Betis                                                      | Jesús Gil Manzano                |
| De Burgos            | Bengoetxea          | Athletic Club, Granada, Villareal                                                     | De Burgos Bengoetxea             |
| José María           | Sánchez Martínez    | Almería, Atlético Madrid, Las Palmas                                                  | José María Sánchez Martínez      |
| Francisco José       | Hernández Maeso     | Aláves, Cádiz, Cádiz, Real Madrid                                                     | Francisco José Hernández Maeso   |
| José Luis            | Munuera Montero     | Real Madrid                                                                           | José Luis Munuera Montero        |
| Guillermo Cuadra     | Fernández           | Almería, Rayo Vallecano, Rayo Vallecano, Real Sociedad                                | Guillermo Cuadra Fernández       |
| Alejandro Hernández  | Hernández           | Almería, Real Sociedad, Sevilla                                                       | Alejandro Hernández Hernández    |
| Juan Martínez        | Munuera             | Real Betis                                                                            | Juan Martínez Munuera            |
| Alejandro            | Muñiz Ruiz          | Barcelona, Sevilla                                                                    | Alejandro Muñiz Ruiz             |
| Víctor García        | Verdura             | Aláves, Athletic Club, Atlético Madrid, Cádiz, Celta, Girona, Girona, Real Sociedad   | Víctor García Verdura            |
| Javier               | Alberola Rojas      | Cádiz, Mallorca, Osasuna, Real Sociedad                                               | Javier Alberola Rojas            |
| Isidro Díaz de Mera  | Escuderos           | Aláves, Almería, Athletic Club, Barcelona, Mallorca, Osasuna, Real Betis, Real Betis  | Isidro Díaz de Mera Escuderos    |
| Mario                | Melero López        | Barcelona, Getafe, Granada, Las Palmas                                                | Mario Melero López               |
| Alejandro Ruiz       | Aguilera            | Aláves, Getafe, Las Palmas, Real Sociedad, Sevilla, Valencia                          | Alejandro Ruiz Aguilera          |
+----------------------+---------------------+----------------------------------------------------------------------------------------+----------------------------------+
```

### Key Insights
- **Assignment Patterns**: Shows which teams each referee has officiated for
- **Workload Visualization**: Víctor García Verdura shows the most diverse assignment history
- **Alphabetical Organization**: Teams listed alphabetically for each referee aids in pattern recognition
- **Repeat Assignments**: Some referees handle multiple matches for the same home team
- **Geographic Distribution**: Reveals potential regional assignment preferences

### Technical Features
- **GROUP_CONCAT**: Combines multiple match assignments into a single readable string
- **ORDER BY within GROUP_CONCAT**: Alphabetically sorts team names for each referee
- **Custom SEPARATOR**: Uses comma-space for clean, readable output
- **JOIN Operation**: Links referee and match data effectively

---

## 4. Complete Club Roster Overview (`club-rosters.php`)

### Query Type: LEFT OUTER JOIN with NULL Handling

**Purpose:** Display all La Liga clubs with their complete player rosters, including clubs that haven't registered any players yet.

### SQL Query
```sql
SELECT Club.Club_Name, 
       GROUP_CONCAT(CONCAT(Player_FName, ' ', Player_LName) SEPARATOR ', ') AS Players
FROM Club
LEFT OUTER JOIN Player ON Club.Club_Name = Player.Club_Name
GROUP BY Club_Name;
```

### Results
```
+------------------+------------------------------------------------------------------------------------------+
| Club_Name        | Players                                                                                  |
+------------------+------------------------------------------------------------------------------------------+
| Alavés           | NULL                                                                                     |
| Almería          | NULL                                                                                     |
| Athletic Club    | Unai Simón, Dani Vivian, Aitor Paredes, Yeray Álvarez, Mikel Vesga                     |
| Atlético Madrid  | Horațiu Moldovan, José Giménez, César Azpilicueta, Gabriel Paulista, Rodrigo De Paul   |
| Barcelona        | Marc-André ter Stegen, João Cancelo, Alejandro Balde, Ronald Araújo, Iñigo Martínez    |
| Cádiz            | NULL                                                                                     |
| Celta            | NULL                                                                                     |
| Getafe           | NULL                                                                                     |
| Girona           | Juan Carlos, Miguel Gutiérrez, Arnau Martínez, David López, Christhian Stuani          |
| Granada          | NULL                                                                                     |
| Las Palmas       | NULL                                                                                     |
| Mallorca         | NULL                                                                                     |
| Osasuna          | NULL                                                                                     |
| Rayo Vallecano   | NULL                                                                                     |
| Real Betis       | NULL                                                                                     |
| Real Madrid      | Thibaut Courtois, Daniel Carvajal, Éder Militão, David Alaba, Jude Bellingham          |
| Real Sociedad    | Álex Remiro, Álvaro Odriozola, Aihen Muñoz, Martín Zubimendi, Igor Zulbeldia           |
| Sevilla          | NULL                                                                                     |
| Valencia         | Jaume Doménech, Cristhian Mosquera, Mouctar Diakhaby, Hugo Guillamón, Sergi Canós      |
| Villareal        | NULL                                                                                     |
+------------------+------------------------------------------------------------------------------------------+
```

### Key Insights
- **Complete League Coverage**: All 20 La Liga clubs are represented
- **Data Completeness**: Only 7 clubs have player data registered (35% completion rate)
- **Major Club Focus**: Big clubs (Real Madrid, Barcelona, Atlético) have complete rosters
- **Missing Data Identification**: 13 clubs need player registration (65% require data entry)
- **Roster Sizes**: Active clubs show 5 registered players each

### Technical Features
- **LEFT OUTER JOIN**: Ensures all clubs appear, even without player data
- **NULL Handling**: Gracefully displays clubs without registered players
- **Nested CONCAT**: Combines first and last names within GROUP_CONCAT
- **Complete Data Coverage**: No clubs are excluded from results

---

## Query Complexity Analysis

### SQL Techniques Demonstrated

| Query | Primary Technique | Secondary Features | Difficulty Level |
|-------|-------------------|-------------------|------------------|
| Referee Analytics | Aggregate Functions | NATURAL JOIN, ORDER BY | Intermediate |
| Salary Analysis | Nested Subqueries | String Functions, Multi-table Logic | Advanced |
| Referee History | GROUP BY + Concatenation | String Manipulation, Sorting | Advanced |
| Club Rosters | LEFT OUTER JOIN | NULL Handling, Complete Coverage | Intermediate |

### Real-World Applications

**Sports Management:**
- Performance tracking and referee scheduling optimization
- Salary benchmarking and contract negotiation support
- Assignment history for transparency and fairness
- Roster management with complete organizational oversight

**Database Design Principles:**
- Demonstrates proper normalization with foreign key relationships
- Shows handling of optional data (players may not be registered)
- Implements complex business logic through SQL
- Provides multiple query patterns for different analytical needs

### Performance Considerations

- **Indexing**: Referee_ID and Club_Name should be indexed for optimal performance
- **Query Optimization**: NATURAL JOIN reduces complexity but explicit joins offer more control
- **Data Volume**: Current queries handle small dataset efficiently; scaling considerations needed for larger leagues
- **Memory Usage**: GROUP_CONCAT results could be large with full rosters; consider pagination for production use

---

## Conclusion

These four queries showcase the depth and complexity possible with SQL in a real-world sports management context. Each query serves a specific business purpose while demonstrating different technical approaches to data analysis and retrieval.

The implementation proves that academic database projects can address genuine industry needs while maintaining technical rigor and practical applicability.