<?php
// club-rosters.php
// La Liga Management System - Club Roster Management
// LEFT OUTER JOIN Query: Complete club listings with all players

    require_once("session.php");
    require_once("included_functions.php");
    require_once("database.php");

    new_header("Club Rosters");

    // Connect to the database
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute the LEFT OUTER JOIN query
    $query = "SELECT Club.Club_Name, GROUP_CONCAT(CONCAT(Player_FName, ' ', Player_LName) SEPARATOR ', ') AS Players
                FROM Club
                LEFT OUTER JOIN Player ON Club.Club_Name = Player.Club_Name
                GROUP BY Club_Name";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    // Display the results
    echo "<center>";
    echo "<h3>Complete Club Roster Overview</h3>";
    echo "<p><em>LEFT OUTER JOIN Query: All clubs with their complete player rosters</em></p>";
    echo "<table>";
    echo "<tr><th style='text-align: left;'>Club Name</th><th style='text-align: left;'>Players</th></tr>";

    // Fetch and display the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['Club_Name']."</td>";
        echo "<td>".($row['Players'] ? $row['Players'] : 'No players registered')."</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";

    echo "<br /><p>&laquo;<a href='readLiga.php'>Back to Main Page</a>";

    // Cleanup
    Database::dbDisconnect($mysqli);
    new_footer("Club Rosters");
?>