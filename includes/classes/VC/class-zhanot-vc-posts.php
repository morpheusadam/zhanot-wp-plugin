<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class Zhanot_Vc_Posts extends WPBakeryShortCode
{
    public function __construct()
    {
        add_action('init', array($this, 'vc_mapping'));
    }

    public function vc_mapping()
    {
        // Stop all if VC is not enabled
        if (!defined('WPB_VC_VERSION')) {
            return;
        }
        vc_map(
            array(
                'name' => __('Zhanot Notification', ZHANOT_TEXT_DOMAIN),
                'base' => 'zhanot',
                'description' => __('Add notifications', ZHANOT_TEXT_DOMAIN),
                'category' => __('Zhanot', ZHANOT_TEXT_DOMAIN),
                'icon' => ZHANOT_IMG_URL . 'vc-icon.png',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __('Notification ID', ZHANOT_TEXT_DOMAIN),
                        'param_name' => 'id',
                    ),
                )
            )
        );
    }
}
