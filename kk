<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Brawl Stars Characters</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<select id="characterList">
    <option value="">-- Select a Character --</option>
</select>
<div id="characterDetails">
    <!-- Character details will be displayed here -->
</div>

<script>
    $(document).ready(function() {
        // Function to fetch characters and populate the dropdown list
        function fetchCharacters() {
            $.ajax({
                url: "backend.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (!response.error) {
                        $.each(response.list, function(index, character) {
                            $("#characterList").append('<option value="' + character.id + '">' + character.name + '</option>');
                        });
                    } else {
                        console.error("Error fetching characters:", response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching characters:", error);
                }
            });
        }

        // Fetch characters and populate the dropdown list on page load
        fetchCharacters();

        // Function to fetch character details when selected from the list
        $("#characterList").change(function() {
            var characterId = $(this).val();
            if (characterId !== '') {
                $.ajax({
                    url: "backend.php",
                    type: "GET",
                    data: { id: characterId },
                    dataType: "json",
                    success: function(response) {
                        if (!response.error) {
                            $("#characterDetails").html('<h2>' + response.name + '</h2><p>' + response.description + '</p>');
                            // Add other details as needed
                        } else {
                            console.error("Error getting character details:", response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error getting character details:", error);
                    }
                });
            }
        });
    });
</script>
</body>
</html>




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
    } else {
        // Return all characters if no search term is provided
        echo $response;
    }
}

curl_close($curl);
?>
