<?php

    //@author Tom Hermes

    if(isset($_GET['randomBrawler']))
    {
        $randomBrawlerID = mt_rand(1, 78);

        include_once "db_credentials.php";
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME);
        if (mysqli_connect_errno()){
            die('Connect Error'.mysqli_connect_errno(). ')' .mysqli_connect_error());
        }
        $query = "SELECT BrawlerID, BrawlerName, Category, Rarity, HP FROM tblBrawler WHERE BrawlerID = $randomBrawlerID";
        $result = mysqli_query($dbc, $query);

        // Überprüfe, ob Daten vorhanden sind
        if (mysqli_num_rows($result) > 0) {
            // Durchlaufe die Daten und gib sie aus
            while ($row = mysqli_fetch_assoc($result)) {
                $data = array(
                    'brawlerID' => $row['BrawlerID'],
                    'name' => $row['BrawlerName'],
                    'category' => $row['Category'],
                    'rarity' => $row['Rarity'],
                    'hp' => $row['HP']
                );
                echo json_encode($data);
            }
        } 
        else {
            $error = array(
                'message' => "Error: No data received"
            );
            echo json_encode($error);
            // Fehlerbehandlung, falls der Query fehlschlägt
            die('Connect error(' .mysqli_errno($dbc).')' . mysqli_error($dbc));
        }
        mysqli_free_result($result);
        mysqli_close($dbc);
    }

    if(isset($_GET['guessBrawler']))
    {
        $inputBrawler = $_GET['query'];
        include_once "db_credentials.php";
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME);
        if (mysqli_connect_errno()){
            die('Connect Error'.mysqli_connect_errno(). ')' .mysqli_connect_error());
        }    
        // SQL-Abfrage vorbereiten
        $stmt = $dbc->prepare("SELECT * FROM tblBrawler WHERE BrawlerName = ?");
        $stmt->bind_param("s", $inputBrawler);
        $stmt->execute();
        $result = $stmt->get_result();
        // Überprüfe, ob ein Ergebnis vorhanden ist
        if ($result->num_rows > 0) {
            // Eingabe vorhanden
            while ($row = mysqli_fetch_assoc($result)) {
                $data = array(
                    'brawlerID' => $row['BrawlerID'],
                    'name' => $row['BrawlerName'],
                    'category' => $row['Category'],
                    'rarity' => $row['Rarity'],
                    'hp' => $row['HP']
                );
                echo json_encode($data);
            }
        } else {
            // Eingabe nicht vorhanden
            $data="Brawler nicht gefunden";
            echo json_encode($data);
        }

        mysqli_free_result($result);
        mysqli_close($dbc);
    }
?>
