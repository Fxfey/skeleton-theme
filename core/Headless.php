<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

use WP_REST_Request;
use WP_REST_Response;
use DOMDocument;

class Headless
{
    public static function init()
    {
        self::registerMenuPage();
        add_filter('admin_head', [__CLASS__, 'removeAdminFooterText']);
        add_action('rest_api_init', [__CLASS__, 'optionsRouter']);
        add_action('rest_api_init', [__CLASS__, 'registerDynamicEndpoints']);
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
    public static function optionsRouter()
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

    public static function registerDynamicEndpoints()
    {
        if (!get_option('skelix-headless-api-status')) {
            return;
        }

        $postTypes = get_post_types(['public' => true]);

        foreach ($postTypes as $type) {
            register_rest_route(
                'skelix/v1',
                $type,
                [
                    'methods' => 'GET',
                    'callback' => [__CLASS__, 'getDynamicPostData'],
                    'permission_callback' => '__return_true'
                ]
            );
        }
    }

    public static function getDynamicPostData(WP_REST_Request $request)
    {
        $route = $request->get_route();
        $postType = str_replace('/skelix/v1/', '', $route);

        $postId = $request->get_param('post_id') ?? 0;

        // Get post type from the URL and dynamically fetch posts
        // TODO Params for:
        // TODO Paged
        // TODO Page No
        // TODO ID Specific
        $posts = get_posts([
            'numberposts' => 0,
            'posts_per_page' => 0,
            'paged' => 1,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'post_type'   => $postType,
            'include' => $postId
        ]);


        $parsedPosts = [];
        foreach ($posts as $post) {
            $currentPost = [];

            $parsedBlocks = parse_blocks($post->post_content);

            $postContent = [];
            foreach ($parsedBlocks as $block) {
                if (!$block['blockName']) {
                    continue;
                }

                $blockName = str_replace('core/', '', $block['blockName']);
                $blockContent = strip_tags(trim($block['innerHTML']));

                if ($blockName === 'heading') {
                    $blockName = self::parseHeadingBlock($block['innerHTML']);
                } elseif ($blockName === 'list') {
                    $blockContent = self::parseListBlock($block['innerBlocks']);
                } elseif ($blockName === 'image') {
                    $blockContent = self::parseImageBlock($block['attrs']['id']);
                }

                $currentBlock = [
                    'blockName' => $blockName,
                    'blockContent' => $blockContent,
                ];

                $postContent[] = $currentBlock;
            }

            $user = get_user_by('ID', $post->post_author);

            $currentPost = [
                'post_id' => $post->ID,
                'post_title' => $post->post_title,
                'post_content' => $postContent,
                'author' => $user->data->display_name,
                'date_posted' => $post->post_date,
                'date_modified' => $post->post_modified,
            ];

            $parsedPosts[] = $currentPost;
        }
        return $parsedPosts;
    }

    public static function parseHeadingBlock($theHeading)
    {
        $html = trim($theHeading);
        if (empty($html)) {
            return null;
        }

        $dom = new DOMDocument();
        $dom->loadHTML($html);

        $tags = $dom->getElementsByTagName('*');
        foreach ($tags as $tag) {
            if ($tag->tagName === 'html' || $tag->tagName === 'body') {
                continue;
            }
            return strtolower($tag->tagName); // e.g. "h2"
        }

        return null; // if no heading tag is found
    }

    public static function parseListBlock($theList)
    {
        $list = [];
        foreach ($theList as $listItem) {
            $list[] = strip_tags(trim($listItem['innerHTML']));
        }
        return $list;
    }


    public static function parseImageBlock($imageId)
    {
        $imageMetaData = wp_get_attachment_metadata($imageId);
        $uploadsDirectory = wp_get_upload_dir()['baseurl'];

        $imageUrls = [
            'original' => $uploadsDirectory . '/' . $imageMetaData['file']
        ];

        $imageSizes = ['thumbnail', 'medium', 'large'];
        foreach ($imageSizes as $size) {
            if (isset($imageMetaData['sizes'][$size])) {
                $imageUrls[$size] = $uploadsDirectory . '/' . substr($imageMetaData['file'], 0, 8) . $imageMetaData['sizes'][$size]['file'];
            }
        }

        return $imageUrls;
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
