<?php

namespace SkeletonTheme;

if (!defined('ABSPATH')) {
    exit;
}

use WP_Error;

class Security
{
    public static function init()
    {
        self::disableXMLRPC();
        self::removeVersionNumber();
        self::limitLoginAttempts();
    }

    public static function disableXMLRPC()
    {
        // Fallback override
        add_action('init', function () {
            if (strpos($_SERVER['REQUEST_URI'], 'xmlrpc.php') !== false) {
                http_response_code(403);
                exit('XML-RPC is disabled.');
            }
        });
    }

    public static function removeVersionNumber()
    {
        remove_action('wp_head', 'wp_generator');
    }

    public static function limitLoginAttempts()
    {
        $attemptLimit = 5;
        $lockoutMinutes = 15;

        // CONFIG
        if (!defined('MAX_LOGIN_ATTEMPTS')) {
            define('MAX_LOGIN_ATTEMPTS', $attemptLimit);
        }

        if (!defined('LOCKOUT_DURATION')) {
            define('LOCKOUT_DURATION', $lockoutMinutes * MINUTE_IN_SECONDS);
        }

        if (!defined('LOCKOUT_MESSAGE')) {
            define('LOCKOUT_MESSAGE', '<strong>Error: </strong>Too many login attempts.<br>Please try again in 15 minutes.');
        }

        // On failed login
        add_action('wp_login_failed', function () {
            $key = 'failed_login_' . md5($_SERVER['REMOTE_ADDR']);

            $attempts = (int) get_transient($key);
            $attempts++;

            set_transient($key, $attempts, LOCKOUT_DURATION);
        });

        // Check attempts on login error
        add_filter('login_errors', function ($error) {
            if (self::tooManyLoginAttempts()) {
                return LOCKOUT_MESSAGE;
            }

            return $error;
        });

        add_filter('authenticate', function ($user, $username, $password) {
            if (self::tooManyLoginAttempts()) {
                return new WP_Error('too_many_attempts', LOCKOUT_MESSAGE);
            }

            return $user;
        }, 30, 3);

        // Reset on success
        add_action('wp_login', function ($username, $user) {
            $key = 'failed_login_' . md5($_SERVER['REMOTE_ADDR']);
            delete_transient($key);
        }, 10, 2);
    }

    private static function tooManyLoginAttempts()
    {
        $key = 'failed_login_' . md5($_SERVER['REMOTE_ADDR']);

        $attempts = (int) get_transient($key);

        if ($attempts >= MAX_LOGIN_ATTEMPTS) {
            return true;
        }

        return false;
    }
}
