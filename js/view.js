
$(document).ready(function() {
    $("#SelectLake").hide();
    $("#SelectLure").hide();
});

$("#SelectLakeLink").live('click', function() {
    if ($("#SelectLake").is(":hidden"))
        $("#SelectLake").fadeIn();
    else
        $("#SelectLake").fadeOut();
});

$("#SelectLureLink").live('click', function() {
    if ($("#SelectLure").is(":hidden"))
        $("#SelectLure").fadeIn();
    else
        $("#SelectLure").fadeOut();
});