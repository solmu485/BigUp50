<?php
// Check if flag and count parameters are set
if (isset($_GET['flag']) && isset($_GET['count'])) {
    $flag = $_GET['flag'];
    $count = $_GET['count'];

    // Output the values for debugging
    error_log("Flag: $flag, Count: $count");

    // Include database connection
    include 'db_cred.php';

    // Prepare and execute SQL query
    $stmt = $conn->prepare("SELECT Name, Trophies, Rank, ClubName, Country FROM Player WHERE Country = ? ORDER BY Rank ASC LIMIT ?");
    $stmt->bind_param("si", $flag, $count);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any row is returned
    if ($result->num_rows > 0) {
        // Start table
        echo '<table>';
        echo '<tr><th>Name</th><th>Trophies</th><th>Rank</th><th>Club</th><th>Country</th></tr>';

        // Output each row as a table row
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['Trophies'] . '</td>';
            echo '<td>' . $row['Rank'] . '</td>';
            echo '<td>' . $row['ClubName'] . '</td>';
            echo '<td>' . $row['Country'] . '</td>';
            echo '</tr>';
        }

        // End table
        echo '</table>';
    } else {
        echo "No data found for the selected flag.";
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo "Flag or count parameter not set.";
}
?>
