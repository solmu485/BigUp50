<?php
$responseCode = $_GET['response_code'];

if ($responseCode == 4 || $responseCode == 3) {
    $response = file_get_contents("https://opentdb.com/api_token.php?command=request");
    echo $response;
} else {
    echo "Session token is not reset.";
}
?>
