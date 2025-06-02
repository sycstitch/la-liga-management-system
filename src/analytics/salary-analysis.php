<?php
// salary-analysis.php
// La Liga Management System - Cross-Team Salary Analysis
// Nested Query: Real Madrid players earning above Barcelona's average salary

    require_once("../includes/session.php");
    require_once("../includes/functions.php");
    require_once("../includes/database.php");

    new_header("Salary Analysis");

    // Connect to the database
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute the nested subquery
    $query = "SELECT CONCAT(Player_FName, ' ', Player_LName) AS Player_Name, Player_Salary, Club_Name
              FROM Player
              WHERE Player_Salary > (
                  SELECT AVG(Player_Salary)
                  FROM Player
                  WHERE Club_Name = 'Barcelona'
              ) AND Club_Name = 'Real Madrid'";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    // Display the results
    echo "<center>";
    echo "<h3>Cross-Team Salary Analysis</h3>";
    echo "<p><em>Nested Query: Real Madrid players earning above Barcelona's average salary</em></p>";
    echo "<table>";
    echo "<tr><th style='text-align: left;'>Player Name</th><th style='text-align: left;'>Salary</th><th style='text-align: left;'>Club</th></tr>";

    // Fetch and display the results
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['Player_Name']."</td>";
        echo "<td>".$row['Player_Salary']."</td>";
        echo "<td>".$row['Club_Name']."</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";

    echo "<br /><p>&laquo;<a href='../index.php'>Back to Main Page</a>";

    // Cleanup
    Database::dbDisconnect($mysqli);
    new_footer("Salary Analysis");
?>