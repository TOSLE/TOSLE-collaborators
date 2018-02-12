$("#profil-icon").click(function(){
    if($(".profil_menu").css("overflow") == "visible"){
        $(".profil_menu").css("overflow", "hidden");
        $(".content-menu").css({
            "max-height": "0px"
        });
    } else {
        $(".profil_menu").css("overflow", "visible");
        $(".content-menu").css({
            "max-height": "300px"
        });
    }

});