<?php
/**
 * If uninstall.php is not called by WordPress, die
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}
/**
 * Delete plugin data from database on plugin uninstall
 */
delete_option('zhanot_version');
delete_option('zhanot_custom_css');
delete_option('zhanot_custom_js');
delete_option('zhanot_in_post_css');
delete_option('zhanot_mobile_mode');
delete_option('zhanot_mobile_mode_bg_color');
delete_option('zhanot_hidden_mobile_counter');
if (is_multisite()) {
    delete_site_option('zhanot_version');
    delete_site_option('zhanot_custom_css');
    delete_site_option('zhanot_custom_js');
    delete_site_option('zhanot_in_post_css');
    delete_site_option('zhanot_mobile_mode');
    delete_site_option('zhanot_mobile_mode_bg_color');
    delete_site_option('zhanot_hidden_mobile_counter');
}