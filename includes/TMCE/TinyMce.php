<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function zhanot_custom_mce_buttons() {
	// Check if WYSIWYG is enabled
	if ( get_post_type() !== 'zhanot' ) {
		if ( get_user_option( 'rich_editing' ) == 'true' ) {
			add_filter( 'mce_external_plugins', 'zhanot_custom_tinymce_plugin' );
			add_filter( 'mce_buttons', 'zhanot_register_mce_buttons' );
		}
	}
}

// Add the path to the js file with the custom button function
function zhanot_custom_tinymce_plugin( $plugin_array ) {
	$script = "<script type=\"text/javascript\">
 var insert_zhanot_shortcode = [
 {
 type: 'listbox',
 name: 'zhanot_shortcode_textbox',
 minWidth: 350,
 label: '" . esc_html__( 'Select Notification', ZHANOT_TEXT_DOMAIN ) . "',
 values:[";
	$posts  = get_posts( array( 'post_type' => 'zhanot', 'numberposts' => - 1 ) );
	if ( $posts ) {
		foreach ( $posts as $post ) {
			$script .= '{text: \'' . get_the_title( $post->ID ) . '\', value:  \'' . $post->ID . '\'},';
		}
	}
	$script .= "]
 },
];
</script>";
	echo $script;
	$plugin_array['zhanot_add_TMCE_shortcode'] = plugins_url( 'shortcodeSelector.js', __FILE__ );
	
	return $plugin_array;
}

// Register and add new button in the editor
function zhanot_register_mce_buttons( $buttons ) {
	array_push( $buttons, 'zhanot_add_TMCE_shortcode' );
	
	return $buttons;
}
