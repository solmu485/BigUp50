<?php
session_start();

if (!isset($_SESSION['sessionToken'])) {
    $url = 'https://opentdb.com/api_token.php?command=request';
    $response = file_get_contents($url);
    $responseData = json_decode($response, true);

    if (isset($responseData['token'])) {
        $_SESSION['sessionToken'] = $responseData['token'];
    } else {
        echo "Error: Unable to retrieve session token from OpenTDB API.";
        exit();
    }
}

echo $_SESSION['sessionToken'];
?>
