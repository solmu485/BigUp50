<?php
header('Content-Type: text/html; charset=UTF-8');
// Retrieve and decode question data from POST request //
$question = htmlspecialchars_decode(html_entity_decode(urldecode($_POST["POST_question"])));
$correctAnswer = htmlspecialchars_decode(html_entity_decode(urldecode($_POST["POST_correctAnswer"])));
$incorrectAnswers = $_POST["POST_incorrectAnswers"];
$topic = htmlspecialchars_decode(html_entity_decode(urldecode($_POST["POST_topic"])));

//define array with all answers //
$decodedIncorrectAnswers = array();
foreach ($incorrectAnswers as $incorrectAnswer) {
    array_push($decodedIncorrectAnswers, htmlspecialchars_decode(html_entity_decode(urldecode($incorrectAnswer))));
}

// Add correct answer to the array of incorrect answers //
array_push($decodedIncorrectAnswers, $correctAnswer);

// Shuffle the array of incorrect answers //
shuffle($decodedIncorrectAnswers);

// Create an associative array with the question, topic, and shuffled answers //
$data = array(
    "question" => $question,
    "topic" => $topic,
    "answers" => $decodedIncorrectAnswers
);

// Encode the data as JSON and send the response //
echo json_encode($data); 
?>
