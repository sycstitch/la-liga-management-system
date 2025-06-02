<?php
// readLiga.php
// La Liga Management System - Main Dashboard
// Primary interface for viewing matches and accessing all system functions

    require_once("session.php");
    require_once("included_functions.php");
    require_once("database.php");

    new_header("La Liga Dashboard");
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (($output = message()) !== null) {
        echo $output;
    }
?>

<!-- Navigation Menu -->
<center>
    <div class="link-container" style="text-align: center; margin-bottom: 20px;">
        <div class="link-item" style="display: inline-block;">
            <a href='createLiga.php'>Add Match</a>
        </div>
        <div class="separator" style="display: inline-block; margin: 0 10px;">|</div>
        <div class="link-item" style="display: inline-block;">
            <a href='referee-analytics.php'>Referee Analytics</a>
        </div>
        <div class="separator" style="display: inline-block; margin: 0 10px;">|</div>
        <div class="link-item" style="display: inline-block;">
            <a href='salary-analysis.php'>Salary Analysis</a>
        </div>
        <div class="separator" style="display: inline-block; margin: 0 10px;">|</div>
        <div class="link-item" style="display: inline-block;">
            <a href='referee-history.php'>Match History</a>
        </div>
        <div class="separator" style="display: inline-block; margin: 0 10px;">|</div>
        <div class="link-item" style="display: inline-block;">
            <a href='club-rosters.php'>Club Rosters</a>
        </div>
    </div>
</center>

<?php
    // Fetch matches with team and referee information using complex JOIN
    $query = "SELECT gm.*, home_team.Club_Name AS home_team_name, away_team.Club_Name AS away_team_name, CONCAT(r.Referee_FName, ' ', r.Referee_LName) AS referee_name
              FROM GameMatch gm
              INNER JOIN Club home_team ON gm.Match_Home_Team = home_team.Club_Name
              INNER JOIN Club away_team ON gm.Match_Away_Team = away_team.Club_Name
              INNER JOIN Referee r ON gm.Referee_ID = r.Referee_ID
              ORDER BY Match_Date";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();

    // Display matches in organized table
    echo "<div class='row'>";
    echo "<center>";
    echo "<h2>Match Results & Schedule</h2>";
    echo "<table>";
    echo "  <thead>";
    echo "     <tr><td><strong>Date</strong></td><td><strong>Home Team</strong></td><td><strong>Away Team</strong></td><td><strong>Home Score</strong></td><td><strong>Away Score</strong></td><td><strong>Referee</strong></td><td><strong>Edit</strong></td><td><strong>Delete</strong></td></tr>";
    echo "  </thead>";
    echo "  <tbody>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract match information from query results
        $matchID = $row['Match_ID'];
        $date = $row['Match_Date'];
        $homeTeam = $row['home_team_name'];
        $awayTeam = $row['away_team_name'];
        $homePoints = $row['Match_Home_Points'];
        $awayPoints = $row['Match_Away_Points'];
        $referee = $row['referee_name'];

        echo "<tr>";
        echo "<td>$date</td>";
        echo "<td>$homeTeam</td>";
        echo "<td>$awayTeam</td>";
        echo "<td>$homePoints</td>";
        echo "<td>$awayPoints</td>";
        echo "<td>$referee</td>";
        echo "<td><a href='updateLiga.php?id=".urlencode($matchID)."'>Edit</a></td>";
        echo "<td><a href='deleteLiga.php?id=".urlencode($matchID)."' onclick='return confirm(\"Are you sure you want to delete this match?\");'>Delete</a></td>";
        echo "</tr>";
    }

    echo "  </tbody>";
    echo "</table>";
    echo "</center>";
    echo "</div>";

    new_footer("La Liga Dashboard");
    Database::dbDisconnect($mysqli);
?>