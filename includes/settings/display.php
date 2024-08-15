<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php ZHANOT_Flash_Message::show_message(); ?>
<form method="post" action="<?php echo add_query_arg() ?>">
 <table class="form-table">
  <tbody>
  <tr>
   <th scope="row">
    <label for="zhanot_mobile_mode"><?php _e( 'Mobile mode', ZHANOT_TEXT_DOMAIN ) ?></label>
   </th>
   <td>
    <input type="checkbox"<?php echo zhanot_get_option( 'zhanot_mobile_mode' ) == '1' ? ' checked="checked"' : ''; ?> name="zhanot_mobile_mode" value="1" id="zhanot_mobile_mode">
   </td>
  </tr>
  <tr>
   <th scope="row">
    <label for="zhanot_mobile_mode_bg_color"><?php _e( 'Background color', ZHANOT_TEXT_DOMAIN ) ?></label>
   </th>
   <td>
    <input type="text" value="<?php echo zhanot_get_option( 'zhanot_mobile_mode_bg_color' ); ?>" name="zhanot_mobile_mode_bg_color" id="zhanot_mobile_mode_bg_color" class="zhanot-color-picker">
   </td>
  </tr>
  <tr>
   <th scope="row">
    <label for="zhanot_hidden_mobile_counter"><?php _e( 'Hidden counter', ZHANOT_TEXT_DOMAIN ); ?></label>
   </th>
   <td>
    <input type="checkbox" name="zhanot_hidden_mobile_counter" id="zhanot_hidden_mobile_counter" value="1"<?php echo zhanot_get_option( 'zhanot_hidden_mobile_counter' ) == '1' ? ' checked' : ''; ?>>
   </td>
  </tr>
  </tbody>
 </table>
	<?php
	wp_nonce_field( 'zhanot_save_display', 'zhanot_display_nonce' );
	submit_button( __( 'Save changes', ZHANOT_TEXT_DOMAIN ), 'primary', 'zhanot-save-display-options', true );
	?>
</form>