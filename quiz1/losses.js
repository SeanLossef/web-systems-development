// Sean Lossef - losses

$(function() {
    $('.left li.navbutton').click(function(e) {
        let target = $(e.target).attr('data-target');
        $('.right').removeClass('active');
        $('.right#'+target).addClass('active');
    });

    $('.export').click(function() {
        alert($($('.right.active')[0]).html());
    })
});