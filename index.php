
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Styles/Stylemusa.css">
    <script src="js/jquery-3.7.1.js"></script>
    <title>Recycling Zenter</title>

</head>
<body>
<main>
    <div id="index-background">

        <?php



        $page = "";

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        $noUser = $_SESSION['noUser'];

        //if um Navigation Dynamisch zu erstellen
        if ($page == "home") {
            include_once "Includes/home.php";
        } else if ($page == "Gacha") {
            include_once "Includes/Gachahome.php";
        } else if ($page == "Char_Search") {
            include_once "Includes/Char_Search.php";
        }else if ($page == "ranking") {
            include_once "Includes/ranking.php";
        }else if ($page == "maps") {
            include_once "Includes/maps.php";}
        else if ($page == "gameMode") {
            include_once "Includes/gameMode.php";}
        else if ($page == "gameModeAndMaps") {
            include_once "Includes/gameModeAndMaps.php";}
        else if ($page == "guessTheBrawler") {
            include_once "Includes/guessTheBrawler.php";}
        else if ($page == "category_rarity_brawler") {
            include_once "Includes/category_rarity_brawler.php";}
        else {
            include_once "Includes/home.php";
        }


        include_once "includes/footer.php";


        ?>
    </div>
</main>
</body>
</html>