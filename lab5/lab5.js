$(document).ready(function () {
    
    $.fn.hexed = function(settings) {
        // default settings
        var opts = $.extend( {}, $.fn.hexed.defaults, settings );

        // set player name + number of turns
        $("#name").text(opts.playerName);
        $("#turns").text(opts.turnNum);

        // set up random color
        redRand = Math.floor((Math.random() * 255) + 1);
        greenRand = Math.floor((Math.random() * 255) + 1);
        blueRand = Math.floor((Math.random() * 255) + 1);
        console.log(redRand, blueRand, greenRand);
        var rgbStr = "rgb(" + redRand + ", " + greenRand + ", " + blueRand + ")";
        console.log(rgbStr);
        $("#swatch").css("background-color", rgbStr.toString());
        
        return this;
    };
    // Define plugin defaults
    $.fn.hexed.defaults = {
        playerName: "YourName",
        turnNum: 3
    };

    // Run the plugin
    $("#hexedDiv").hexed("somejson");

    
});

