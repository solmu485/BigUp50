// Get all flag elements by class name
const flags = document.getElementsByClassName("flag");

const playerCountSelect = document.getElementById("playerCount");

// Function to fetch data from backend
const fetchData = (flagId, count) => {
    fetch(`backend.php?flag=${flagId}&count=${count}`)
        .then(response => response.text())
        .then(data => {
            countryInfo.innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
};

// Add onchange event listener to player count select
playerCountSelect.onchange = function() {
    // Clear countryInfo when player count select changes
    countryInfo.innerHTML = '';
};

// Loop through each flag element and add click event listener
for (let flag of flags) {
    flag.onclick = function() {
        const flagId = this.id;
        const count = playerCountSelect.value;
        fetchData(flagId, count);
    };
}
