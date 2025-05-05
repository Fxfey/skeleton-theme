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
    }

    public static function enqueueGlobalScript()
    {
        wp_enqueue_script(
            'global-script',
            THEME_BASE . '/js/global.js',
            ['jquery'],
            filemtime(THEME_PATH . '/js/global.css')
        );
    }
}
