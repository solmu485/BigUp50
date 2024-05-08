<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="musa und franjo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brawler Table</title>
    <link rel="stylesheet" type="text/css" href="../BigUp50-main/Front-End/css/Stylemusa.css" media="screen" />
    <style>
        body {
            color: white; /* Set text color to white */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #fd0404;
            color: white; /* Set text color to white */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #071062;
        }

        tr:nth-child(even) {
            background-color: #000562;
        }
    </style>
    <?php

    // Include the function file
    include_once "Back-End/searchfunction.php";

    // Check if form is submitted
    if (isset($_POST['brawler_name'])) {
        // Call the function to search for brawlers
        searchBrawlers($_POST['brawler_name']);
    }
    ?>
</head>
<body>
<div id="search">
    <form action="" method="post">
        <label for="brawler_name">Search by Brawler Name:</label>
        <input type="text" id="brawler_name" name="brawler_name">
        <input type="submit" value="Search">
    </form>
</div>
</body>
</html>
