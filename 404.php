<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dd
 */

get_header();

?>

<section class="not-found-wrapper">
    <header class="not-found-header">
        <h1>404 <span class="not-found-header-span">|</span> Oops! That page can&rsquo;t be found.</h1>
    </header>
    <div class="not-found-body">
        <p>It looks like nothing was found at this location.</p>
        <a href="/" class="not-found-return">Take me back</a>
    </div>
</section>

<?php
get_footer();
