$(document).ready(function() {
    $("#searchButton").click(function() {
        let searchQuery = $("#searchInput").val();
        if (searchQuery !== "") {
            $.ajax({
                url: "Backend/backend.php",
                type: "GET",
                data: { query: searchQuery },
                success: function(response) {
                    $("#gifContainer").html(response);
                }
            });
        }
    });
});
