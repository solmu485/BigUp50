<!-- @author Tom Hermes -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Front-End/jquery-3.6.2.js"></script>
    <link rel="stylesheet" href="../Styles/guessTheBrawler.css">

    <title>Guess the Brawler</title>
</head>
<body>
    <img src="../images/Brawl Stars_Image.jpg" alt="Guess the player" id="player-image">
        <!-- Different Buttons for the game-->
    <button type="button" id="button_start">Start</button>
    <br>
    <!-- Input Field for Brawler Guess -->
    <input type="text" id="guess_input" placeholder="Enter player's name">
    <button type="button" id="button_check">Check</button>
    <br>
    <br>
    <!-- Right Brawler-->
    <table>
        <thead>
            <th>Name</th>
            <th>Category</th>
            <th>Rarity</th>
            <th>HP</th>
            <th>HP Up/Down</th>
        </thead>
        <tbody id="solution"></tbody>
    </table>
    <div id="message_true_brawler"></div>
    
    <script src="../Front-End/frontend_QuizzData.js" defer></script>
</body>
</html>