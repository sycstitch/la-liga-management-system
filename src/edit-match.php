<?php
// edit-match.php
// La Liga Management System - Match Editing Module
// Provides interface for modifying existing match records

require_once("includes/session.php");
require_once("includes/functions.php");
require_once("includes/database.php");

new_header("Edit Match");

$mysqli = Database::dbConnect();
$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
    echo $output;
}

echo "<h3>Edit Match Information</h3>";
echo "<div class='row'>";
echo "<label for='left-label' class='left inline'>";

if (isset($_POST["submit"])) {
    if (isset($_POST["Match_ID"]) && $_POST["Match_ID"] !== "" &&
        isset($_POST["Match_Date"]) && $_POST["Match_Date"] !== "" &&
        isset($_POST["Match_Home_Team"]) && $_POST["Match_Home_Team"] !== "" &&
        isset($_POST["Match_Away_Team"]) && $_POST["Match_Away_Team"] !== "" &&
        isset($_POST["Match_Home_Points"]) && $_POST["Match_Home_Points"] !== "" &&
        isset($_POST["Match_Away_Points"]) && $_POST["Match_Away_Points"] !== "" &&
        isset($_POST["Referee_ID"]) && $_POST["Referee_ID"] !== "") {

        // Update match information with validated data
        $query = "UPDATE GameMatch SET Match_Date=?, Match_Home_Team=?, Match_Away_Team=?, Match_Home_Points=?, Match_Away_Points=?, Referee_ID=? WHERE Match_ID=?";
        $stmt = $mysqli->prepare($query);
        $stmt->execute([$_POST['Match_Date'], $_POST['Match_Home_Team'], $_POST['Match_Away_Team'], $_POST['Match_Home_Points'], $_POST['Match_Away_Points'], $_POST['Referee_ID'], $_POST['Match_ID']]);

        if ($stmt) {
            $_SESSION["message"] = "Match updated successfully.";
        } else {
            $_SESSION["message"] = "Error! Could not update the match.";
        }

        redirect("index.php");
    } else {
        $_SESSION["message"] = "Unable to update match. Fill in all information!";
        redirect("edit-match.php?id=".$_POST['Match_ID']);
    }
} else {
    if (isset($_GET["id"]) && $_GET["id"] !== "") {
        // Fetch existing match data for editing
        $query = "SELECT * FROM GameMatch WHERE Match_ID = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->execute([$_GET['id']]);

        if ($stmt)  {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<form action='edit-match.php' method='POST'>";

            echo "<input type='hidden' name='Match_ID' value='".$row['Match_ID']."' />";

            echo "<label for='Match_Date'>Date:</label>";
            echo "<input type='date' name='Match_Date' id='Match_Date' value='".$row['Match_Date']."' required><br>";

            // Populate Home Team dropdown with current selection
            echo "<label for='Match_Home_Team'>Home Team:</label>";
            $queryHomeTeams = "SELECT * FROM Club";
            $stmtHomeTeams = $mysqli->prepare($queryHomeTeams);
            $stmtHomeTeams->execute();
            echo "<select name='Match_Home_Team' id='Match_Home_Team' required>";
            while ($rowClub = $stmtHomeTeams->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$rowClub['Club_Name']."'";
                if ($rowClub['Club_Name'] == $row['Match_Home_Team']) {
                    echo " selected";
                }
                echo ">".$rowClub['Club_Name']."</option>";
            }
            echo "</select><br>";

            // Populate Away Team dropdown with current selection
            echo "<label for='Match_Away_Team'>Away Team:</label>";
            $queryAwayTeams = "SELECT * FROM Club";
            $stmtAwayTeams = $mysqli->prepare($queryAwayTeams);
            $stmtAwayTeams->execute();
            echo "<select name='Match_Away_Team' id='Match_Away_Team' required>";
            while ($rowClub = $stmtAwayTeams->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$rowClub['Club_Name']."'";
                if ($rowClub['Club_Name'] == $row['Match_Away_Team']) {
                    echo " selected";
                }
                echo ">".$rowClub['Club_Name']."</option>";
            }
            echo "</select><br>";

            echo "<label for='Match_Home_Points'>Home Score:</label>";
            echo "<input type='number' name='Match_Home_Points' id='Match_Home_Points' value='".$row['Match_Home_Points']."' required><br>";

            echo "<label for='Match_Away_Points'>Away Score:</label>";
            echo "<input type='number' name='Match_Away_Points' id='Match_Away_Points' value='".$row['Match_Away_Points']."' required><br>";

            // Populate Referee dropdown with current selection
            echo "<label for='Referee_ID'>Referee:</label>";
            $queryReferees = "SELECT * FROM Referee";
            $stmtReferees = $mysqli->prepare($queryReferees);
            $stmtReferees->execute();
            echo "<select name='Referee_ID' id='Referee_ID' required>";
            while ($rowReferee = $stmtReferees->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$rowReferee['Referee_ID']."'";
                if ($rowReferee['Referee_ID'] == $row['Referee_ID']) {
                    echo " selected";
                }
                echo ">".$rowReferee['Referee_FName']." ".$rowReferee['Referee_LName']."</option>";
            }
            echo "</select><br>";

            echo "<center><input type='submit' name='submit' value='Update Match' class='tiny round button'></center>";
            echo "</form>";

            echo "<br /><p>&laquo;<a href='index.php'>Back to Main Page</a>";
            echo "</label>";
            echo "</div>";
        } else {
            $_SESSION["message"] = "Match could not be found!";
            redirect("index.php");
        }
    }
}

new_footer("Edit Match");
Database::dbDisconnect($mysqli);
?>