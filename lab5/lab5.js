$(document).ready(function () {
    
    $.fn.hexed = function(settings) {
        // default settings
        var opts = $.extend( {}, $.fn.hexed.defaults, settings );

        // Validate options
        if (typeof opts.playerName !== 'string'
            || typeof opts.turnNum !== 'number'
            || opts.turnNum < 1
            || opts.turnNum > 5) {
            console.log('Invalid options!');
            return;
        }

        // set player name + number of turns
        $("#name").text(opts.playerName);
        $("#turns").text(opts.turnNum);

        // set up random color
        redRand = Math.floor((Math.random() * 255) + 1);
        greenRand = Math.floor((Math.random() * 255) + 1);
        blueRand = Math.floor((Math.random() * 255) + 1);

        var rgbStr = "rgb(" + redRand + ", " + greenRand + ", " + blueRand + ")";

        $("#swatch").css("background-color", rgbStr.toString());

        // Setup inputs for each color
        ['red','green','blue'].forEach(function(color) {
            $('#'+color+'Slider').change(function() {
                let newVal = this.value;
                $('#'+color+'HexVal').val(parseInt(newVal).toString(16));
            });
            $('#'+color+'HexVal').change(function() {
                // parse int
                let newVal = parseInt(this.value, 16);
                if (isNaN(newVal))
                    newVal = 0;
                $('#'+color+'Slider').val(newVal);
                $('#'+color+'HexVal').val(newVal.toString(16));
            });
        });

        // Submit Button
        $('#submitButton').click(function() {
            let redVal = parseInt($('#redHexVal').val(), 16);
            let greenVal = parseInt($('#greenHexVal').val(), 16);
            let blueVal = parseInt($('#blueHexVal').val(), 16);

            let redOffset = Math.round((Math.abs(redRand - redVal) / 255) * 100);
            let greenOffset = Math.round((Math.abs(greenRand - greenVal) / 255) * 100);
            let blueOffset = Math.round((Math.abs(blueRand - blueVal) / 255) * 100);

            console.log(redOffset);
            console.log(greenOffset);
            console.log(blueOffset);
        });
        
        return this;
    };
    // Define plugin defaults
    $.fn.hexed.defaults = {
        playerName: "",
        turnNum: 3
    };

    // Run the plugin
    $("#hexedDiv").hexed({
        playerName: 'Sean',
        turnNum: 5
    });

    
});

