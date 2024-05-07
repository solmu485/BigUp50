<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'brawlTalkUser');
define('DB_PW', 'brawlTalkPass');
define('DB_NAME', 'dbBrawlTalk');
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>