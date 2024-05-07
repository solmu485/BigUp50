<!DOCTYPE html>
<html>
<head>
    <title>Random Prize Picker</title>
    <link rel="stylesheet" type="text/css" href="../css/Stylemusa.css" media="screen" />
    <?php
    include_once "navigation.php";
    ?>
    <script>

        function pickRandomPrize() {
            // Hide the image
            document.getElementById("boxImage").style.display = "none";

            // Send an AJAX request to the PHP script
            var request = new XMLHttpRequest();
            request.open("GET", "../../Back-End/includes/Gacha.php", true);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    // Update the content of the result div with the response
                    document.getElementById("result").innerHTML = request.responseText;
                }
            };
            request.send();
        }
    </script>
</head>
<body>
<h1>Random Prize Picker</h1>
<button onclick="pickRandomPrize()" id="click">Pick Random Prize</button>
<div id="result"></div><br>
<img id="boxImage" src="../images/BOX.jpg" sizes="50%" />
</body>
</html>
