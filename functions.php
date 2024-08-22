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

// ------------------------------------------------------------------------------------------------------------------------

/**
* Hides the WordPress version number.
*
* @author Ben 'Fxfey'
*/
function removeWpVersion() {
    return '';
}
add_filter('the_generator', 'removeWpVersion');

// ------------------------------------------------------------------------------------------------------------------------

/**
 * Removes the WordPress version query string from scripts and styles URLs.
 *
 * This function checks if the `ver` query string in the URL matches the current
 * WordPress version and removes it if it does. This helps to obscure the WordPress
 * version used by the site, adding a layer of security by making it harder for attackers
 * to target specific vulnerabilities.
 *
 * @param string $src The source URL of the script or style.
 * @return string The modified source URL without the WordPress version query string.
 *
 * @author Ben 'Fxfey'
 */
function removeWpVersionStrings($src) {
    global $wp_version;
    
    // Parse the query string from the URL into an array
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    
    // Check if the 'ver' query parameter is present and matches the WordPress version
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        // Remove the 'ver' query parameter if it matches the WordPress version
        $src = remove_query_arg('ver', $src);
    }
    
    // Return the modified URL
    return $src;
}

// Apply the function to script and style loader sources to remove the version string
add_filter('script_loader_src', 'removeWpVersionStrings');
add_filter('style_loader_src', 'removeWpVersionStrings');

// ------------------------------------------------------------------------------------------------------------------------

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');
