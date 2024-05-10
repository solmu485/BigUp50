<!--@author Taulant Halimi -->
    $(document).ready(function() {
    // Hide the div to display Question and Answers //
    $("#divQuestion").hide();
    $("#loadingQuizMessage").hide();
    $("#divQuizSettings").hide(); // Hide quiz settings initially
    $("#divResults").hide();
    $("#divFeedback").hide();
    $("#buttonNextQuestion").hide(); // Hide the Next Question button initially

    let currentIndex = 0;
    let data;
    let points = 0;
    let sessionToken;
// Function to request a session token
    function requestSessionToken(callback) {
    $.ajax({
    url: "Back-End/getSessionToken.php",
    success: function(response) {
    sessionToken = response;
    console.log("Session token:", sessionToken);
    callback(); // Call the callback function once the token is retrieved
},
    error: function(xhr, status, error) {
    console.error("Error fetching session token:", error);
}
});
}


// Call the function to request the session token
    requestSessionToken(function() {
    // Now that the token is retrieved, we can proceed to retrieve questions
    $('#formQuizSettings').submit(function(event) {
    $("#answerQuiz").show();
    event.preventDefault();
    var amount = $("#inputQuizLength").val();
    var topic = $("#selectQuizTopic").val();
    var difficulty = $("#selectQuizDifficulty").val();
    var topicParameter = "";
    var difficultyParameter = "";

    if (topic !== "any") {
    topicParameter = "&category=" + topic;
}

    if (difficulty !== "any") {
    difficultyParameter = "&difficulty=" + difficulty;
}

    if (amount === "") {
    $("#errorMessages").html("<p>Please input the number of questions.</p>").css("color", "red");
    $("#divQuestion").hide();
} else {
    retrieveQuestions(amount, topicParameter, difficultyParameter);
}
    unloadQuizSettings();
});
});
    // Function to reset the session token
    function resetSessionToken(responseCode) {
    $.ajax({
    url: "Back-End/resetSessionToken.php?response_code=" + responseCode,
    success: function(response) {
    console.log("Session token reset");

},
    error: function(xhr, status, error) {
    console.error("Error resetting session token:", error);
}
});
}



    // Function to unload/reset quiz settings
    function unloadQuizSettings() {
    $("#inputQuizLength").val("");
    $("#selectQuizTopic").val("any");
    $("#selectQuizDifficulty").val("any");
    $("#errorMessages").empty();
    $("#divQuestion").hide();
    $("#h1Points").hide();

}

    // Function to display a question
    function displayQuestion(question) {
    // Set topic text
    $("#h2Topic").html(question.category);

    // Clear previous answers
    $("#answerQuiz").empty();

    // Display the question text (using html() instead of html() to handle special characters)
    $("#h3Question").html(question.question);

    // Store  correct answer
    var correctAnswer =question.correct_answer;

    // Add correct and incorrect answers to the HTML
    var answers = [question.correct_answer, ...question.incorrect_answers];
    answers.forEach(function(answer) {
    var button = $("<button type='button' class='answerButton'></button>").html(answer);
    var answer = answer;

    // Check if the  answer matches the  correct answer
    if (answer === correctAnswer) {
    button.attr("data-correct-answer", correctAnswer); // Set data attribute to mark correct answer
}
    $("#answerQuiz").append(button);
});
}

    // Function to retrieve questions
    function retrieveQuestions(amount, topicParameter, difficultyParameter) {
    $("#divQuizSettings").hide();
    $("#loadingQuizMessage").show();

    $.getJSON("https://opentdb.com/api.php?amount=" + amount + "&token=" + sessionToken + topicParameter + difficultyParameter, function(response) {
    if (response.response_code === 4) {
    resetSessionToken();
} else if (response.response_code !== 0) {
    setTimeout(function() {
    retrieveQuestions(amount, topicParameter, difficultyParameter);
}, 1000);
} else {
    $("#errorMessages").empty();
    $("#divQuizSettings").hide();
    $("#divQuestion").hide();

    data = response;
    currentIndex = 0;



    $("#h1Points").show();
    $("#h1Points").html("Total Points: " + points);

    displayQuestion(data.results[currentIndex]);
    $("#loadingQuizMessage").hide();
    $("#divQuestion").show();
    $("#buttonNextQuestion").hide();
}
});
}

    // Display Quiz Topics
    $.getJSON("https://opentdb.com/api_category.php", function(response) {
    $.each(response.trivia_categories, function(index, topic) {
    $("#selectQuizTopic").append("<option value='" + topic.id + "'>" + topic.name + "</option>");
});
    $("#divQuizSettings").show();
    $("#loadingTopicsMessage").hide();
});

    // Submit the Settings for the Quiz
    $('#formQuizSettings').submit(function(event) {
    $("#answerQuiz").show();
    event.preventDefault();
    var amount = $("#inputQuizLength").val();
    var topic = $("#selectQuizTopic").val();
    var difficulty = $("#selectQuizDifficulty").val();
    var topicParameter = "";
    var difficultyParameter = "";

    if (topic !== "any") {
    topicParameter = "&category=" + topic;
}

    if (difficulty !== "any") {
    difficultyParameter = "&difficulty=" + difficulty;
}

    if (amount === "") {
    $("#errorMessages").html("<p>Please input the number of questions.</p>").css("color", "red");
    $("#divQuestion").hide();
} else {
    retrieveQuestions(amount, topicParameter, difficultyParameter);
}
    unloadQuizSettings();
});

    // Event listener for answer buttons
    $(document).on("click", ".answerButton", function() {
    var selectedButton = $(this);
    var selectedAnswer = selectedButton.html();
    var correctAnswer = $("#answerQuiz").find(".answerButton[data-correct-answer]").attr("data-correct-answer");
    var questionText = $("#h3Question").html();
    var topic = $("#h2Topic").html();
    var isCorrect = (selectedAnswer === correctAnswer);

    $.post("Back-End/validateAnswer.php", {
    "POST_question": questionText,
    "POST_answer": selectedAnswer,
    "POST_correctAnswer": correctAnswer,

    "POST_endOfQuiz": (currentIndex >= data.results.length)
}, function(response) {
    var feedback = response;
    $("#divFeedback").show();
    $("#pFeedback").show();
    $("#pFeedback").html(feedback.message);

    if (isCorrect) {
    $("#pFeedback").css('text-shadow', '0 0 10px #0FFF50, 0 0 20px #0FFF50, 0 0 30px #0FFF50');
    selectedButton.css({ 'background-color': '#0FFF50', 'border': '10px solid #0FFF50' });
} else {
    $(".answerButton[data-correct-answer='" + correctAnswer + "']").css({ 'background-color': '#0FFF50', 'border': '10px solid #0FFF50' });
    selectedButton.css({ 'background-color': '#FF3131', 'border': '10px solid #FF3131' });
    $("#pFeedback").css('text-shadow', '0 0 10px #FF3131, 0 0 20px #FF3131, 0 0 30px #FF3131');
}

    if (isCorrect) {
    points++;
    $("#h1Points").html("Total Points: " + points);
}
    $("#h1Points").html("Total Points: " + points);

    $("#buttonNextQuestion").show();
    currentIndex++;

    setTimeout(function() {
    $(".answerButton").attr("disabled", true);
}, 100);
});
});

    // Event listener for the "Next Question" button
    $("#buttonNextQuestion").click(function() {
    if (currentIndex < data.results.length) {
    displayQuestion(data.results[currentIndex]);
    $("#divFeedback").hide();
    $("#pFeedback").hide();
    $(".answerButton").css({ 'background-color': '#007BFF', 'border': '10px solid #007BFF' });
} else {
    unloadQuizSettings();
    $("#divResults").show();
    $("#h2ResultsPoints").html("Total Points: " + points);
    $("#h1Points").hide();
    $("#divQuestion").hide();

    $("#loadingQuizMessage").hide();
    $("#divQuizSettings").hide();
    $("#buttonNextQuestion").hide();
    $("#pFeedback").empty();
}
});

    $("#buttonBackToSettings").click(function() {
    $("#divQuizSettings").show();
    $("#divResults").hide();
    points = 0;
});
});
