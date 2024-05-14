<?php

//@author MELVIN

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

        // Character Filtern basierend auf de Input
        $filteredCharacters = array_filter($characters['list'], function($character) use ($searchTerm) {
            return strpos($character['name'], $searchTerm) !== false;
        });

        // Gefilterten Character wiedergeben
        echo json_encode(array_values($filteredCharacters));
    } elseif (isset($_GET['id'])) {
        $characterId = $_GET['id'];

        // ID vom Character Finden
        $foundCharacter = null;
        foreach ($characters['list'] as $character) {
            if ($character['id'] == $characterId) {
                $foundCharacter = $character;
                break;
            }
        }

        if ($foundCharacter !== null) {
            // ID vom Character wiedergeben
            echo json_encode($foundCharacter);
        } else {
            // Err Msg
            echo json_encode(['error' => 'Character not found']);
        }
    } else {
        echo $response;
    }
}

curl_close($curl);
?>