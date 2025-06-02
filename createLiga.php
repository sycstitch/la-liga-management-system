<?php
//createLiga.php
// -- Database Systems Project
// -- La Liga Management System
// -- Match Creation Module

    require_once("session.php");
    require_once("included_functions.php");
    require_once("database.php");

    new_header("Add a Match");
    $mysqli = Database::dbConnect();
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (($output = message()) !== null) {
        echo $output;
    }

    echo "<h3>Add a Match</h3>";
    echo "<div class='row'>";
    echo "<label for='left-label' class='left inline'>";

    if (isset($_POST["submit"])) {
        if (isset($_POST["Match_Date"]) && $_POST["Match_Date"] !== "" &&
            isset($_POST["Match_Home_Team"]) && $_POST["Match_Home_Team"] !== "" &&
            isset($_POST["Match_Away_Team"]) && $_POST["Match_Away_Team"] !== "" &&
            isset($_POST["Match_Home_Points"]) && $_POST["Match_Home_Points"] !== "" &&
            isset($_POST["Match_Away_Points"]) && $_POST["Match_Away_Points"] !== "" &&
            isset($_POST["Referee_ID"]) && $_POST["Referee_ID"] !== "") {

            // Prepare and execute query to insert match information
            $queryInsertMatch = "INSERT INTO GameMatch (Match_Date, Match_Home_Team, Match_Away_Team, Match_Home_Points, Match_Away_Points, Referee_ID) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($queryInsertMatch);
            $stmt->execute([$_POST['Match_Date'], $_POST['Match_Home_Team'], $_POST['Match_Away_Team'], $_POST['Match_Home_Points'], $_POST['Match_Away_Points'], $_POST['Referee_ID']]);

            if ($stmt) {
                $_SESSION["message"] = "Match added successfully.";
            } else {
                $_SESSION["message"] = "Error! Could not add the match.";
            }

            // Redirect back to main page
            redirect("readLiga.php");
        } else {
            $_SESSION["message"] = "Unable to add match. Fill in all information!";
            redirect("createLiga.php");
        }
    } else {
        // Create form for adding new matches
        echo "<form action='createLiga.php' method='POST'>";
        echo "<label for='Match_Date'>Date:</label>";
        echo "<input type='date' name='Match_Date' id='Match_Date' required><br>";

        // Query to populate Home Team dropdown
        echo "<label for='Match_Home_Team'>Home Team:</label>";
        $queryTeams = "SELECT * FROM Club";
        $stmtTeams = $mysqli->prepare($queryTeams);
        $stmtTeams->execute();
        echo "<select name='Match_Home_Team' id='Match_Home_Team' required>";
        while ($rowClub = $stmtTeams->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$rowClub['Club_Name']."'";
            if (isset($row) && $rowClub['Club_Name'] == $row['Club_Name']) {
                echo " selected";
            }
            echo ">".$rowClub['Club_Name']."</option>";
        }
        echo "</select><br>";

        // Query to populate Away Team dropdown
        echo "<label for='Match_Away_Team'>Away Team:</label>";
        $queryTeams = "SELECT * FROM Club";
        $stmtTeams = $mysqli->prepare($queryTeams);
        $stmtTeams->execute();
        echo "<select name='Match_Away_Team' id='Match_Away_Team' required>";
        while ($rowClub = $stmtTeams->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$rowClub['Club_Name']."'";
            if (isset($row) && $rowClub['Club_Name'] == $row['Club_Name']) {
                echo " selected";
            }
            echo ">".$rowClub['Club_Name']."</option>";
        }
        echo "</select><br>";

        echo "<label for='Match_Home_Points'>Home Points:</label>";
        echo "<input type='number' name='Match_Home_Points' id='Match_Home_Points' required><br>";
        echo "<label for='Match_Away_Points'>Away Points:</label>";
        echo "<input type='number' name='Match_Away_Points' id='Match_Away_Points' required><br>";

        echo "<label for='Referee_ID'>Referee:</label>";
        // Query to populate Referee dropdown
        $queryReferees = "SELECT * FROM Referee ORDER BY Referee_FName";
        $stmtReferees = $mysqli->prepare($queryReferees);
        $stmtReferees->execute();
        echo "<select name='Referee_ID' id='Referee_ID' required>";
        while ($rowReferee = $stmtReferees->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$rowReferee['Referee_ID']."'>".$rowReferee['Referee_FName']." ".$rowReferee['Referee_LName']."</option>";
        }
        echo "</select><br>";

        echo "<center><input type='submit' name='submit' value='Add Match' class='tiny round button'></center>";
        echo "</form>";
    }

    echo "</label>";
    echo "</div>";
    echo "<br /><p>&laquo;<a href='readLiga.php'>Back to Main Page</a>";

    // Footer
    new_footer("Matches");

    // Disconnect from database
    Database::dbDisconnect($mysqli);
?>