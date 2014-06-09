
$(document).ready(function() {
    $("#SelectLake").hide();
    $("#SelectLure").hide();
    $("#SelectFish").hide();
});

$("#SelectLakeLink").live('click', function() {
    $("#SelectLake").toggle();
});

$("#SelectLureLink").live('click', function() {
    $("#SelectLure").toggle();
});

$("#SelectFishLink").live('click', function() {
    $("#SelectFish").toggle();
});