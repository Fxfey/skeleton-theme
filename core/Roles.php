<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

class Roles
{
    public static function init()
    {
        add_action('admin_menu', [__CLASS__, 'backendMenuCleanUp']);
        add_action('admin_bar_menu', [__CLASS__, 'adminBarCleanUp'], 65);
    }

    public static function backendMenuCleanUp()
    {
        if (current_user_can('editor') && !current_user_can('administrator')) {
            remove_menu_page('edit-comments.php');
            remove_menu_page('tools.php');
            remove_menu_page('edit.php?post_type=acf-field-group');
        }
    }

    public static function adminBarCleanUp($adminBar)
    {
        if (!current_user_can('administrator')) {
            global $wp_admin_bar;
            $wp_admin_bar->remove_node('comments');
        }
        return $adminBar;
    }
}
