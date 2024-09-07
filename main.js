jQuery(document).ready(function($) {
    $('.ham').click(function() {
        $('.ham').toggleClass('active');
        $('.hamburger-menu').css('display', 'flex');
        $('.hamburger-menu').toggleClass('active-menu');
        $('.hamburger-menu').toggleClass('closed');
    });
});