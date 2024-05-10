<?php
// Function to fetch data from API endpoint
function fetchData($url) {
    // Make a GET request to the API
    $response = file_get_contents($url);

    // Check if API request was successful
    if ($response === FALSE) {
        die("Failed to fetch data from API");
    }

    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if decoding was successful
    if ($data === NULL || empty($data)) {
        die("Invalid JSON response from API");
    }

    return $data['list'];
}

// Fetch map data from the map API endpoint
$mapsData = fetchData('sources/api/maps.json');

// Fetch game mode data from the game mode API endpoint
$gameModesData = fetchData('sources/api/gamemodes.json');

// Combine map and game mode data
$combinedData = array();

foreach ($mapsData as $map) {
    $mapName = $map['name'];
    $mapImageUrl = $map['imageUrl'];
    $gameModeName = $map['gameMode']['name'];

    // Find the corresponding game mode data
    $gameModeData = array_filter($gameModesData, function ($gameMode) use ($gameModeName) {
        return $gameMode['name'] === $gameModeName;
    });

    // If game mode data is found, add it to the combined data
    if (!empty($gameModeData)) {
        $gameModeData = reset($gameModeData);
        $gameModeImageUrl = $gameModeData['imageUrl2'];

        $combinedData[] = array(
            'map_name' => $mapName,
            'map_image_url' => $mapImageUrl,
            'game_mode_name' => $gameModeName,
            'game_mode_image_url' => $gameModeImageUrl
        );
    }
}

// Output the combined data as JSON
header('Content-Type: application/json');
echo json_encode($combinedData, JSON_PRETTY_PRINT);
?>
