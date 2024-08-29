jQuery(document).ready(function($) {
    $('.ham').click(function() {
        $('.ham').toggleClass('active');
        $('.hamburger-menu').toggleClass('active-menu');
    });
});