<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

class Scripts
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueGlobalScript']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueueHeadless'], 10, 1);
    }

    public static function runEnqueue($fileName)
    {
        wp_enqueue_script(
            "$fileName-script",
            THEME_BASE . "/js/$fileName.js",
            [],
            filemtime(THEME_PATH . "/js/$fileName.js")
        );
    }

    public static function enqueueScripts()
    {
        self::runEnqueue('global');
    }

    public static function enqueueHeadless($hook)
    {
        // Only load on our specific admin page
        if ($hook !== 'toplevel_page_skelix-headless-api') {
            return;
        }

        // Include global & typography style
        self::runEnqueue('global');
        self::runEnqueue('headless');

        // localize nonce
        wp_localize_script('headless-script', 'wpApiSettings', [
            'nonce' => wp_create_nonce('wp_rest'),
        ]);
    }
}
