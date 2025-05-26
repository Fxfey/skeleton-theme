<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

class Headless
{
    public static function init()
    {
        self::registerMenuPage();
        add_filter('admin_head', [__CLASS__, 'removeAdminFooterText']);
        add_action('rest_api_init', [__CLASS__, 'router']);
    }

    // Removes the admin footer when on the headless page
    public static function removeAdminFooterText()
    {
        $screen = get_current_screen();

        // Target a specific admin page by slug or ID (e.g., your custom page)
        if ($screen->id === 'toplevel_page_skelix-headless-api') {
            // Remove both parts of the footer
            add_filter('admin_footer_text', '__return_empty_string', 100);
            add_filter('update_footer', '__return_empty_string', 100);
        }
    }

    // Registers the menu in the wp backend
    public static function registerMenuPage()
    {
        add_menu_page(
            'Headless API',
            'Headless API',
            'manage_options',
            'skelix-headless-api',
            [__CLASS__, 'headlessPage'],
            'dashicons-rest-api',
            79
        );
    }

    // API Router
    public static function router()
    {
        register_rest_route(
            'skelix/v1',
            '/headless-status',
            [
                'methods' => 'PUT',
                'callback' => [__CLASS__, 'updateHeadlessApiStatus'],
                'permission_callback' => function () {
                    return is_user_logged_in();
                },
            ]
        );

        register_rest_route(
            'skelix/v1',
            '/headless-status',
            [
                'methods' => 'GET',
                'callback' => [__CLASS__, 'getHeadlessApiStatus'],
                'permission_callback' => function () {
                    return is_user_logged_in();
                },
            ]
        );
    }

    public static function updateHeadlessApiStatus(WP_REST_Request $request): WP_REST_Response
    {
        $toggleStatus = $request->get_param('new_status');
        update_option('skelix-headless-api-status', (bool) $toggleStatus);
        return new WP_REST_Response('Status updated', 200);
    }

    public static function getHeadlessApiStatus(): WP_REST_Response
    {
        $apiStatus = get_option('skelix-headless-api-status');
        return new WP_REST_Response($apiStatus, 200);
    }

    public static function headlessPage()
    {
        get_template_part('template-parts/headless-backend', 'headless-wp-backend');
    }
}
