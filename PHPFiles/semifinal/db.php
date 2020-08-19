<?php
$hostname = "mpcs53001.cs.uchicago.edu";
$username = "jheng";
$password = "12175645";
$database = "jhengDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>