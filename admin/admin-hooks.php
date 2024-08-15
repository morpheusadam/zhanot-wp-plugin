<?php
/*
 * add_action( 'wp_ajax_zhanot_preview_action', 'zhanot_show_preview_callback' );
add_action( 'wp_ajax_nopriv_zhanot_preview_action', 'zhanot_show_preview_callback' );
*/
add_action('add_meta_boxes', 'zhanot_register_notifications_meta_boxes');
add_action('init', 'zhanot_register_post_type');
add_action('init', 'zhanot_unregister_post_type_taxonomy');
add_filter('manage_zhanot_posts_columns', 'zhanot_columns_head', 10);
add_action('manage_zhanot_posts_custom_column', 'zhanot_columns_content', 10, 2);
add_action('admin_init', 'remove_column_init');
add_action('admin_menu', 'zhanot_plugin_menu');
add_action('wp_before_admin_bar_render', 'zhanot_show_admin_bar');
add_action('wp_dashboard_setup', 'zhanot_add_dashboard_widget_function');
add_action('admin_head', 'zhanot_custom_mce_buttons');
add_action('widgets_init', function () {
    register_widget('zhanot_show_posts_widget');
});
add_action('init', 'zhanot_installer_init');
/**
 * Initialize function for class and hook it to wordpress init action
 */
function zhanot_installer_init()
{
    $settings = [
        'name' => '<strong>' . __('Zhanot', 'zhanot') . '</strong>',
        'slug' => 'zhanot_guard',
        'parent_slug' => 'edit.php?post_type=zhanot',
        'text_domain' => 'zhanot',
        'product_token' => '483ebd70-eb4e-4ca2-99b2-2e1c92d3eb7e',
        'option_name' => 'zhanot_guard_register_settings'
    ];
    if (class_exists('Zhanot_License')) {
        Zhanot_License::instance($settings);
        if (Zhanot_License::is_activated() !== true) {
            if (is_admin()) {
                if (isset($_GET['post_type']) && $_GET['post_type'] == ZHANOT_TEXT_DOMAIN) {
                    if (isset($_GET['page']) && $_GET['page'] == 'zhanot_guard') {
                        return;
                    }
                    wp_die(__('Please enter the license key of the ZHANOT plugin.', ZHANOT_TEXT_DOMAIN));
                }
                if (isset($_GET['post']) && get_post_type($_GET['post']) == 'zhanot') {
                    wp_die(__('Please enter the license key of the ZHANOT plugin.', ZHANOT_TEXT_DOMAIN));
                }
            }
        }
    } else {
        if (isset($_GET['post_type']) && $_GET['post_type'] == ZHANOT_TEXT_DOMAIN || isset($_GET['post']) && get_post_type($_GET['post']) == ZHANOT_TEXT_DOMAIN) {
            wp_die(__('Please purchase original version of Zhanot', ZHANOT_TEXT_DOMAIN));
        }
    }
}