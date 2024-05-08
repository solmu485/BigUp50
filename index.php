<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/Stylemusa.css">
</head>

<body>
<header>
    <?php
    include_once "Includes/header.php"; // Displaying the header
    ?>
</header>

<?php

$page="";

if(isset($_GET['page'])) {  //auflisten der php Seiten
    $page = $_GET['page'];
    if ($page == "home") {  // einen If um die verschiene Seiten zufinden

        include_once "Includes/home.php";

    }elseif ($page == "Gachahome"){
        include_once "Includes/Gachahome.php";
    }elseif ($page == "Characters"){
        include_once "Includes/Characters.php";
    }elseif ($page == "quiz"){
        include_once "Includes/quiz.php";
    }elseif ($page == "guesTheBrawler"){
        include_once "Includes/guessTheBrawler.php";
    }
    else {
        include_once "Includes/home.php";
    }
}
?>
<footer>
    <hr>
    &copy; Musa Can Serdar Solak
</footer>
</body>
</html>
