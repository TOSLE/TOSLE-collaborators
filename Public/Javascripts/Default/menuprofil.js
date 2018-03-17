$("#profil-icon").click(function(){
    if($("#menu-header-section").css("overflow") == "visible"){
        $("#menu-header-section").css({
            "overflow": "hidden",
            "max-height": "0",
            "opacity": "0"
        });
        $("#arrow-menu").html("&#xE313;");
    } else {
        $("#menu-header-section").css({
            "overflow": "visible",
            "max-height": "600",
            "opacity": "1"
        });
        $("#arrow-menu").html("&#xE5C5;");
    }
});