<?php
// referee-analytics.php
// La Liga Management System - Referee Performance Analytics
// Aggregate Query: Shows referees and total matches officiated

    require_once("session.php");
    require_once("included_functions.php");
    require_once("database.php");

    new_header("Referee Analytics");

    // Connect to the database
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute the aggregate query
    $query = "SELECT Referee.Referee_ID, Referee.Referee_FName, Referee.Referee_LName, COUNT(GameMatch.Match_ID) AS Total_Matches_Refereed
              FROM Referee
              NATURAL JOIN GameMatch
              GROUP BY Referee.Referee_ID, Referee.Referee_FName, Referee.Referee_LName
              ORDER BY Total_Matches_Refereed DESC";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    // Display the results
    echo "<center>";
    echo "<h3>Referee Performance Analytics</h3>";
    echo "<p><em>Aggregate Query: Referees ranked by total matches officiated</em></p>";
    echo "<table>";
    echo "<tr><th style='text-align: left;'>Referee ID</th><th style='text-align: left;'>First Name</th><th style='text-align: left;'>Last Name</th><th style='text-align: left;'>Total Matches Officiated</th></tr>";

    // Fetch and display the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['Referee_ID']."</td>";
        echo "<td>".$row['Referee_FName']."</td>";
        echo "<td>".$row['Referee_LName']."</td>";
        echo "<td>".$row['Total_Matches_Refereed']."</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";

    echo "<br /><p>&laquo;<a href='readLiga.php'>Back to Main Page</a>";

    // Cleanup
    Database::dbDisconnect($mysqli);
    new_footer("Referee Analytics");
?>