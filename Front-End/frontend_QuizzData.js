/**
    @author Tom Hermes
*/
$(document).ready(function(){
    $("#button_start").click(function(){
        $("#solution").empty();
        $("#popup").empty();
        $("#message_true_brawler").html("");
        $("#message_true_brawler").empty();

        $.ajax({
            url: "Back-End/backend_quizz.php",
            data: {randomBrawler: true}, 
            dataType: "json",
            success: function(result){
                console.log(result);
                sessionStorage.setItem('characterInfo', JSON.stringify(result));
            }
        });
        //document.getElementById("button_start").style.visibility ="hidden";
        document.getElementById("button_start").innerHTML="Reroll";
    });



    $("#button_check").click(function(){
        let inputBrawler = $("#guess_input").val();
        let character = JSON.parse(sessionStorage.getItem('characterInfo'));
        //Wenn Brawler richtig gewählt ist
        if(inputBrawler.toLowerCase() === character.name.toLowerCase()){
            //console.log(character);
            //Parameter mit gespeicherten Informationen zu Brawler werden an Funktion Table geschickt
            addToTable(character.name, character.category, character.rarity, character.hp, character);
            $("#message_true_brawler").html("<br><h1>"+"Brawler richtig geraten"+"</h1>");
        }
        //Wenn Brawler falsch ist, dann Informationen von gewählten Brawler zeigen
        else{
            $.ajax({
                url: "Back-End/backend_quizz.php",
                data: {guessBrawler: true, query: inputBrawler}, 
                dataType: "json",
                success: function(result){
                    //console.log(result);
                    //Parameter mit gespeicherten Informationen zu Brawler werden an Funktion Table geschickt
                    addToTable(result.name, result.category, result.rarity, JSON.stringify(result.hp), character);
                }
            });
        }
    });

    //Erstellen des Tables das später angezeigt wird
    function addToTable(name, category, rarity, hp, character) {
        //console.log(name, category, rarity, hp, character);
        let newRow = document.createElement('tr');

        // Neue Zellen für die Zeile erstellen und mit Werten füllen
        let nameCell = document.createElement('td');
        nameCell.textContent = name;
        // Überprüfen, ob die Rarity mit der des gespeicherten Brawlers übereinstimmt
        if (name.toLowerCase() === character.name.toLowerCase()) {
            nameCell.classList.add('green-background'); // Klasse für grünen Background hinzufügen
        }else{
            nameCell.classList.add('red-background'); // Klasse für roten Background hinzufügen
        }
        newRow.appendChild(nameCell);

        let categoryCell = document.createElement('td');
        categoryCell.textContent = category;
        // Überprüfen, ob die Rarity mit der des gespeicherten Brawlers übereinstimmt
        if (category.toLowerCase() === character.category.toLowerCase()) {
            categoryCell.classList.add('green-background'); // Klasse für grünen Background hinzufügen
        }else{
            categoryCell.classList.add('red-background'); // Klasse für roten Background hinzufügen
        }
        newRow.appendChild(categoryCell);

        let rarityCell = document.createElement('td');
        rarityCell.textContent = rarity;

        // Überprüfen, ob die Rarity mit der des gespeicherten Brawlers übereinstimmt
        if (rarity.toLowerCase() === character.rarity.toLowerCase()) {
            rarityCell.classList.add('green-background'); // Klasse für grünen Background hinzufügen
        }else{
            rarityCell.classList.add('red-background'); // Klasse für roten Background hinzufügen
        }
        newRow.appendChild(rarityCell);

        //Erstellen ind initialisieren von <td>
        let hpCell = document.createElement('td');
        let arrowCell = document.createElement('td');

        // Textinhalt für die HP-Zelle festlegen
        hpCell.textContent = hp;

        // Erstellen des Pfeil-<span>-Elements und Zuweisen der Klassen
        let arrowSpan = document.createElement('span');
        arrowSpan.className = 'arrow';

        // Zuerst die Klassen entfernen, die den Pfeil darstellen
        arrowSpan.classList.remove('formkit--arrowup');
        arrowSpan.classList.remove('formkit--arrowdown');

        // Überprüfen, ob die HP mit der des gespeicherten Brawlers übereinstimmt
        if (hp === character.hp) {
            hpCell.classList.add('green-background'); // Klasse für grünen Hintergrund hinzufügen
            arrowSpan.classList.add('green-background');
        } else if (parseInt(hp) < character.hp) {
            hpCell.classList.add('red-background'); // Klasse für roten Hintergrund hinzufügen
            arrowSpan.classList.add('formkit--arrowup'); // Klasse für den Pfeil nach oben hinzufügen
        } else{
            hpCell.classList.add('red-background'); // Klasse für roten Hintergrund hinzufügen
            arrowSpan.classList.add('formkit--arrowdown'); // Klasse für den Pfeil nach unten hinzufügen
        }
        // Pfeil-<span>-Element zur Pfeil-Zelle hinzufügen
        arrowCell.appendChild(arrowSpan);

        // HP-Zelle und Pfeil-Zelle der Zeile hinzufügen
        newRow.appendChild(hpCell);
        newRow.appendChild(arrowCell);

        // Tabelle mit der ID "solution" aus dem DOM abrufen und die neue Zeile hinzufügen
        let table = document.getElementById('solution');
        table.appendChild(newRow);
        
    }
});

