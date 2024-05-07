<?php
/** @author Walers Jean*/
// Make a GET request to the API
$response = file_get_contents('sources/api/maps.json');

// Check if API request was successful
if ($response === FALSE) {
    die("Failed to fetch data from API");
}

// Decode the JSON response
$data = json_decode($response, true);

// Check if decoding was successful
if ($data === NULL || !isset($data['list'])) {
    die("Invalid JSON response from API");
}

// Prepare an array to hold image names and URLs
$imageData = array();

// Loop through each map from the API response
foreach ($data['list'] as $map) {
    // Extract the map name and image URL
    $imageName = $map['name'];
    $imageUrl = $map['imageUrl'];

    // Add the image name and URL to the array
    $imageData[] = array(
        'name' => $imageName,
        'url' => $imageUrl
    );
}

// Output the image information in JSON format
$jsonOutput = json_encode($imageData, JSON_PRETTY_PRINT);
file_put_contents('images.json', $jsonOutput);

// Output JSON data
echo $jsonOutput;

?>