// MELVIN

    // Wenn Input geändert wird Funktion ausführen für Character-Namen in Combo-box aufzufüllen
    $("#character").on("input", function() {
        var searchTerm = $(this).val().trim();
        if (searchTerm !== '') {
            $.ajax({
                url: "Back-End/backend_CharSearch.php",
                type: "GET",
                data: { search: searchTerm },
                dataType: "json",
                success: function(response) {
                    console.log((response));
                    populateCharacterList(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error searching for characters:", error);
                }
            });
        }
    });


    // Einfügen von Charaster in Combo-box
    function populateCharacterList(characters) {
        var select = $("#characterList");
        select.empty().append('<option value="">-- Select a Character --</option>');
        $.each(characters, function(index, character) {
            select.append('<option value="' + character.id + '">' + character.name + '</option>');
        });
    }
// Informationen zum Character holen gehen
    $("#characterList").change(function() {
        var characterId = $(this).val();
        if (characterId !== '') {
            $.ajax({
                url: "Back-End/backend_CharSearch.php",
                type: "GET",
                data: { id: characterId },
                dataType: "json",
                success: function(response) {
                    if (!response.error) {
                        displayCharacterDetails(response);
                    } else {
                        console.error(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error getting character details:", error);
                }
            });
        }
    });

        // Function to display character details
        function displayCharacterDetails(character) {
            var detailsHtml = "<h2>" + character.name + "</h2>";
            $.each(character, function(key, value) {
                if (key !== "id" && key !== "name") {
                    detailsHtml += "<p>" + key + ": " + value + "</p>";
                }
            });
            $("#characterDetails").html(detailsHtml);
        }
// SHOW Character Details
    // Character Information anzeigen
    function displayCharacterDetails(character) {
        var detailsHtml = "<h2>" + character.name + "</h2>";
        $.each(character, function(key, value) {
            if (key !== "id" && key !== "name") {
                if (Array.isArray(value)) {
                    // Handle array values
                    detailsHtml += "<p class='character-detail-title'>" + key + ": </p><p class='character-detail-value'>" + value.join(", ") + "</p>";
                } else if (typeof value === "string") {
                    // Handle string values
                    if (value.endsWith(".png")) {
                        // Wenn die datei mit .png afhört, dann als Bild weitefahren
                        detailsHtml += "<img src='" + value + "' alt='Character Image' class='character-image' style='height : 100px; width: 100px;'" + ">";
                    } else {
                        // Sonst Als String
                        detailsHtml += "<p class='character-detail-title'>" + key + ": </p><p class='character-detail-value'>" + value + "</p>";
                    }
                } else if (typeof value === "object" && value !== null) {
                    //
                    detailsHtml += "<p class='character-detail-title'>" + key + ": </p>";
                    detailsHtml += displayNestedObject(value);
                }
            }
        });
        $("#characterDetails").html(detailsHtml);
    }

// Eingenested Info rausholen
    function displayCharacterDetails(character) {
        var detailsHtml = "<h2>" + character.name + "</h2>";
        $.each(character, function(key, value) {
            if (key !== "id" && key !== "name") {
                if (typeof value === "object" && value !== null) {
                    detailsHtml += "<p class='character-detail-title'>" + key + ":</p>";
                    detailsHtml += displayNestedObject(value);
                } else if (typeof value === "string") {
                    if (value.endsWith(".png")) {
                        // Wenn die datei mit .png afhört, dann als Bild weitefahren
                        detailsHtml += "<img src='" + value + "' alt='Character Image' class='character-image' style='height : 100px; width: 100px;' >";
                    } else {
                        // Sonst als String
                        detailsHtml += "<p class='character-detail-title'>" + key + ":</p><p class='character-detail-value'>" + value + "</p>";
                    }
                }
            }
        });
        $("#characterDetails").html(detailsHtml);
    }
    function displayNestedObject(obj) {
        var nestedHtml = "<div class='character-nested-value'><ul>";
        $.each(obj, function(subKey, subValue) {
            if (typeof subValue === "object" && subValue !== null) {
                nestedHtml += "<li>" + subKey + ": ";
                nestedHtml += displayNestedObject(subValue);
                nestedHtml += "</li>";
            } else if (typeof subValue === "string") {
                if (subValue.endsWith(".png")) {
                    // Wenn die datei mit .png afhört, dann als Bild weitefahren
                    nestedHtml += "<li><img src='" + subValue + "' alt='Character Image' class='character-image' style='height : 100px; width: 100px;'></li>";
                } else {
                    nestedHtml += "<li>" + subKey + ": " + subValue + "</li>";
                }
            } else {
                nestedHtml += "<li>" + subKey + ": " + subValue + "</li>";
            }
        });
        nestedHtml += "</ul></div>";
        return nestedHtml;
    }
