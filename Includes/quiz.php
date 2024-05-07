<?php
echo '
<link rel="stylesheet" href="../Styles/style_quiz.css">

<header>
    <h1 id="h1Quiz">Trivial Quiz</h1>
</header>

<div id="loadingTopicsMessage">Loading...</div>

<div id="divQuizSettings">
    <form id="formQuizSettings" method="post">
        <h1>Settings</h1>
        <label for="selectQuizTopic">Choose a Topic for the Quiz:</label>
        <br><br>
        <select id="selectQuizTopic">
            <option id="optionAny" value="any">Any Topic</option>                
        </select>
        <br><br>
        <label for="selectQuizDifficulty">Choose Difficulty for the Quiz:</label>
        <br><br>
        <select id="selectQuizDifficulty">
            <option id="any" value="any">Any</option>
            <option id="easy" value="easy">Easy</option>
            <option id="medium" value="medium">Medium</option>
            <option id="hard" value="hard">Hard</option>
        </select>
        <br><br>
        <label for="inputQuizLength">Choose how many Questions should appear:</label>
        <br><br>
        <input type="number" id="inputQuizLength" placeholder="1-50" min="1" max="50">
        <br><br>
        <button type="submit" id="buttonStartQuiz">Begin Quiz</button>
    </form>
</div>

<div id="loadingQuizMessage">Loading quiz...</div>

<div id="divResults">
    <h1 id="h1Results">Results</h1>
    <h2 id="h2ResultsPoints">Total Points</h2>
    <button type="button" id="buttonBackToSettings">Back to Settings</button>
</div>

<div id="divQuestion">
    <h1 id="h1Points"></h1>
    <h2 id="h2Topic"></h2>
    <h3 id="h3Question"></h3>
    <form method="post" id="answerQuiz"></form>
    <div id="divFeedback">
        <p id="pFeedback"></p>
        <button type="button" id="buttonNextQuestion">Next Question</button>
    </div>
</div>
 <script src="../Front-End/Script_gif.js"></script>
'
?>

