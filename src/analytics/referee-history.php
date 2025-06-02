<?php
// referee-history.php
// La Liga Management System - Referee Match History
// GROUP BY Query: Complete match assignment history for each referee

    require_once("../includes/session.php");
    require_once("../includes/functions.php");
    require_once("../includes/database.php");

    new_header("Referee Match History");

    // Connect to the database
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute the GROUP BY query with concatenation
    $query = "SELECT Referee_FName AS First_Name,
                     Referee_LName AS Last_Name,
                     GROUP_CONCAT(Match_Home_Team ORDER BY Match_Home_Team SEPARATOR ', ') AS Matches_Officiated,
                     CONCAT(Referee_FName, ' ', Referee_LName) AS Full_Name
              FROM Referee
              JOIN GameMatch ON Referee.Referee_ID = GameMatch.Referee_ID
              GROUP BY Referee.Referee_ID";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    // Display the results
    echo "<center>";
    echo "<h3>Referee Match Assignment History</h3>";
    echo "<p><em>GROUP BY Query: Home teams officiated by each referee (alphabetically sorted)</em></p>";
    echo "<table>";
    echo "<tr><th style='text-align: left;'>First Name</th><th style='text-align: left;'>Last Name</th><th style='text-align: left;'>Home Teams Officiated</th></tr>";

    // Fetch and display the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['First_Name']."</td>";
        echo "<td>".$row['Last_Name']."</td>";
        echo "<td>".$row['Matches_Officiated']."</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";

    echo "<br /><p>&laquo;<a href='../index.php'>Back to Main Page</a>";

    // Cleanup
    Database::dbDisconnect($mysqli);
    new_footer("Referee Match History");
?>