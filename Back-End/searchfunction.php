<?php
/** @author Musa und Franjo */
function searchBrawlers($search_name = null) {
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

    // Search functionality
    if ($search_name !== null) {
        $search_name = $conn->real_escape_string($search_name);
        $sql = "SELECT * FROM tblBrawler WHERE BrawlerName LIKE '%$search_name%'";
    } else {
        // Default query to display all brawlers
        $sql = "SELECT * FROM tblBrawler";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='tableauto'>";
        echo "<tr>";
        echo "<th>Brawler Name</th>";
        echo "<th>Description</th>";
        echo "<th>Rarity</th>";
        echo "<th>Category</th>";
        echo "<th>HP</th>";
        echo "<th>Speed</th>";
        echo "<th>Damage</th>";
        echo "<th>Damage Range</th>";
        echo "<th>Reload Speed</th>";
        echo "<th>Attack</th>";
        echo "<th>Attack Description</th>";
        echo "<th>Super Skill</th>";
        echo "<th>Super Skill Description</th>";
        echo "<th>Extra</th>";
        echo "<th>Epic Gear</th>";
        echo "<th>Mythic Gear</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["BrawlerName"] . "</td>";
            echo "<td>" . $row["BrawlerDescription"] . "</td>";
            echo "<td>" . $row["Rarity"] . "</td>";
            echo "<td>" . $row["Category"] . "</td>";
            echo "<td>" . $row["HP"] . "</td>";
            echo "<td>" . $row["Speed"] . "</td>";
            echo "<td>" . $row["Damage"] . "</td>";
            echo "<td>" . $row["DamageRange"] . "</td>";
            echo "<td>" . $row["ReloadSpeed"] . "</td>";
            echo "<td>" . $row["Attack"] . "</td>";
            echo "<td>" . $row["Attack_Description"] . "</td>";
            echo "<td>" . $row["SuperSkill"] . "</td>";
            echo "<td>" . $row["SuperSkill_Description"] . "</td>";
            echo "<td>" . $row["fiExtra"] . "</td>";
            echo "<td>" . $row["fiEpicGear"] . "</td>";
            echo "<td>" . $row["fiMythicGear"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
}

// Example usage:
// If you want to search for a specific brawler, you can call the function like this:
// searchBrawlers("Shelly");

// If you want to display all brawlers, you can call the function without any arguments:
// searchBrawlers();
?>
