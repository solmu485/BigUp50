<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="../Styles/Stylemusa.css" media="screen" />
<?php
echo "<nav>";
$menu = [
        "home" => "home",
    "Gacha" => "Gachahome",
    "Characters" => "Characters",
    "quiz" => "quiz",
    "guesTheBrawler" => "guesTheBrawler"
];
echo "<ul>";
foreach ($menu as $key => $url) {
    echo "<li><a href='index.php?page={$url}'" . ($menu == $url ? "class=active" : "") . "> " . $key . " </a></li>";
}


echo "</ul>";
echo "</nav>";
?>