$(document).ready(function() {
    $('.arrow span').click(function() {
        $(this).next().toggleClass('show');
        $(this).children('i').toggleClass('rotate');
    });
});