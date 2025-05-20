<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

class Roles
{
    public static function init()
    {
        add_action('init', [__CLASS__, 'setRoles']);
        add_filter('editable_roles', [__CLASS__, 'removeExistingRoles'], 10, 1);
    }

    public static function removeExistingRoles($roles)
    {
        return $roles;
    }

    public static function setRoles()
    {
        if (!get_role('client_admin')) {
            // Create Client Admin role
            // self::createClientAdmin();
        }

        if (!get_role('client_editor')) {
            // Create Client Editor role
            // self::createClientEditor();
        }
    }

    // public static function createClientAdmin() {}
}
