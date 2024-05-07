<?php

    //@author Tom Hermes

    if(isset($_GET['category'])){
        //DB_Credentials
        include_once "db_credentials.php";
        // Verbindung zur Datenbank herstellen
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME);
        // Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
        if (!$dbc) {
            $error = array(
                'message' => "Error: Unable to connect to the database"
            );
            echo json_encode($error);
            die();
        }

        // Abfrage vorbereiten
        $query = "SELECT DISTINCT Category FROM tblBrawler";
        // Abfrage ausführen
        $result = mysqli_query($dbc, $query);

        // Überprüfen, ob die Abfrage erfolgreich war
        if ($result) {
            // Ergebnis in ein Array konvertieren
            $categories = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row['Category'];
            }
            // Ergebnis als JSON ausgeben
            echo json_encode($categories);
        } else {
            // Fehlermeldung ausgeben, wenn die Abfrage fehlgeschlagen ist
            $error = array(
                'message' => "Error: Unable to fetch data from the database"
            );
            echo json_encode($error);
        }

        // Ergebnisspeicher freigeben und Verbindung schließen
        mysqli_free_result($result);
        mysqli_close($dbc);
    }

    /*function getBrawlers(){
        if (!isset($_GET['query'])) {
            $error = array(
                'message' => "Error: No input category provided"
            );
            echo json_encode($error);
            die();
        }
        
        $inputCategory = $_GET['query'];
        
        // DB_Credentials
        include_once "../DB_Connection/db_credentials.php";
        
        // Verbindung zur Datenbank herstellen
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_NAME);
        
        // Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
        if (!$dbc) {
            $error = array(
                'message' => "Error: Unable to connect to the database"
            );
            echo json_encode($error);
            die();
        }
        
        // Abfrage vorbereiten (verwenden Sie Prepared Statements)
        $query = "SELECT BrawlerName FROM tblBrawler WHERE Category = ?";
        $stmt = mysqli_prepare($dbc, $query);
        
        // Überprüfen, ob das Prepared Statement erfolgreich vorbereitet wurde
        if (!$stmt) {
            $error = array(
                'message' => "Error: Unable to prepare SQL statement"
            );
            echo json_encode($error);
            die();
        }
        
        // Parameter binden
        mysqli_stmt_bind_param($stmt, "s", $inputCategory);
        
        // Abfrage ausführen
        $result = mysqli_stmt_execute($stmt);
        
        // Überprüfen, ob die Abfrage erfolgreich war
        if ($result) {
            // Ergebnis in ein Array konvertieren
            $brawlerName = array();
            mysqli_stmt_bind_result($stmt, $bName);
            while (mysqli_stmt_fetch($stmt)) {
                $brawlerName[] = $bName;
            }
            // Ergebnis als JSON ausgeben
            echo json_encode($brawlerName);
        } else {
            // Fehlermeldung ausgeben, wenn die Abfrage fehlgeschlagen ist
            $error = array(
                'message' => "Error: Unable to fetch data from the database"
            );
            echo json_encode($error);
        }
        
        // Aussage schließen und Verbindung schließen
        mysqli_stmt_close($stmt);
        mysqli_close($dbc);
    }*/
?>