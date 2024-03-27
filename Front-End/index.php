
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Stefanetti Franjo">
    
    <title>Brwal Talk</title>

</head>
<body>
<main>

        <?php
        //includes um db credentials und Navigation fuer jede Seite 
       // include_once "includes/db_credentials.php";
       // include_once "includes/navigator.php";



        $page = "";

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }


        //if um Navigation Dynamisch zu erstellen
        if ($page == "home") {
            include_once "includes/home.php";
        }  else {
            include_once "includes/home.php";
        }

        //einfuegen des Footer fuer jede Seite
        include_once "includes/footer.php";

        ?>
</main>
</body>
</html>

