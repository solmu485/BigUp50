
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Stefanetti Franjo">
    <link rel="stylesheet" type="text/css" href="../Back-End/styles/stylesheet.css" media="screen" />
    

    
    <title>Brwal Talk</title>

</head>
<body>
<main>
    <div class="wrapper">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <?php
        //includes um db credentials und Navigation fuer jede Seite 
       // include_once "includes/db_credentials.php";
        include_once "includes/navigation.php";



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
        </div>
</main>
</body>
</html>

