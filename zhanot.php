<?php

/**
 * Plugin Name: Zhanot | Advanced Notification Bar WordPress
 * Plugin URI: http://zaino.ir
 * Author: Alireza Dehkar
 * Author URI: http://zaino.ir
 * Version: 3.2
 * Description: allowed to display notifications advanced anywhere website
 * Text Domain: zhanot
 * Domain Path: /languages
 */
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

define('ZHANOT_VERSION', '3.2');
define('ZHANOT_TEXT_DOMAIN', 'zhanot');
define('ZHANOT_PREFIX', 'zhanot_');
define('ZHANOT_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('ZHANOT_URL', trailingslashit(plugin_dir_url(__FILE__)));
define('ZHANOT_INC_PATH', trailingslashit(ZHANOT_PATH . 'includes'));
define('ZHANOT_VIEW_PATH', trailingslashit(ZHANOT_INC_PATH . 'view'));
define('ZHANOT_CLASS_PATH', trailingslashit(ZHANOT_INC_PATH . 'classes'));
define('ZHANOT_ADMIN_PATH', trailingslashit(ZHANOT_PATH . 'admin'));
define('ZHANOT_LIB_PATH', trailingslashit(ZHANOT_INC_PATH . 'lib'));
define('ZHANOT_CSS_URL', trailingslashit(ZHANOT_URL . 'assets/css'));
define('ZHANOT_JS_URL', trailingslashit(ZHANOT_URL . 'assets/js'));
define('ZHANOT_IMG_URL', trailingslashit(ZHANOT_URL . 'assets/images'));
define('ZHANOT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ZHANOT_BASENAME', basename(dirname(__FILE__)));

/**
 *
 * Load plugin core
 *
 */

include_once ZHANOT_PATH . 'core.php';


/**
 *
 *  Plugin core hooks
 *
 */
add_action('wp_enqueue_scripts', 'zhanot_load_ui_assets', 9999);
add_action('admin_enqueue_scripts', 'zhanot_load_admin_assets');
add_action('wp_footer', 'zhanot_wp_footer', 10, 1);
add_action('wp_head', 'zhanot_wp_head');
add_action('init', 'zhanot_load_text_domain');
add_filter('gettext', 'zhanot_get_text', 20, 3);
add_action('plugins_loaded', 'zhanot_include_files', 99999);
register_activation_hook(ZHANOT_PLUGIN_BASENAME, 'zhanot_plugin_activation');

