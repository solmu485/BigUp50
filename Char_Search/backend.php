<?php
// backend/index.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$url = 'https://api.brawlapi.com/v1/brawlers';

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
]);
$response = curl_exec($curl);

if ($response === false) {
    echo json_encode(['error' => 'Failed to fetch data from API']);
} else {
    $characters = json_decode($response, true);

    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];

        // Filter characters based on the search term
        $filteredCharacters = array_filter($characters['list'], function($character) use ($searchTerm) {
            return stripos($character['name'], $searchTerm) !== false;
        });

        // Return the filtered list of characters
        echo json_encode(array_values($filteredCharacters));
    } elseif (isset($_GET['id'])) {
        $characterId = $_GET['id'];

        // Find the character with the provided ID
        $foundCharacter = null;
        foreach ($characters['list'] as $character) {
            if ($character['id'] == $characterId) {
                $foundCharacter = $character;
                break;
            }
        }

        // Check if the character with the provided ID was found
        if ($foundCharacter !== null) {
            // Output the details of the character with the provided ID
            echo json_encode($foundCharacter);
        } else {
            // Return error message if character not found
            echo json_encode(['error' => 'Character not found']);
        }
    } else {
        // Return all characters if no search term or character ID is provided
        echo $response;
    }
}

curl_close($curl);
?>
