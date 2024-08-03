<?php

/**
* Enqueues the main stylesheet or additional stylesheets.
*
* If no parameter is passed, the main stylesheet is enqueued.
* If a parameter is passed, the specified stylesheet(s) are enqueued.
*
* @param mixed $extraStyles String or array of stylesheet names to be included.
*
* @author Ben 'Fxfey'
*/
function enqueueCustomStyles($extraStyles = null) {
    // Enqueue the main stylesheet
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css');

    // Check if $extraStyles is provided and not empty
    if ($extraStyles) {
        // If $extraStyles is a string, convert it to an array for consistent processing
        if (is_string($extraStyles)) {
            $extraStyles = array($extraStyles);
        }

        // Iterate over each stylesheet and enqueue it
        foreach ($extraStyles as $style) {
            wp_enqueue_style('extra-style-' . $style, get_template_directory_uri() . "/css/$style/$style.css");
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueueCustomStyles');
