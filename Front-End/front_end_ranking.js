// Alle Flags bekommen
const flags = document.getElementsByClassName("flag");

const playerCountSelect = document.getElementById("playerCount");

// Zur backend ausfgreifen
const fetchData = (flagId, count) => {
    fetch(`backend.php?flag=${flagId}&count=${count}`)
        .then(response => response.text())
        .then(data => {
            countryInfo.innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
};

// Bei veränderung HTML leeren
playerCountSelect.onchange = function() {
    countryInfo.innerHTML = '';
};

for (let flag of flags) {
    flag.onclick = function() {
        const flagId = this.id;
        const count = playerCountSelect.value;
        fetchData(flagId, count);
    };
}
