/**
    @author Tom Hermes
*/
$(document).ready(function(){

    $.ajax({
        url: "Back-End/backend_CategoryBrawler.php",
        data: {category: true}, 
        dataType: "json",
        success: function(result){
            for (let i = 0; i < result.length; i++){
            //Websitepfad des Bildes der Map mit .splash und displayName den Namen der Map
            $("#category-selector").append("<option value='" + result[i] + "'>" + result[i] + "</option>");
            }
        }
    });
    $.ajax({
        url: "Back-End/backend_RarityBrawler.php",
        data: {rarity: true}, 
        dataType: "json",
        success: function(result){
            for (let i = 0; i < result.length; i++){
            //Websitepfad des Bildes der Map mit .splash und displayName den Namen der Map
            $("#rarity-selector").append("<option value='" + result[i] + "'>" + result[i] + "</option>");
            }
        }
    });

    /*$("#category-selector").change(function(){
        $("#category-container").empty();
        let category = $("#category-selector").val(); 
        
        $.ajax({
            url: 'https://api.brawlapi.com/v1/brawlers',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data && data.list) {
                    var imageUrls = [];
                    data.list.forEach(function(brawler) {
                        if (brawler.class && brawler.class.name === category && brawler.imageUrl) {
                            imageUrls.push(brawler.imageUrl);
                        }
                    });
                    if (imageUrls.length > 0) {
                        alert("Image URLs für die Kategorie " + category + ":\n" + imageUrls.join("\n"));
                    } else {
                        alert("Keine Brawler mit der Klasse " + category + " gefunden.");
                    }
                } else {
                    alert("Fehler: Ungültige Daten von der API erhalten.");
                }
            }
        });
    });

    $("#rarity-selector").change(function(){
        $("#rarity-container").empty();
        let rarity = $("#rarity-selector").val(); 
        
        $.ajax({
            url: 'https://api.brawlapi.com/v1/brawlers',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data && data.list) {
                    var imageUrls = [];
                    data.list.forEach(function(brawler) {
                        if (brawler.rarity && brawler.rarity.name === rarity && brawler.imageUrl) {
                            imageUrls.push(brawler.imageUrl);
                        }
                    });
                    if (imageUrls.length > 0) {
                        alert("Image URLs für die Seltenheit " + rarity + ":\n" + imageUrls.join("\n"));
                    } else {
                        alert("Keine Brawler mit der Klasse " + rarity + " gefunden.");
                    }
                } else {
                    alert("Fehler: Ungültige Daten von der API erhalten.");
                }
            }
        });
    });*/

    // Funktion zum Anzeigen von Bilder und Namen des Bildes
    /*function displayImages(imageUrls) {
        // Ziel-Div-Element, in das die Bilder eingefügt werden sollen
        var container = document.getElementById('image-container');
        
        // Durchlaufe jedes Bild in der Liste und füge es dem Container hinzu
        imageUrls.forEach(function(imageUrls) {
            
            // Erstelle ein neues Bild-Element
            var img = document.createElement('img');
            // Bildpfad zum Unterordner "images" hinzufügen
            var imageUrl = 'Front-End/images/' + imageUrls + '_portrait.png';

            // Setze die Quelle des Bildes auf die URL
            img.src = imageUrl;
            img.style.width = '100px';
            img.style.height = '75px';
            // Erstelle ein neues <div> Element für das Bild und den Text
            var containerDiv = document.createElement('div');
            containerDiv.style.display = 'inline-block'; // Stelle sicher, dass die Container nebeneinander angezeigt werden

            // Füge das Bild dem Container hinzu
            containerDiv.appendChild(img);

            // Erstelle ein neues <div> Element für das Wort des Bildes
            var wordContainer = document.createElement('div');

            // Setze den Textinhalt des <div> Elements auf den Namen des Bildes
            wordContainer.textContent = imageUrls;

            // Füge das Wort-Container dem Bild-Container hinzu
            containerDiv.appendChild(wordContainer);

            // Füge das Bild-Container dem Hauptcontainer hinzu
            container.appendChild(containerDiv);
        });
    }*/
    $('#category-selector, #rarity-selector').change(function() {
        //Leeren des DIVs und Holen der Werte aus Selects
        $("#image-container").empty();
        let selectedCategory = $('#category-selector').val();
        let selectedRarity = $('#rarity-selector').val();
        
        //Select Category ausgewählt && Select Rarity nicht ausgewählt 
        if (selectedCategory !== '' && selectedRarity === '') {
            //Übermitteln der Category an Funktion getBrawlerImageUrls
            getBrawlerImageUrls(selectedCategory, '');
        } 
        //Select Category nicht ausgewählt && Select Rarity ausgewählt 
        else if (selectedCategory === '' && selectedRarity !== '') {
            //Übermitteln der Rarity an Funktion getBrawlerImageUrls
            getBrawlerImageUrls('', selectedRarity);
        } 
        //beide Selects augewählt
        else if (selectedCategory !== '' && selectedRarity !== '') {
            //Übermitteln beider Selects Values
            getBrawlerImageUrls(selectedCategory, selectedRarity);
        } 
        else {
            // Kein Select ausgewählt
            alert("Bitte wähle eine Klasse oder Seltenheit aus.");
        }
    });
    //Funktion die ImageURLs aus der API zeiht mithilfe der Values aus Select Category und Select Rarity
    function getBrawlerImageUrls(selectedCategory, selectedRarity) {
        $.ajax({
            url: 'https://api.brawlapi.com/v1/brawlers',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Erfolgreich:', data);
                //Überprüft ob data und list array im data objekt existiert
                if (data && data.list) {
                    //Erstellen eines leeren Arrays für die Image URLs
                    let brawlersData = [];
                    //Geht mit einer Schleife durch alle Brawler in der Liste durch
                    data.list.forEach(function(brawler) {
                        //Überprüft ob keine Kategorie ausgewählt wurde oder der Name der Brawler-Klasse mit der ausgewählten Kategorie übereinstimmt.
                        if ((!selectedCategory || brawler.class.name === selectedCategory) &&
                            //Überprüft, ob keine Seltenheit ausgewählt wurde oder der Name der Seltenheit des Brawlers mit der ausgewählten Seltenheit übereinstimmt.
                            (!selectedRarity || brawler.rarity.name === selectedRarity) &&
                            //Überprüft, ob die Bild-URL des Brawlers vorhanden ist.
                            brawler.imageUrl) 
                        {
                            //Pushen der Bild URL des Brawlers, wenn alle Bedingungen erfüllt sind
                            brawlersData.push({
                                imageUrl: brawler.imageUrl,
                                name: brawler.name
                            });
                        }
                    });
    
                    //Übermitteln der ImageURLs der Brawler aus den Select(s)
                    showImagesAndNames(brawlersData);
                } 
                else {
                    alert("Fehler: Ungültige Daten von der API erhalten.");
                }
            },
            error: function(xhr, status, error) {
                console.error('Fehler beim Abrufen der Daten von der API:', error);
                alert("Fehler beim Abrufen der Daten von der API.");
            }
        });
    }
    //Funktion zum Anzeigen der Bilder mithilfe der ImageURLS aus Funktion getBrawlerImageURLs
    function showImagesAndNames(brawlersData) {
        //Image Container
        var $imageContainer = $('#image-container');
        // Lösche alle vorhandenen Bilder im Container
        $imageContainer.empty();
    
        // Füge jedes Bild dem Bildcontainer hinzu
        /*imageUrls.forEach(function(imageUrl) {
            var $img = $('<img>').attr('src', imageUrl);
            $imageContainer.append($img);
        });*/

        // Füge jedes Bild und den Namen dem Bildcontainer hinzu
        /*brawlersData.forEach(function(brawlerData) {
        var $img = $('<img>').attr('src', brawlerData.imageUrl);
        var $name = $('<p>').text(brawlerData.name);
        var $wrapper = $('<div>').addClass('brawler-wrapper').append($img, $name);
        $imageContainer.append($wrapper);
        });*/

        // Füge jedes Bild und den Namen dem Bildcontainer hinzu
        brawlersData.forEach(function(brawlerData) {
            var $wrapper = $('<div>').addClass('brawler-wrapper');
            var $img = $('<img>').attr('src', brawlerData.imageUrl);
            var $name = $('<p>').text(brawlerData.name);
        
            // Füge das Bild und den Namen nur hinzu, wenn sie vorhanden sind
            if (brawlerData.imageUrl && brawlerData.name) {
                $wrapper.append($img, $name);
                $imageContainer.append($wrapper);
            }
        });

        // Wenn kein Brawler den Bedingungen entspricht, füge ein Standardbild und einen Text hinzu
        if (brawlersData.length === 0) {
            var $defaultImg = $('<img>').attr('src', '../images/Not_working.jpg'); // Standardbild-URL
            var $noBrawlersText = $('<h1>').text('Keine Brawler stimmen mit den Bedingungen überein.');

            var $defaultWrapper = $('<div>').addClass('brawler-wrapper');
            $defaultWrapper.append($defaultImg, $noBrawlersText);
            $imageContainer.append($defaultWrapper);
        }
    }
    

});