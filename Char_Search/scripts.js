$(document).ready(function() {
    // Function to fetch characters based on search term
    $("#character").on("input", function() {
        var searchTerm = $(this).val().trim();
        if (searchTerm !== '') {
            $.ajax({
                url: "backend.php",
                type: "GET",
                data: { search: searchTerm },
                dataType: "json",
                success: function(response) {
                    populateCharacterList(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error searching for characters:", error);
                }
            });
        }
    });

    // Function to populate character list
    function populateCharacterList(characters) {
        var select = $("#characterList");
        select.empty().append('<option value="">-- Select a Character --</option>');
        $.each(characters, function(index, character) {
            select.append('<option value="' + character.id + '">' + character.name + '</option>');
        });
    }
// Function to fetch character details when selected from the list
    $("#characterList").change(function() {
        var characterId = $(this).val();
        if (characterId !== '') {
            $.ajax({
                url: "backend.php",
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
    // Function to display character details
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
                        // If the string ends with .png, treat it as an image link
                        detailsHtml += "<img src='" + value + "' alt='Character Image' class='character-image'>";
                    } else {
                        // Otherwise, display the string in a paragraph
                        detailsHtml += "<p class='character-detail-title'>" + key + ": </p><p class='character-detail-value'>" + value + "</p>";
                    }
                } else if (typeof value === "object" && value !== null) {
                    // Handle nested object values
                    detailsHtml += "<p class='character-detail-title'>" + key + ": </p>";
                    detailsHtml += displayNestedObject(value);
                }
            }
        });
        $("#characterDetails").html(detailsHtml);
    }

// Function to recursively display nested object details
    function displayCharacterDetails(character) {
        var detailsHtml = "<h2>" + character.name + "</h2>";
        $.each(character, function(key, value) {
            if (key !== "id" && key !== "name") {
                if (typeof value === "object" && value !== null) {
                    detailsHtml += "<p class='character-detail-title'>" + key + ":</p>";
                    detailsHtml += displayNestedObject(value);
                } else if (typeof value === "string") {
                    if (value.endsWith(".png")) {
                        // If the string ends with .png, treat it as an image link
                        detailsHtml += "<img src='" + value + "' alt='Character Image' class='character-image'>";
                    } else {
                        // Otherwise, display the string in a paragraph
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
                    // If the string ends with .png, treat it as an image link
                    nestedHtml += "<li><img src='" + subValue + "' alt='Character Image' class='character-image'></li>";
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
});