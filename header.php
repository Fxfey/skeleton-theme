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
                <div class="nav-item-container">
                    <div class="nav-item">
                        <a class="nav-link" href="/example">example</a>
                    </div>
                </div>
            </div>
            <div class="hamburger">
                <div class="logo-container">
                    <a href="/" class="site-logo-ham">
                        <img class="site-logo-ham-img" src="<?= get_template_directory_uri() . '/img/logo-nav.png' ?>" alt="">
                    </a>
                </div>
                <div class="hamburger-menu closed">
                    <div class="ham-item">
                        <a class="ham-link" href="/example">example</a>
                    </div>
                </div>
                <div class="ham-icon-container">
                    <svg class="ham hamRotate ham-state" viewBox="0 0 100 100" width="80">
                        <path class="line top" d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
                        <path class="line middle" d="m 70,50 h -40" />
                        <path class="line bottom" d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
                    </svg>
                </div>
            </div>
        </nav>
    </header>
