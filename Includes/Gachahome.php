<!DOCTYPE html>
<html>
<head>


    <title>Random Prize Picker</title>
    <link rel="stylesheet" type="text/css" href="Styles/Stylemusa.css" media="screen" />
    <?php
    session_start();
    include_once "Back-End/functiongacha.php";
    ?>
    <script src="Front-End/front_end_ranking.js"></script>
</head>
<body>
<h1>Random Prize Picker</h1>
<button onclick="pickRandomPrize()" id="click">Pick Random Prize</button>
<div id="result"></div><br>
<img id="boxImage" src="images/BOX.jpg" sizes="50%" />
</body>
</html>
