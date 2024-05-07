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
