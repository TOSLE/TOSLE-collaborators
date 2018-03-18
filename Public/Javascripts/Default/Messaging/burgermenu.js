$("#close-burgermenu").click(function(){
    $("#fade-background-burgermenu").css("opacity", "0");
    $("#left-column").css("opacity", "0");
    setTimeout(function(){
        $("#fade-background-burgermenu").css("width", "0");
        $("#left-column").css("width", "0");
    }, 200);

});
$("#open-burgermenu").click(function(){
    $("#fade-background-burgermenu").css("width", "100%");
    $("#left-column").css("width", "350px");
    setTimeout(function(){
        $("#fade-background-burgermenu").css("opacity", "1");
        $("#left-column").css("opacity", "1");
    }, 200);

});