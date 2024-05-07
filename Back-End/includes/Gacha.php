<?php


// MySQL database configuration
$servername = "89.58.47.144"; // Change this to your database server name
$username = "brawlTalkUser"; // Change this to your database username
$password = "brawlTalkPass"; // Change this to your database password
$database = "dbBrawlTalk"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Execute query to select random prize from the database
$sql = "SELECT PrizeName, Rarity FROM Gacha ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

// Check if result is not empty
if ($result->num_rows > 0) {
  // Output data of each row
  while($row = $result->fetch_assoc()) {
    $prize_name = $row["PrizeName"];
    $rarity = $row["Rarity"];

    // Generate Brawler image URL based on name
    $brawler_image_url = "https://cdn-fankit.brawlify.com/" . strtolower(str_replace(' ', '_', $prize_name)) . "_pin.png";

    // Print congratulatory message with the Brawler image and colored rarity
    echo "<h2>Congratulations! You won $prize_name";
    echo "<span class='rarity $rarity'> ($rarity)</span></h2>";
    echo "<img src='$brawler_image_url' alt='$prize_name' width='300' height='300' >";
  }
} else {
  echo "No prizes found in the database";
}

// Close connection
$conn->close();
?>
