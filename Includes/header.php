<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="../Styles/Stylemusa.css" media="screen" />
<?php
//@author Musa Solak
echo "<nav>";
$menu = [
        "home" => "home",
    "Gacha" => "Gachahome",
    "Characters" => "Characters",
    "quiz" => "quiz",
    "guesTheBrawler" => "guesTheBrawler",
    "category_rarity_brawler"=> "category_rarity_brawler",
    "gameMode" => "gameMode",
    "gif" => "gif",
    "maps" => "maps",
    "ranking" => "ranking"

];
echo "<ul>";
foreach ($menu as $key => $url) {
    echo "<li><a href='index.php?page={$url}'" . ($menu == $url ? "class=active" : "") . "> " . $key . " </a></li>";
}


echo "</ul>";
echo "</nav>";
?>