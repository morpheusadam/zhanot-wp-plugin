<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

function zhanot_wp_register_style($handle, $src, $deps = null, $ver = null, $media = null, $enqueue = true)
{
    if (!empty($handle) && !empty($src)) {
        wp_register_style($handle, $src, $deps, $ver, $media);
        if ($enqueue)
            wp_enqueue_style($handle);
    }
}

function zhanot_wp_register_script($handle, $src, $deps = null, $ver = null, $in_footer = null, $enqueue = true)
{
    if (!empty($handle) && !empty($src)) {
        wp_register_script($handle, $src, $deps, $ver, $in_footer);
        if ($enqueue)
            wp_enqueue_script($handle);
    }
}

function zhanot_wp_enqueue_style($handle)
{
    if (!empty($handle))
        wp_enqueue_style($handle);
}

function zhanot_wp_enqueue_script($handle)
{
    if (!empty($handle))
        wp_enqueue_script($handle);
}

function get_zhanot_functions()
{
    return new ZHANOT_FUNCTIONS();
}

function zhanot_save_general_options()
{
    return get_zhanot_functions()->save_general_options();
}

function zhanot_save_display_options()
{
    get_zhanot_functions()->save_display_options();
}

function zhanot_change_number($num)
{
    return get_zhanot_functions()->change_number($num);
}

function zhanot_check_post_meta_selected_option($meta_key, $selected)
{
    return get_zhanot_functions()->check_post_meta_selected_option($meta_key, $selected);
}

function zhanot_change_jalali_to_gre($date = null, $mod = null)
{
    return get_zhanot_functions()->change_jalali_to_gre($date, $mod);
}

function zhanot_change_gre_to_jalali($date = null, $mod = null)
{
    return get_zhanot_functions()->change_gre_to_jalali($date, $mod);
}

function zhanot_check_jdate_empty($meta_key, $mod = '/')
{
    return get_zhanot_functions()->check_jdate_empty($meta_key, $mod);
}

function zhanot_get_all_posts_count($post_type)
{
    return get_zhanot_functions()->get_all_posts_count($post_type);
}

function zhanot_show_posts_counter()
{
    return get_zhanot_functions()->show_posts_counter();
}

function zhanot_get_posts_class($post_id)
{
    return get_zhanot_functions()->zhanot_get_posts_class($post_id);
}

function zhanot_update_option($option, $value)
{
    return get_zhanot_functions()->update_option($option, $value);
}

function zhanot_delete_option($option)
{
    return get_zhanot_functions()->delete_option($option);
}

function zhanot_update_post_meta($id, $key, $value)
{
    return get_zhanot_functions()->update_post_meta($id, $key, $value);
}

function zhanot_delete_post_meta($id, $key)
{
    return get_zhanot_functions()->delete_post_meta($id, $key);
}

function zhanot_get_option($key)
{
    return get_zhanot_functions()->get_option($key);
}

function zhanot_get_post_meta($id, $key, $single = false)
{
    return get_zhanot_functions()->get_post_meta($id, $key, $single);
}

function zhanot_change_jalali_args($date, $mod = '/')
{
    return get_zhanot_functions()->zhanot_change_jalali_args($date, $mod);
}

function zhanot_hex2rgba($color, $pid = 0, $opacity = true)
{
    $default = '#fff';
    if (empty($color))
        return $default;
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    if (strlen($color) == 6) {
        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return $default;
    }
    $rgb = array_map('hexdec', $hex);

    if ($opacity) {
        $op = zhanot_get_post_meta($pid, 'zhanot_alert_content_bg_opacity', true);
        $opa = ($op >= 0) ? ',.' . $op : ',1';
        if (!empty($pid))
            $output = 'rgba(' . implode(",", $rgb) . $opa . ')';
    } else {
        $output = 'rgb(' . implode(",", $rgb) . ')';
    }
    return $output;
}

function zhanot_html_status($post_id)
{
    $arr = array(
        'classes' => array(
            1 => 'simple_text zh-simple',
            'product_show zh-pro',
            'post_show zh-post',
            'js_timer zh-timer',
            'socials zh-so',
            'contact_us zh-cu',
            'image_w_url zh-iu',
            'html_content zh-hc',
            'random_text zh-rt'
        ),
        'text' => array(
            1 => __('Text with button', ZHANOT_TEXT_DOMAIN),
            __('Product Introduction', ZHANOT_TEXT_DOMAIN),
            __('Post Introduction', ZHANOT_TEXT_DOMAIN),
            __('Timer', ZHANOT_TEXT_DOMAIN),
            __('Social Network', ZHANOT_TEXT_DOMAIN),
            __('Contact Info', ZHANOT_TEXT_DOMAIN),
            __('Image with Url', ZHANOT_TEXT_DOMAIN),
            __('Html Content', ZHANOT_TEXT_DOMAIN),
            __('Random Text', ZHANOT_TEXT_DOMAIN)
        )
    );
    $type = zhanot_get_post_meta($post_id, 'zhanot_noti_type', true);
    if (intval($post_id)) {
        return "<span class='zh_post_type_noti zhanot_post_type_{$arr['classes'][$type]}'>{$arr['text'][$type]}</span>";
    }
}

/*
 * Short code
 */

function zhanot_shortcode_create($atts)
{
    $atts = shortcode_atts(
        array(
            'id' => '',
        ),
        $atts
    );
    ob_start();
    $posts = get_posts(array(
        'include' => $atts['id'],
        'post_type' => 'zhanot',
        'orderby' => 'post__in',
        'numberposts' => 1
    ));
    foreach ($posts as $post) {
        global $zhanot_loop, $zhanotTempC;
        if ($zhanot_loop->user_option($atts['id']))
            $zhanotTempC->id($atts['id'])->show_template();
    }
    return ob_get_clean();
}
add_shortcode('zhanot', 'zhanot_shortcode_create');