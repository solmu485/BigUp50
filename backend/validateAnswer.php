<?php
header('Content-Type: application/json; charset=UTF-8');

$question = htmlspecialchars_decode(html_entity_decode(urldecode($_POST["POST_question"])));
$correctAnswer = htmlspecialchars_decode(html_entity_decode(urldecode($_POST["POST_correctAnswer"])));
$selectedAnswer = htmlspecialchars_decode(html_entity_decode(urldecode($_POST["POST_answer"])));


if ($selectedAnswer == $correctAnswer) {

    $message = "Correct! The answer to the question is: ".$correctAnswer;
} else {
    $message = "Wrong answer. The correct answer is: " . $correctAnswer;
}



$response = array("message" => $message);
echo json_encode($response);
?>
