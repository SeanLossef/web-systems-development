$(document).ready(function () {
    
    $.fn.hexed = function(settings) {
        // Scoreboard
        if (localStorage.getItem('scoreboard') == null) {
            localStorage.setItem('scoreboard', JSON.stringify([
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
                { name: 'asdf', score: 0, time: 0 },
            ]));
        }

        function storeRecord(name, score, time) {
            let scoreboard = JSON.parse(localStorage.getItem('scoreboard'));
            for (var i = 0; i < 10; i++) {
                if (score > scoreboard[i].score || (score == scoreboard[i].score && time < scoreboard[i].time)) {
                    scoreboard.splice(i, 0, {
                        name: name,
                        score: score,
                        time: time
                    });
                    localStorage.setItem('scoreboard', JSON.stringify(scoreboard.splice(0,10)));
                    return;
                }
            }
        }

        function showScoreboard() {
            let scoreboard = JSON.parse(localStorage.getItem('scoreboard'));
            let innerHTML = '';
            scoreboard.forEach(function(record) {
                innerHTML += "<li>"+record.name+record.score+"</li>";
            });
            $('#scoreboard').html(innerHTML);
        }


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

        let turnsLeft = 3;
        let milliseconds = 0;
        let bestScore = 0;
        let counter;

        // Sets up a new game
        function setup() {
            // set player name + number of turns
            $("#name").text(opts.playerName);
            $("#turns").text(opts.turnNum);

            turnsLeft = opts.turnNum;

            // set up random color
            redRand = Math.floor((Math.random() * 255) + 1);
            greenRand = Math.floor((Math.random() * 255) + 1);
            blueRand = Math.floor((Math.random() * 255) + 1);

            var rgbStr = "rgb(" + redRand + ", " + greenRand + ", " + blueRand + ")";

            $("#swatch").css("background-color", rgbStr.toString());

            bestScore = 0;
            $('#score').html(bestScore);
            $('#secondScore').html("");

            // Reset inputs
            ['red','green','blue'].forEach(function(color) {
                $('#'+color+'Slider').slider('value', 0);
                $('#'+color+'HexVal').val(0);
                $('#'+color+'Feedback').html("");
            });

            $('#newGameButton').hide();
            $('#submitButton').show();

            showScoreboard();

            // Reset timer
            milliseconds = 0;

            // Start game timer
            counter = setInterval(timer, 10);
            function timer() {
                milliseconds += 10;
                $('#timer').html(milliseconds);
            }
        }

        // Called when game has completed
        function gameOver(won) {
            clearInterval(counter);

            $('#newGameButton').show();
            $('#submitButton').hide();
        }

        // Setup inputs for each color
        ['red','green','blue'].forEach(function(color) {
            // on slider change
            $('#'+color+'Slider').slider({
                min: 0,
                max: 255,
            });
            $('#'+color+'Slider').on("slidestop", function(event, ui) {
                let newVal = ui.value;
                $('#'+color+'HexVal').val(parseInt(newVal).toString(16));
            });

            // on text input change
            $('#'+color+'HexVal').change(function() {
                // parse int
                let newVal = parseInt(this.value, 16);
                if (isNaN(newVal))
                    newVal = 0;
                $('#'+color+'Slider').slider('value', newVal);
                $('#'+color+'HexVal').val(newVal.toString(16));
            });
        });

        setup();

        // Submit Button
        $('#submitButton').click(function() {
            // Get guess values
            let redVal = parseInt($('#redHexVal').val(), 16);
            let greenVal = parseInt($('#greenHexVal').val(), 16);
            let blueVal = parseInt($('#blueHexVal').val(), 16);

            // Calculate percent offsets
            let redOffset = Math.round((Math.abs(redRand - redVal) / 255) * 100);
            let greenOffset = Math.round((Math.abs(greenRand - greenVal) / 255) * 100);
            let blueOffset = Math.round((Math.abs(blueRand - blueVal) / 255) * 100);

            // Display offsets
            $('#redFeedback').html(redOffset == 0 ? 'You got it!' : redOffset+'% off');
            $('#greenFeedback').html(greenOffset == 0 ? 'You got it!' : greenOffset+'% off');
            $('#blueFeedback').html(blueOffset == 0 ? 'You got it!' : blueOffset+'% off');

            // Calculate score
            let score = (300 - (redOffset + greenOffset + blueOffset)) * ((20000 - milliseconds) < 0 ? 0 : (20000 - milliseconds));
            $('#secondScore').html("");
            if (score > bestScore)
                bestScore = score;
            else
                $('#secondScore').html(score);
            $('#score').html(bestScore);

            // Correct guess
            if (redOffset == 0 && greenOffset == 0 && blueOffset == 0)
                gameOver(true);

            storeRecord(opts.playerName, score, milliseconds);

            // Decrement turns
            turnsLeft--;
            $("#turns").text(turnsLeft);

            // Game over
            if (turnsLeft == 0)
                gameOver(false);
        });

        // New Game Button
        $('#newGameButton').click(function() {
            setup();
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

