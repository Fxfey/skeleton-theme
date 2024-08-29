<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>Skeleton</title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <nav>
            <div class="navbar">
                <a href="#">Example</a>
            </div>
            <div class="hamburger">
                <div class="hamburger-menu">
                    <a class="ham-item" href="#ham">Example Ham</a>
                </div>
                <svg class="ham hamRotate ham-state" viewBox="0 0 100 100" width="80">
                    <path class="line top" d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
                    <path class="line middle" d="m 70,50 h -40" />
                    <path class="line bottom" d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
                </svg>
            </div>
        </nav>
    </header>
