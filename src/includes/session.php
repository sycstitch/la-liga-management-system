<?php
// session.php
// La Liga Management System - Session Management
// Handles user sessions with automatic timeout and messaging system

	session_start();

	$now = time();
	if (isset($_SESSION["discard_after"]) && $now > $_SESSION["discard_after"]) {
		// Session has expired; destroy and start fresh
		session_unset();
		session_destroy();
		session_start();
	}

	// Set session to expire after 1 hour of activity
	$_SESSION["discard_after"] = $now + 3600;
	// Uncomment for shorter timeout during testing:
	// $_SESSION["discard_after"] = $now + 30;

	function message() {
		if (isset($_SESSION["message"])) {

			$output = "<div class='row'>";
			$output .= "<div data-alert class='alert-box info round'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";

			// Clear message after displaying to prevent duplicates
			$_SESSION["message"] = null;

			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];

			// Clear errors after retrieving to prevent duplicates
			$_SESSION["errors"] = null;

			return $errors;
		}
	}
?>