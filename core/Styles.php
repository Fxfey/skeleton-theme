<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

class Styles
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueGlobalStyle']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueTypography']);
    }

    public static function enqueueGlobalStyle()
    {
        wp_enqueue_style(
            'global-style',
            THEME_BASE . '/css/global.css',
            [],
            filemtime(THEME_PATH . '/css/global.css')
        );
    }

    public static function enqueueTypography()
    {
        wp_enqueue_style(
            'typography-style',
            THEME_BASE . '/css/typography.css',
            [],
            filemtime(THEME_PATH . '/css/typography.css')
        );
    }
}
