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
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue404']);
        add_action('login_head', [__CLASS__, 'enqueueLogin']);
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

    public static function enqueue404()
    {
        if (is_404()) {
            wp_enqueue_style(
                '404-style',
                THEME_BASE . '/css/404.css',
                [],
                filemtime(THEME_PATH . '/css/404.css')
            );
        }
    }

    public static function enqueueLogin()
    {
        wp_enqueue_style(
            'login-style',
            THEME_BASE . '/css/login.css',
            [],
            filemtime(THEME_PATH . '/css/login.css')
        );

        // Include global style
        self::enqueueGlobalStyle();
    }
}
