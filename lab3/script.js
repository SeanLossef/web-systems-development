$(document).ready(function() { 

    // toggles display of subsections on acordp.html
    $("#acordpPage nav a").click (function() {
        var linkTitle = $(this).attr("class");
        var currDisplay = $("#acordpPage div." + linkTitle).css("display");
        if (currDisplay == "block") {
            $(this).css("color", "var(--dark-color2-pa)");
            $("#acordpPage div." + linkTitle).css("display", "none");
            $("#acordpPage #aboutMe").css("display", "block");
        }
        else {
            $("#acordpPage nav a").css("color", "var(--dark-color2-pa)");
            $("#acordpPage #aboutMe").css("display", "none");
            $("#acordpPage div.Education").css("display", "none");
            $("#acordpPage div.WorkExperience").css("display", "none");
            $("#acordpPage div.Skills").css("display", "none");

            $("#acordpPage div." + linkTitle).css("display", "block");
            $(this).css("color", "var(--light-color2-pa)");
        }
    });


    // toggles display of subsections on losses.html
    $("#losses nav a").click (function() {
        var targetId = $(this).attr("class");
        $('.content > div').addClass('hidden');
        $('#'+targetId).removeClass('hidden');
    });

    

});