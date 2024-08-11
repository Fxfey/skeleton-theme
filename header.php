<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>Skeleton</title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>

    <!-- Call main stylesheet -->
    <?php enqueueCustomStyles(); ?>

    <!-- Remove WP Version -->
    <?php removeWpVersion(); ?>
</head>

<body>
    <header>
        <nav>
            Nav
        </nav>
    </header>
