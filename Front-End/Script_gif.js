<!--@author Taulant Halimi -->
$(document).ready(function() {
    $("#searchButton").click(function() {
        console.log("Test");
        let searchQuery = $("#searchInput").val();
        if (searchQuery !== "") {
            $.ajax({
                url: "Back-End/backend_gif.php",
                type: "GET",
                data: { query: searchQuery },
                success: function(response) {
                    $("#gifContainer").html(response);
                }
            });
        }
    });
});
