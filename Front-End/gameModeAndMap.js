$(document).ready(function() {
    // Fetch data from the PHP script using AJAX
    $.ajax({
        url: 'Back-End/fetch_gameModeAndMap.php',
        dataType: 'json',
        success: function(data) {
            // Group maps by game mode
            const groupedData = {};
            data.forEach(map => {
                if (!groupedData[map.game_mode_name]) {
                    groupedData[map.game_mode_name] = { maps: [], gameModeImage: map.game_mode_image_url };
                }
                groupedData[map.game_mode_name].maps.push(map);
            });

            // Create HTML for each game mode and its associated maps
            const gameModesContainer = $('#game-modes');
            $.each(groupedData, function(gameMode, { maps, gameModeImage }) {
                const gameModeDiv = $('<div>').addClass('game-mode');
                const gameModeImageElement = $('<img>').attr('src', gameModeImage).attr('alt', gameMode).addClass('game-mode-image');
                const mapsContainer = $('<div>').addClass('maps-container');

                // Append game mode image and name to the game mode div
                gameModeDiv.append(gameModeImageElement);
                gameModeDiv.append($('<p>').addClass('image-name').text(gameMode));

                // Append maps to the maps container
                maps.forEach(map => {
                    const mapDiv = $('<div>').addClass('map');
                    const image = $('<img>').attr('src', map.map_image_url).attr('alt', map.map_name);
                    const name = $('<p>').addClass('image-name').text(map.map_name);

                    mapDiv.append(image, name);
                    mapsContainer.append(mapDiv);
                });

                // Append game mode div and maps container to the game modes container
                gameModesContainer.append(gameModeDiv).append(mapsContainer); // Append them together
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
});
