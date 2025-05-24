<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

class Styles
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueStyles']);
        add_action('login_head', [__CLASS__, 'enqueueLogin']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueueHeadless'], 10, 1);
    }

    public static function runEnqueue($fileName)
    {
        wp_enqueue_style(
            "$fileName-style",
            THEME_BASE . "/css/$fileName.css",
            [],
            filemtime(THEME_PATH . "/css/$fileName.css")
        );
    }

    public static function enqueueStyles()
    {
        self::runEnqueue('global');
        self::runEnqueue('typography');
        self::runEnqueue('404');
    }

    public static function enqueueLogin()
    {
        // Include global & typography style
        self::runEnqueue('global');
        self::runEnqueue('typography');
        self::runEnqueue('login');
    }

    public static function enqueueHeadless($hook)
    {
        // Only load on our specific admin page
        if ($hook !== 'toplevel_page_skelix-headless-api') {
            return;
        }

        // Include global & typography style
        self::runEnqueue('global');
        self::runEnqueue('typography');
        self::runEnqueue('headless');
    }
}
