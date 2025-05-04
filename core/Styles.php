<?php

namespace SkeletonTheme;

class Styles
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueGlobalStyle']);
    }

    public static function enqueueGlobalStyle()
    {
        error_log('enqueueGlobalStyle called'); // More reliable than echo
        wp_enqueue_style(
            'global-style',
            THEME_BASE . '/css/global.css',
            [],
            filemtime(THEME_PATH . '/css/global.css')
        );
    }
}
