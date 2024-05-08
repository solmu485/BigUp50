<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="Musa und franjo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yoda Translation Example</title>
</head>
<body>
<div id="lelek">
    <h1>Welcome to the Brawl Talk Homepage</h1>
    <?php
    include_once "navigation.php";
    ?>
    <?php
    // Originaltext
    $originalContent = "\"Brawl Stars\" is a fast-paced multiplayer online battle game developed by Supercell. Set in a vibrant and colorful universe, players control a diverse cast of characters known as \"Brawlers,\" each with their own unique abilities and playstyles.

        The game features various game modes, including Gem Grab, Bounty, Heist, Brawl Ball, Siege, and Showdown, each offering a different objective and gameplay experience. In Gem Grab, teams compete to collect and hold onto gems while fending off opponents. In Bounty, players aim to eliminate opponents to earn stars, with the team with the most stars at the end of the match emerging victorious. Heist requires teams to either attack or defend a safe containing treasures, adding a strategic element of offense and defense.

        Brawl Ball is a soccer-inspired mode where teams compete to score goals while battling opponents. Siege involves collecting bolts to summon a robot that marches towards the enemy base, providing an additional layer of strategy. Showdown is a battle royale mode where players fight to be the last one standing on a shrinking map, with power-ups scattered throughout to aid their survival.

        Players can unlock new Brawlers, upgrade their abilities, and customize their appearance with different skins. The game also features regular updates with new Brawlers, maps, and events to keep the gameplay fresh and exciting.

        With its fast-paced action, strategic depth, and engaging gameplay modes, \"Brawl Stars\" offers endless fun for both casual players and competitive gamers alike. Whether you prefer team-based cooperation or intense solo showdowns, there's something for everyone in this adrenaline-fueled mobile sensation.";
    ?>
    <p id="content"><?php echo $originalContent; ?></p>

    <!-- Button zum Übersetzen der Seite -->
    <button id="translateBtn">Yoda Translate</button>
    <!-- Button zum Rückgängigmachen der Übersetzung -->
    <button id="undoTranslateBtn" style="display:none;">Originalsprache wiederherstellen</button>

    <h2>Available Events:</h2>
    <table id="eventsTable">
        <thead>
        <tr>
            <th>Event Name</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Verbindung zur Datenbank herstellen
        $dbc = mysqli_connect("localhost", "username", "password", "database");
        mysqli_set_charset($dbc, 'utf8');

        // SQL-Abfrage zum Abrufen der Eventnamen
        $query = "SELECT dtEventName FROM tblEvent";
        $result = mysqli_query($dbc, $query);

        // Eventnamen in die Tabelle einfügen
        $eventNames = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $eventNames[] = $row['dtEventName'];
        }

        // Nur 5 Events anzeigen
        $startIndex = 0;
        $endIndex = min($startIndex + 5, count($eventNames));
        for ($i = $startIndex; $i < $endIndex; $i++) {
            echo "<tr><td>" . $eventNames[$i] . "</td></tr>";
        }

        // Verbindung zur Datenbank schließen
        mysqli_close($dbc);
        ?>
        </tbody>
    </table>

    <div class="imagehome"><img src="../images/homepic.jpg"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var tableBody = document.querySelector("#eventsTable tbody");
            var eventNames = <?php echo json_encode($eventNames); ?>;
            var content = document.getElementById('content');
            var originalContent = content.innerText;

            // Funktion zum Anzeigen der Events
            function showEvents(startIndex) {
                // Tabelle leeren
                tableBody.innerHTML = "";

                // Nur 5 Events anzeigen
                var endIndex = Math.min(startIndex + 5, eventNames.length);
                for (var i = startIndex; i < endIndex; i++) {
                    var row = "<tr><td>" + eventNames[i] + "</td></tr>";
                    tableBody.innerHTML += row;
                }

                // Nächste Events in 5 Sekunden anzeigen
                setTimeout(function () {
                    if (endIndex < eventNames.length) {
                        showEvents(endIndex);
                    }
                }, 5000);
            }

            // Starten der Anzeige der Events
            showEvents(0);

            // Eventlistener für den Übersetzen-Button
            document.getElementById('translateBtn').addEventListener('click', function () {
                fetch('https://api.funtranslations.com/translate/yoda.json?text=' + encodeURIComponent(originalContent))
                    .then(response => response.json())
                    .then(data => {
                        // Übersetzten Text direkt ersetzen
                        content.innerText = data.contents.translated;
                        // Übersetzen-Button ausblenden, Rückgängigmachen-Button einblenden
                        document.getElementById('translateBtn').style.display = 'none';
                        document.getElementById('undoTranslateBtn').style.display = 'inline-block';
                    })
                    .catch(error => console.error('Fehler bei der Übersetzung:', error));
            });

            // Eventlistener für den Rückgängigmachen-Button
            document.getElementById('undoTranslateBtn').addEventListener('click', function () {
                // Originalen Textinhalt wiederherstellen
                content.innerText = originalContent;
                // Rückgängigmachen-Button ausblenden, Übersetzen-Button einblenden
                document.getElementById('translateBtn').style.display = 'inline-block';
                document.getElementById('undoTranslateBtn').style.display = 'none';
            });
        });
    </script>
    <script src="../Front-End/front_end_ranking.js"></script>
</div>
</body>
</html>
