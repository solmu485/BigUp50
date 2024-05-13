
//@author walers jean
// Fetch ISS location
fetch('http://api.open-notify.org/iss-now.json')
    .then(response => response.json())
    .then(data => {
        const latitude = data.iss_position.latitude;
        const longitude = data.iss_position.longitude;
        document.getElementById('iss-location').textContent = `Current ISS location: Latitude ${latitude}, Longitude ${longitude}`;
    });