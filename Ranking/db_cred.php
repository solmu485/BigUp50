<?php
// Database credentials
$servername = "89.58.47.144";
$username = "brawlTalkUser";
$password = "brawlTalkPass";
$database = "dbBrawlTalk"; // Replace 'your_database_name' with the actual name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
?>
