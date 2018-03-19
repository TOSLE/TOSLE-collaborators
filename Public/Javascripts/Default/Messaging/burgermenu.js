$("#close-burgermenu").click(function(){
    $("#fade-background-burgermenu").css("opacity", "0");
    $("#left-column").css("opacity", "0");
    setTimeout(function(){
        $("#fade-background-burgermenu").css("width", "0");
        $("#left-column").css("width", "0");
    }, 200);

});
$("#open-burgermenu").click(function(){
    if(screen.width < 420){
        $("#left-column").css("width", "650px");
    } else {
        $("#left-column").css("width", "350px");
    }
    $("#fade-background-burgermenu").css("width", "100%");
    setTimeout(function(){
        $("#fade-background-burgermenu").css("opacity", "1");
        $("#left-column").css("opacity", "1");
    }, 200);

});

$(window).resize(function(){
    if($(window).width() > 1230){
        $("#left-column").removeAttr("style");
    }
});