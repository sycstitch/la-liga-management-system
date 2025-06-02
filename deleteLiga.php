<?php
// deleteLiga.php
// La Liga Management System - Match Deletion Module

	// Require needed files
	require_once("session.php");
	require_once("included_functions.php");
	require_once("database.php");

	new_header("La Liga Matches");

	// Connect to database
	$mysqli = Database::dbConnect();
	$mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Output any session messages
	if (($output = message()) !== null) {
		echo $output;
	}

	if (isset($_GET["id"]) && $_GET["id"] !== "") {
		// Prepare and execute DELETE query using GET id parameter
		try {
			$query = "DELETE FROM GameMatch WHERE Match_ID = ?";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_GET["id"]]);

			if ($stmt) {
				// Create success message
				$_SESSION["message"] = "Match was successfully deleted";
			}
			else {
				// Create error message
				$_SESSION["message"] = "Error! Match could not be deleted";
			}
		}
		catch (PDOException $e) {
			$_SESSION["message"] = "Error: " . $e->getMessage();
		}

		redirect("readLiga.php");
	}
	else {
		$_SESSION["message"] = "Match could not be found!";
		redirect("readLiga.php");
	}

	// Footer and cleanup
	new_footer("La Liga Matches");
	Database::dbDisconnect($mysqli);
?>