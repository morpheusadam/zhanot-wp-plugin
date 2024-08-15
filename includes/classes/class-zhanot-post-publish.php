<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class ZHANOT_POST_PUBLISH
{
    public $post_type = 'zhanot';
    private static $instance = null;

    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        add_action('add_meta_boxes', array($this, 'postMetaSideBox'));
        add_action('init', array($this, 'scheduleExpiration'));
    }

    public function setPostStatus($new_status, $post_id)
    {
        global $wpdb;
        $query = $wpdb->query($wpdb->prepare("
   	UPDATE `$wpdb->posts` SET `post_status` = %s
   	WHERE `ID` = %d", $new_status, $post_id));

        return $query;
    }

    public function postMetaSideBox()
    {
        add_meta_box(
            'zhanot-expired-box',
            __('Notification Expire', ZHANOT_TEXT_DOMAIN),
            array($this, 'expireBoxCallback'),
            $this->post_type,
            'side',
            'high'
        );
    }

    public function expireBoxCallback()
    {
        global $post_id;
        ?>
        <div class="zhanot-post-expired-meta">
            <div class="zh-field">
                <input type="checkbox" name="zhanot_expiration_status"
                       id="zhanot_expiration_status"<?php echo zhanot_get_post_meta($post_id, 'zhanot_expiration_status', true) ? ' checked' : ''; ?>>
                <label for="zhanot_expiration_status"
                       style="width:auto"><?php _e('Enable Post Expiration', ZHANOT_TEXT_DOMAIN); ?></label>
            </div>
            <div class="zh-field">
                <div class="zh-date-field">
                    <label for="zhanot-date-picker-2"><?php _e('Expire Date', ZHANOT_TEXT_DOMAIN); ?></label>
                    <input type="text" autocomplete="off" name="zhanot_expiration_date" id="zhanot-date-picker-2"
                           value="<?php echo zhanot_check_jdate_empty('zhanot_expiration_date'); ?>">
                    <div class="zh-time-field">
                        <label for="zhanot_expiration_hour"><?php _e('Hour(UTC)', ZHANOT_TEXT_DOMAIN); ?></label>
                        <select name="zhanot_expiration_hour" id="zhanot_expiration_hour">
                            <?php
                            for ($i = 1; $i <= 24; $i++) {
                                if ($i <= 9) { ?>
                                    <option<?php echo zhanot_check_post_meta_selected_option('zhanot_expiration_hour', '0' . $i) ? ' selected' : ''; ?>
                                            value="0<?php echo $i ?>">
                                        0<?php echo $i ?></option>';
                                <?php } elseif ($i == 24) { ?>
                                    <option<?php echo zhanot_check_post_meta_selected_option('zhanot_expiration_hour', '00') ? ' selected' : ''; ?>
                                            value="00">
                                        00
                                    </option>';
                                <?php } else { ?>
                                    <option<?php echo zhanot_check_post_meta_selected_option('zhanot_expiration_hour', $i) ? ' selected' : ''; ?>
                                            value="<?php echo $i ?>"><?php echo $i ?></option>';
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <label for="zhanot_expiration_minute"><?php _e('Minute', ZHANOT_TEXT_DOMAIN); ?></label>
                        <select name="zhanot_expiration_minute" id="zhanot_expiration_minute">
                            <?php
                            for ($i = 0; $i <= 60; $i++) {
                                if ($i == 0) { ?>
                                    <option<?php echo zhanot_check_post_meta_selected_option('zhanot_expiration_minute', '00') ? ' selected' : ''; ?>
                                            value="00">
                                        00
                                    </option>';
                                <?php } elseif ($i <= 9) { ?>
                                    <option<?php echo zhanot_check_post_meta_selected_option('zhanot_expiration_minute', '0' . $i) ? ' selected' : ''; ?>
                                            value="0<?php echo $i ?>">
                                        0<?php echo $i ?></option>';
                                <?php } else { ?>
                                    <option<?php echo zhanot_check_post_meta_selected_option('zhanot_expiration_minute', $i) ? ' selected' : ''; ?>
                                            value="<?php echo $i ?>"><?php echo $i ?></option>';
                                <?php }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="zh-field">
                <label for="zhanot_expiration_event"><?php _e('Event', ZHANOT_TEXT_DOMAIN); ?></label>
                <select name="zhanot_expiration_event" id="zhanot_expiration_event">
                    <option<?php echo zhanot_get_post_meta($post_id, 'zhanot_expiration_event', true) == 'delete' ? ' selected' : ''; ?>
                            value="delete"><?php _e('Delete', ZHANOT_TEXT_DOMAIN); ?></option>
                    <option<?php echo zhanot_get_post_meta($post_id, 'zhanot_expiration_event', true) == 'trash' ? ' selected' : ''; ?>
                            value="trash"><?php _e('Trash', ZHANOT_TEXT_DOMAIN); ?></option>
                    <option<?php echo zhanot_get_post_meta($post_id, 'zhanot_expiration_event', true) == 'draft' ? ' selected' : ''; ?>
                            value="draft"><?php _e('Draft', ZHANOT_TEXT_DOMAIN); ?></option>
                </select>
            </div>
        </div>
        <?php
    }

    public function scheduleExpiratorEvent($id, $ts, $opts)
    {

    }

    public function unscheduleExpiratorEvent($post_id)
    {

    }

    public function scheduleExpiration()
    {

    }
}

ZHANOT_POST_PUBLISH::get_instance();