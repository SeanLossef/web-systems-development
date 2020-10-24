$(document).ready(function () {
    
    $.fn.hexed = function(settings) {
        // default settings
        var opts = $.extend( {}, $.fn.hexed.defaults, settings );

        $("#name").text(opts.playerName);
        $("#turns").text(opts.turnNum);
        
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

