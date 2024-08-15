<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php ZHANOT_Flash_Message::show_message(); ?>
<form method="post" action="<?php echo add_query_arg() ?>">
    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">
                <label for="zhanot_custom_css"><?php _e('Custom CSS', ZHANOT_TEXT_DOMAIN) ?></label>
            </th>
            <td>
                <textarea name="zhanot_custom_css" id="zhanot_custom_css" class="large-text code" dir="ltr" rows="10" cols="10"><?php echo wp_unslash(unserialize(zhanot_get_option('zhanot_custom_css'))); ?></textarea>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="zhanot_custom_js"><?php _e('Custom Js', ZHANOT_TEXT_DOMAIN) ?></label>
            </th>
            <td>
                <textarea name="zhanot_custom_js" id="zhanot_custom_js" class="large-text code" dir="ltr" rows="10" cols="10"><?php echo wp_unslash(unserialize(zhanot_get_option('zhanot_custom_js'))); ?></textarea>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="zhanot_in_post_css"><?php _e('Load Css Show in the content', ZHANOT_TEXT_DOMAIN) ?></label>
            </th>
            <td>
                <input type="checkbox" id="zhanot_in_post_css" name="zhanot_in_post_css" value="1"<?php echo zhanot_get_option('zhanot_in_post_css') == '1' ? ' checked="checked"' : ''; ?>>
                <label for="zhanot_in_post_css"><?php _e('Enable or disable', ZHANOT_TEXT_DOMAIN) ?></label>
            </td>
        </tr>
        </tbody>
    </table>
    <?php
    wp_nonce_field('zhanot_save_general', 'zhanot_general_nonce');
    submit_button(__('Save changes', ZHANOT_TEXT_DOMAIN), 'primary', 'zhanot-save-general-options', true);
    ?>
</form>