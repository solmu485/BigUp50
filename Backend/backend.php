<?php
if (isset($_GET['query'])) {
    $searchQuery = urlencode($_GET['query']);
    $apiKey = "Mt33QYqwfeoVOarIm4kVrzDntC8Vcpzd";
    $url = "https://api.giphy.com/v1/gifs/search?api_key=$apiKey&q=$searchQuery&limit=25&offset=0&rating=g&lang=en&bundle=messaging_non_clips";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
        //print_r($response);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $data = json_decode($response, true);
        $gifs = $data['data'];
        foreach ($gifs as $gif) {
            echo "<img src='" . $gif['images']['original']['url'] . "' alt='GIF'>";
        }
    }
}
?>
