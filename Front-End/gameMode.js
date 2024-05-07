//@author walers jean

// Make an AJAX request to the backend PHP script
src="https://code.jquery.com/jquery-3.6.0.min.js";
    $.ajax({
    url: '../Back-End/fetch_gameModes.php',
    type: 'GET',
    dataType: 'json',
    success: function (imageData) {
        // Create HTML content using the image data
        var htmlContent = '';
        $.each(imageData, function (index, image) {
            htmlContent += '<div class="image-item">';
            htmlContent += '<img src="' + image.url + '" alt="' + image.name + '">';
            htmlContent += '<p class="image-name">' + image.name + '</p>';
            htmlContent += '</div>';
        });

        // Insert the HTML content into the #output container
        $('#output').html(htmlContent);
    },
    error: function (xhr, status, error) {
        console.error('Request failed: ' + status);
    }
});