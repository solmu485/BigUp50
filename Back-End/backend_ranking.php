<?php

function fetchDataFromAPI($apiKey, $country, $limit) {
    $url = "https://api.brawlstars.com/v1/rankings/$country/players?limit=$limit";
    $headers = array(
        'Authorization: Bearer ' . $apiKey
    );

    print_r($apiKey,$url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // print_r($response);

    return json_decode($response, true);
}

// Schaut ob Flage und Count gesetzt wurde
if (isset($_GET['flag']) && isset($_GET['count'])) {
    $flag = $_GET['flag'];
    $count = $_GET['count'];

    // Debugging
    error_log("Flag: $flag, Count: $count");

    // Apikey
    $apiKey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6IjFjZDg2OTZmLWJjNzYtNDY4YS05MzAxLTQ3MWVhN2M1YmI0YiIsImlhdCI6MTcxNDcxNzQ1OSwic3ViIjoiZGV2ZWxvcGVyL2UxMjlkM2M3LTcxNzYtZDIwMi04ODk2LTA3ZjBhZDc2YTk3ZSIsInNjb3BlcyI6WyJicmF3bHN0YXJzIl0sImxpbWl0cyI6W3sidGllciI6ImRldmVsb3Blci9zaWx2ZXIiLCJ0eXBlIjoidGhyb3R0bGluZyJ9LHsiY2lkcnMiOlsiMTU4LjY0LjUuNyJdLCJ0eXBlIjoiY2xpZW50In1dfQ.yq4MawT8n154GdaQwhm6QSUQofdU-dKtblUgYpl5luOwBh7p9kvTnZKFyXt1R5PKeee4CqWPGY_Ia-aN9Jq9wA";

    // echo $apiKey;

    // Scshaut ob Apikey existiert
    if ($apiKey !== false) {
        // Nimmt Daten aus der API
        $apiData = fetchDataFromAPI($apiKey, $flag, $count);

        if (isset($apiData['items']) && is_array($apiData['items'])) {
            // Wenn Erfolgreich dann code ausführen
            echo '<table>';
            echo '<tr><th>Name</th><th>Trophies</th><th>Rank</th><th>Club</th><th>Country</th></tr>';

            foreach ($apiData['items'] as $player) {
                echo '<tr>';
                echo '<td>' . $player['name'] . '</td>';
                echo '<td>' . $player['trophies'] . '</td>';
                echo '<td>' . $player['rank'] . '</td>';
                echo '<td>' . (isset($player['club']['name']) ? $player['club']['name'] : '') . '</td>';
                echo '<td>' . $flag . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "No player data found.";
            echo "Fetching Data from Database";


            // Wenn Api Failed, dann Daten aus der Datanbank auslesen
            include 'db_cred.php';

            // SQL Query preparieren
            $stmt = $conn->prepare("SELECT Name, Trophies, Rank, ClubName, Country FROM Player WHERE Country = ? ORDER BY Rank ASC LIMIT ?");
            $stmt->bind_param("si", $flag, $count);
            $stmt->execute();
            $result = $stmt->get_result();

            // Schaut ob wir etwas zurück bekommen
            if ($result->num_rows > 0) {
                // Start table
                echo '<table>';
                echo '<tr><th>Name</th><th>Trophies</th><th>Rank</th><th>Club</th><th>Country</th></tr>';

                // Gibt alles als table wieder
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['Name'] . '</td>';
                    echo '<td>' . $row['Trophies'] . '</td>';
                    echo '<td>' . $row['Rank'] . '</td>';
                    echo '<td>' . $row['ClubName'] . '</td>';
                    echo '<td>' . $row['Country'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo "No data found for the selected flag.";
            }

            $stmt->close();
            $conn->close();
        }
    }
}
?>
