<?php
class Database {
  public function __construct() {
    die('Init function error');
  }

  public static function dbConnect() {
    $mysqli = null;

    // Load database configuration
    require_once("config.php");

    // Attempt database connection
    try {
        $mysqli = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, USERNAME, PASSWORD);
        $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Troubleshooting connection
        // echo("Successful Connection");
      }
    catch (PDOException $e)  {
        echo "Could not connect to database";
        die($e->getMessage());
    }

    return $mysqli;
  }

  public static function dbDisconnect() {
    $mysqli = null;
  }
}