<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}
function zhanot_add_dashboard_widget_function()
{
    global $wp_meta_boxes;
    wp_add_dashboard_widget('zhanot_dashboard_widget', __('Zhanot Notifications', ZHANOT_TEXT_DOMAIN), 'zhanot_dashboard_widget_function');
}

function zhanot_dashboard_widget_function()
{
    $posts = get_posts(array('post_type' => 'zhanot', 'numberposts' => 7));
    echo '<div class="zhanot-in-dashboard">';
    if ($posts):
        echo '<ul class="zhanot-in-dashboard-lists">';
        foreach ($posts as $post) {
            setup_postdata($post);
            $noti_type = zhanot_html_status($post->ID);
            echo '<li style="border-right:3px solid #f0f0f0;padding:6px;">';
            echo '<h1 style="margin:0 0 15px 0;padding: 0;">' . $post->post_title . '</h1>';
            echo '<a href="' . get_edit_post_link($post->ID) . '" target="_blank">' . __('Edit Notification', ZHANOT_TEXT_DOMAIN) . '</a>';
            echo '<span style="border-right:1px solid #e7e7e7;border-left:1px solid #e7e7e7;padding:0 7px;margin:7px;">' . zhanot_change_gre_to_jalali(get_the_time('Y/m/d', $post->ID), '/') . '</span>';
            echo $noti_type;
            if (zhanot_get_post_meta($post->ID, 'zhanot_noti_type', true) == '4') {
                echo $timer_end_date = '<span style="border-right:1px solid #e7e7e7;padding:0 7px;margin-right:7px;" class="zh-dash-timer-end"> ' . __('End', ZHANOT_TEXT_DOMAIN) . ': ' . zhanot_change_gre_to_jalali(zhanot_get_post_meta($post->ID, 'zhanot_post_timer_date', true), '/') . '</span>';
            }
            echo '</li>';
        }
        echo '</ul>';
    else:
        echo '<p style="margin:0">' . __('Active notification not found.', ZHANOT_TEXT_DOMAIN) . '</p>';
    endif;
    echo '</div>';
}
