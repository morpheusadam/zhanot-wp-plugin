<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class ZHANOT_FUNCTIONS extends ZHANOT_Flash_Message
{
    public function save_general_options()
    {
        if (isset($_POST['zhanot-save-general-options'])) {
            if (!isset($_POST['zhanot_general_nonce']) || !wp_verify_nonce($_POST['zhanot_general_nonce'], 'zhanot_save_general')) {
                exit('Sorry, your nonce did not verify!');
            } else {
                if (!empty($_POST['zhanot_custom_css'])) {
                    zhanot_update_option('zhanot_custom_css', serialize($_POST['zhanot_custom_css']));
                }
                if (!empty($_POST['zhanot_custom_js'])) {
                    zhanot_update_option('zhanot_custom_js', serialize($_POST['zhanot_custom_js']));
                }
                zhanot_update_option('zhanot_in_post_css', $_POST['zhanot_in_post_css']);
                parent::add_message(__('Settings saved successfully.', ZHANOT_TEXT_DOMAIN));
            }
        }
    }

    public function save_display_options()
    {
        if (isset($_POST['zhanot-save-display-options'])) {
            if (!isset($_POST['zhanot_display_nonce']) || !wp_verify_nonce($_POST['zhanot_display_nonce'], 'zhanot_save_display')) {
                exit('Sorry, your nonce did not verify!');
            } else {
                zhanot_update_option('zhanot_mobile_mode', $_POST['zhanot_mobile_mode']);
                zhanot_update_option('zhanot_mobile_mode_bg_color', $_POST['zhanot_mobile_mode_bg_color']);
                zhanot_update_option('zhanot_hidden_mobile_counter', $_POST['zhanot_hidden_mobile_counter']);
                parent::add_message(__('Settings saved successfully.', ZHANOT_TEXT_DOMAIN));
            }
        }
    }

    public function change_number($num)
    {
        $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $per = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        if ('fa_IR' == get_locale()) {
            $result = str_replace($eng, $per, $num);
        } else {
            $result = $num;
        }

        return $result;
    }

    public function check_post_meta_selected_option($meta_key, $selected)
    {
        if (zhanot_get_post_meta(get_the_id(), $meta_key, true) == $selected) {
            return true;
        } else {
            return false;
        }
    }

    public function change_jalali_to_gre($date, $mod)
    {
        $array_date = explode('/', $date);
        $str_date = ZH_jalali_to_gregorian($array_date[0], $array_date[1], $array_date[2], $mod);

        return $str_date;
    }

    public function change_gre_to_jalali($date, $mod)
    {
        $array_date = explode('/', $date);
        $str_date = ZH_gregorian_to_jalali($array_date[0], $array_date[1], $array_date[2], $mod);

        return $str_date;
    }

    public function check_jdate_empty($meta_key, $mod)
    {
        $date = zhanot_get_post_meta(get_the_ID(), $meta_key, true);
        if (!empty($date)) {
            return zhanot_change_gre_to_jalali($date, $mod);
        }

        return false;
    }

    public function get_all_posts_count($post_type)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'posts';
        $posts = $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE post_status='publish' AND post_type='zhanot'");

        return $posts;
    }

    public function show_posts_counter()
    {
        $nologged_query = new WP_Query([
            'post_type' => 'zhanot',
            'post_status' => 'publish',
            'meta_query' => [
                [
                    'key' => 'zhanot_post_hide_logged_in_users',
                    'value' => true,
                    'compare' => '=',
                ],
                [
                    'key' => 'zhanot_post_auto_load',
                    'value' => true,
                    'compare' => '=',
                ],
                [
                    'key' => 'zhanot_post_for_user_roles',
                    'value' => false,
                    'compare' => '=',
                ],
            ],
        ]);
        $logged_query = new WP_Query([
            'post_type' => 'zhanot',
            'post_status' => 'publish',
            'meta_query' => [
                [
                    'key' => 'zhanot_post_for_user_roles',
                    'value' => true,
                    'compare' => '=',
                ],
                [
                    'key' => 'zhanot_post_auto_load',
                    'value' => true,
                    'compare' => '=',
                ],
                [
                    'key' => 'zhanot_post_hide_logged_in_users',
                    'value' => false,
                    'compare' => '=',
                ],
            ],
        ]);
        $auto_load = new WP_Query([
            'post_type' => 'zhanot',
            'post_status' => 'publish',
            'meta_query' => [
                [
                    'key' => 'zhanot_post_auto_load',
                    'value' => true,
                    'compare' => '=',
                ],
            ],
        ]);
        $logged_count = (int)$logged_query->found_posts;
        $nologged_count = (int)$nologged_query->found_posts;
        $all_count = (int)$auto_load->found_posts;
        if (is_user_logged_in()) {
            if ($logged_count != '' || !empty($logged_count) || $logged_count != null) {
                $count = $logged_count;
            } else {
                $count = ($logged_count - $nologged_count) - $all_count;
            }
        } else {
            if ($nologged_count != '' || !empty($nologged_count) || $nologged_count != null) {
                $count = $nologged_count;
            } else {
                $count = ($logged_count - $nologged_count) - $all_count;
            }
        }
        $count = str_replace('-', '', $count);
        $bg_color = !empty(zhanot_get_option('zhanot_mobile_mode_bg_color')) ? ' style="background-color:' . get_option('zhanot_mobile_mode_bg_color') . '"' : '';
        $counter = '';
        if (zhanot_get_option('zhanot_hidden_mobile_counter') != '1') {
            $counter .= '<em>' . $count . '</em>';
        }
        if ($all_count > 0) {
            echo '<div class="zhanot-alerts-open"' . $bg_color . '><span class="zhanot-post-count">' . $counter . '<i class="zhanot-ion-bell-icon shake-animation"></i></span></div>';
        }
    }

    public function zhanot_get_posts_class($post_id)
    {
        $option_b = zhanot_get_post_meta($post_id, 'zhanot_alert_button_color', true);
        $option_t = zhanot_get_post_meta($post_id, 'zhanot_alert_text_button_color', true);
        $option_f = zhanot_get_post_meta($post_id, 'zhanot_alert_text_font_size', true);
        $option_text_color = zhanot_get_post_meta($post_id, 'zhanot_alert_text_color', true);
        $option_button_blank = zhanot_get_post_meta($post_id, 'zhanot_button_url_open_new_page', true);
        $option_timer_bg = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_bg_color', true);
        $option_timer_text_color = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_text_color', true);
        $option_timer_shadow_color = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);

        $btn_color = zhanot_get_post_meta($post_id, 'zhanot_alert_button_color', true);
        $btn_text_color = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);
        $text_font_size = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);
        $text_color = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);
        $button_target = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);
        $timer_bg = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);
        $timer_shadow = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);
        $timer_color = zhanot_get_post_meta($post_id, 'zhanot_alert_timer_shadow_color', true);

        $sticky = (bool)zhanot_get_post_meta($post_id, 'zhanot_sticky_noti', true);
        $array = array(
            'option_b' => (!empty($option_b)) ? 'background:' . $option_b . ' !important;' : '',
            'option_t' => (!empty($option_t)) ? 'color:' . $option_t . ' !important;' : '',
            'option_f' => (!empty($option_f)) ? 'font-size:' . $option_f . 'px;' : '',
            'option_text_color' => (!empty($option_text_color)) ? 'color:' . $option_text_color . ';' : '',
            'option_button_blank' => (!empty($option_button_blank)) ? ' target="_blank"' : '',
            'option_timer_bg' => (!empty($option_timer_bg)) ? 'background:' . $option_timer_bg . ' !important;' : '',
            'option_timer_shadow_color' => (!empty($option_timer_shadow_color)) ? 'box-shadow: 9px 0 20px ' . $option_timer_shadow_color . ' !important;border-color: ' . $option_timer_shadow_color . ' !important;' : '',
            'option_timer_text_color' => (!empty($option_text_color)) ? 'color:' . $option_timer_text_color . ' !important;' : '',
            'btn_color' => (!empty($option_b)) ? 'background:' . $option_b . ' !important;' : '',
            'btn_text_color' => (!empty($option_b)) ? 'color:' . $option_t . ' !important;' : '',
            'text_font_size' => (!empty($option_f)) ? 'font-size:' . $option_f . 'px;' : '',
            'text_color' => (!empty($option_text_color)) ? 'color:' . $option_text_color . ';' : '',
            'button_target' => (!empty($option_button_blank)) ? ' target="_blank"' : '',
            'timer_bg' => (!empty($option_timer_bg)) ? 'background:' . $option_timer_bg . ' !important;' : '',
            'timer_shadow' => (!empty($option_timer_shadow_color)) ? 'box-shadow: 9px 0 20px ' . $option_timer_shadow_color . ' !important;border-color: ' . $option_timer_shadow_color . ' !important;' : '',
            'timer_color' => (!empty($option_text_color)) ? 'color:' . $option_timer_text_color . ' !important;' : '',
            'sticky' => ($sticky) ? ' zhanot-sticky ' : '',
        );
        return $array;
    }

    public function update_option($option, $value)
    {
        return update_option($option, $value);
    }

    public function delete_option($option)
    {
        return delete_option($option);
    }

    public function update_post_meta($id, $key, $value)
    {
        return update_post_meta($id, $key, $value);
    }

    public function delete_post_meta($id, $key)
    {
        return delete_post_meta($id, $key);
    }

    public function get_option($option)
    {
        return get_option($option);
    }

    public function get_post_meta($id, $key, $single)
    {
        return get_post_meta($id, $key, $single);
    }

    public function zhanot_change_jalali_args($date, $mod)
    {
        $date = explode($mod, $date);
        $output = '';
        switch ($date[1]) {
            case 1:
                $date[1] = 'January';
                break;
            case 2:
                $date[1] = 'February';
                break;
            case 3:
                $date[1] = 'March';
                break;
            case 4:
                $date[1] = 'April';
                break;
            case 5:
                $date[1] = 'May';
                break;
            case 6:
                $date[1] = 'June';
                break;
            case 7:
                $date[1] = 'July';
                break;
            case 8:
                $date[1] = 'August';
                break;
            case 9:
                $date[1] = 'September';
                break;
            case 10:
                $date[1] = 'October';
                break;
            case 11:
                $date[1] = 'November';
                break;
            case 12:
                $date[1] = 'December';
                break;
        }
        $new_date = $date[2] . ' ' . $date[1] . ' ' . $date[0];

        return $new_date;
    }
}
