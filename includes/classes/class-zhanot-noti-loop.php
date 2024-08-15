<?php

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class ZHANOT_NOTI_LOOP
{
    public $post_id;

    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var ZHANOT_NOTI_LOOP The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return ZHANOT_NOTI_LOOP An instance of the class.
     * @since 1.2.0
     * @access public
     *
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function id($post_id)
    {
        $this->post_id = $post_id;
        return $this;
    }

    public function user_option($post_id = null)
    {
        if (empty($post_id)) {
            $post_id = $this->post_id;
        }

        if (!empty($post_id)) {
            $current_user = wp_get_current_user();
            $current_user_role = (string)implode(',', $current_user->roles);
            $show_logged = (bool)get_post_meta($post_id, 'zhanot_post_for_user_roles', true);
            $hide_logged = (bool)get_post_meta($post_id, 'zhanot_post_hide_logged_in_users', true);
            if ($show_logged) {
                $post_roles = (string)implode(',', get_post_meta($post_id, 'zhanot_alert_users_role', true));
                if (!empty($post_roles) && strpos($post_roles, $current_user_role) !== false) {
                    return true;
                }
            } elseif ($hide_logged) {
                if (!is_user_logged_in()) {
                    return true;
                }
            } else {
                return true;
            }
        }

        return false;
    }

    public function show_content()
    {
        if (!empty($this->post_id)):
            if ($this->user_option())
                return do_shortcode('[zhanot id="' . $this->post_id . '"]');
        endif;
    }
}


