<?php
$host = "localhost";
$user = "root";       // adjust as needed
$pass = "";
$db   = "school_db";  // your database name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
