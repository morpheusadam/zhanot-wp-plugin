<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}
function zhanot_notifications_content_callback()
{
    function zhanot_current_meta_tab_active($selector_value, $type)
    {
        if (zhanot_get_post_meta(get_the_id(), 'zhanot_noti_type', true) == $selector_value) {
            if ($type == 'select') {
                $select = ' selected="selected"';
            } elseif ($type == 'class') {
                $select = ' zhanot_open_tab_meta';
            } elseif ($type == 'radio') {
                $select = ' checked="checked"';
            }
            echo $select;
        }
    }

    function zhanot_current_meta_tab($selector_value)
    {
        if (zhanot_get_post_meta(get_the_id(), 'zhanot_noti_type', true) == $selector_value) {
            return true;
        }

        return false;
    }

    global $post;

    $zhanot_meta_box_check = zhanot_get_post_meta(get_the_id(), 'zhanot_post_auto_load', true);
    $zhanot_meta_box_check_wide = zhanot_get_post_meta(get_the_id(), 'zhanot_post_wide', true);
    $zhanot_url_new_page = zhanot_get_post_meta(get_the_id(), 'zhanot_button_url_open_new_page', true);
    $zhanot_meta_box_check_only = zhanot_get_post_meta(get_the_id(), 'zhanot_post_show_only_once', true);
    $zhanot_hidden_close_button = zhanot_get_post_meta(get_the_id(), 'zhanot_hidden_close_button', true);
    $zhanot_post_for_user_roles = zhanot_get_post_meta(get_the_id(), 'zhanot_post_for_user_roles', true);
    $zhanot_post_hide_logged_in_users = zhanot_get_post_meta(get_the_id(), 'zhanot_post_hide_logged_in_users', true);
    $zhanot_sticky_noti = zhanot_get_post_meta(get_the_id(), 'zhanot_sticky_noti', true);
    $zhanot_show_in_specific_page = zhanot_get_post_meta(get_the_id(), 'zhanot_show_in_specific_page', true);
    $editor_settings = array(
        'media_buttons' => true,
        'tinymce' => array(
            'theme_advanced_buttons1' => 'formatselect,|,bold,italic,underline,|,' . 'bullist,blockquote,|,justifyleft,justifycenter' . ',justifyright,justifyfull,|,link,unlink,|' . ',spellchecker,wp_fullscreen,wp_adv'
        )
    );
    ?>
    <?php include(ZHANOT_INC_PATH . 'metas/panel.php'); ?>
<?php }
