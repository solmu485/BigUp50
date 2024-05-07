//@author walers jean
// Fetch data from the PHP script
fetch('../Back-End/fetch_modeAndMap.php') // Replace 'path_to_your_php_script.php' with the actual path to your PHP
script
    .then(response => response.json())
    .then(data => {
        // Group maps by game mode
        const groupedData = {};
        data.forEach(map => {
            if (!groupedData[map.game_mode_name]) {
                groupedData[map.game_mode_name] = [];
            }
            groupedData[map.game_mode_name].push(map);
        });

        // Create HTML for each game mode and its associated maps
        const gameModesContainer = document.getElementById('game-modes');
        for (const [gameMode, maps] of Object.entries(groupedData)) {
            const gameModeDiv = document.createElement('div');
            gameModeDiv.classList.add('game-mode');
            gameModeDiv.textContent = gameMode;
            gameModesContainer.appendChild(gameModeDiv);

            const mapsContainer = document.createElement('div');
            mapsContainer.classList.add('maps-container');
            maps.forEach(map => {
                const mapDiv = document.createElement('div');
                mapDiv.classList.add('map');
                const image = document.createElement('img');
                image.src = map.map_image_url;
                image.alt = map.map_name;
                const name = document.createElement('p');
                name.textContent = map.map_name;
                mapDiv.appendChild(image);
                mapDiv.appendChild(name);
                mapsContainer.appendChild(mapDiv);
            });
            gameModesContainer.appendChild(mapsContainer);
        }
    })
    .catch(error => console.error('Error:', error));