<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function zhanot_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$fields = [
		'zhanot_noti_type',
		'zhanot_notification_img',
		'zhanot_alert_bg',
		'zhanot_alert_content_bg',
		'zhanot_alert_content_bg_opacity',
		'zhanot_alert_text_color',
		'zhanot_alert_button_color',
		'zhanot_alert_text_button_color',
		'zhanot_alert_text_font_size',
		'zhanot_simple_textfield',
		'zhanot_product_textfield',
		'zhanot_post_textfield',
		'zhanot_timer_textfield',
		'zhanot_socials_textfield',
		'zhanot_contactus_textfield',
		'zhanot_simple_btn_text',
		'zhanot_product_btn_text',
		'zhanot_post_btn_text',
		'zhanot_timer_btn_text',
		'zhanot_simple_btn_url',
		'zhanot_product_btn_url',
		'zhanot_post_btn_url',
		'zhanot_timer_btn_url',
		'zhanot_product_img',
		'zhanot_product_price',
		'zhanot_product_discount',
		'zhanot_post_img',
		'zhanot_post_timer_end_text',
		'zhanot_post_timer_time',
		'zhanot_alert_timer_bg_color',
		'zhanot_alert_timer_text_color',
		'zhanot_alert_timer_shadow_color',
		'zhanot_post_gplus_url',
		'zhanot_post_pinterest_url',
		'zhanot_post_twitter_url',
		'zhanot_post_ins_url',
		'zhanot_post_github_url',
		'zhanot_post_tg_url',
		'zhanot_post_wapp_url',
		'zhanot_post_in_url',
		'zhanot_post_fb_url',
		'zhanot_post_phone_number',
		'zhanot_post_email',
		'zhanot_image_url_alt_text',
		'zhanot_image_url',
		'zhanot_image_url_external',
		'zhanot_show_only_on',
		/*'zhanot_expiration_hour',
		'zhanot_expiration_minute',
		'zhanot_expiration_event',*/
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
		}
	}
	$top    = ! empty( $_POST['zhanot_alert_margin_top'] ) ? $_POST['zhanot_alert_margin_top'] : '0';
	$right  = ! empty( $_POST['zhanot_alert_margin_right'] ) ? $_POST['zhanot_alert_margin_right'] : '0';
	$bottom = ! empty( $_POST['zhanot_alert_margin_bottom'] ) ? $_POST['zhanot_alert_margin_bottom'] : '0';
	$left   = ! empty( $_POST['zhanot_alert_margin_left'] ) ? $_POST['zhanot_alert_margin_left'] : '0';
	$margin = $top . ',' . $right . ',' . $bottom . ',' . $left;
	update_post_meta( $post_id, 'zhanot_alert_margin', sanitize_text_field( $margin ) );
	if ( ! empty( $_POST['zhanot_post_timer_date'] ) ) {
		$date = zhanot_change_jalali_to_gre( $_POST['zhanot_post_timer_date'], '/' );
		update_post_meta( $post_id, 'zhanot_post_timer_date', esc_attr( $date ) );
	}
	if ( ! empty( $_POST['zhanot_expiration_date'] ) ) {
		$expire = zhanot_change_jalali_to_gre( $_POST['zhanot_expiration_date'], '/' );
		update_post_meta( $post_id, 'zhanot_expiration_date', esc_attr( $expire ) );
	}
	/*
	 *
	 *  SAVE checkbox
	 *
	 */
	// save meta auto load in top site
	( isset( $_POST['zhanot_post_auto_load'] ) && '1' === $_POST['zhanot_post_auto_load'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_post_auto_load', esc_attr( $_POST['zhanot_post_auto_load'] ) );
	// save meta wide container
	( isset( $_POST['zhanot_post_wide'] ) && '1' === $_POST['zhanot_post_wide'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_post_wide', esc_attr( $_POST['zhanot_post_wide'] ) );
	// save meta open url in new tab
	( isset( $_POST['zhanot_button_url_open_new_page'] ) && '1' === $_POST['zhanot_button_url_open_new_page'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_button_url_open_new_page', esc_attr( $_POST['zhanot_button_url_open_new_page'] ) );
	// save meta hide for logged user
	( isset( $_POST['zhanot_post_hide_logged_in_users'] ) && '1' === $_POST['zhanot_post_hide_logged_in_users'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_post_hide_logged_in_users', esc_attr( $_POST['zhanot_post_hide_logged_in_users'] ) );
	// save meta show zhanot for only once
	( isset( $_POST['zhanot_post_show_only_once'] ) && '1' === $_POST['zhanot_post_show_only_once'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_post_show_only_once', esc_attr( $_POST['zhanot_post_show_only_once'] ) );
	// save meta hidde close button
	( isset( $_POST['zhanot_hidden_close_button'] ) && '1' === $_POST['zhanot_hidden_close_button'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_hidden_close_button', esc_attr( $_POST['zhanot_hidden_close_button'] ) );
	// save meta show for user roles
	( isset( $_POST['zhanot_post_for_user_roles'] ) && '1' === $_POST['zhanot_post_for_user_roles'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_post_for_user_roles', esc_attr( $_POST['zhanot_post_for_user_roles'] ) );
	( isset( $_POST['zhanot_sticky_noti'] ) && '1' === $_POST['zhanot_sticky_noti'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_sticky_noti', esc_attr( $_POST['zhanot_sticky_noti'] ) );
	// save meta (array) notification user rols
	$sanitized_data   = array();
	$zhanot_user_role = (array) $_POST['zhanot_alert_users_role'];
	foreach ( $zhanot_user_role as $key => $value ) {
		$sanitized_data[ $key ] = strip_tags( stripslashes( $value ) );
	}
	update_post_meta( $post_id, 'zhanot_alert_users_role', $sanitized_data );
	//update_post_meta( $post_id, 'zhanot_specific_page', $_POST['zhanot_specific_page'] );
	// html content and random content save
	update_post_meta( $post_id, 'zhanot_html_content_textfield', stripslashes( $_POST['zhanot_html_content_textfield'] ) );
	update_post_meta( $post_id, 'zhanot_random_content_textfield', $_POST['zhanot_random_content_textfield'] );
	/*( isset( $_POST['zhanot_show_in_specific_page'] ) && '1' === $_POST['zhanot_show_in_specific_page'] ) ? true : false;
	update_post_meta( $post_id, 'zhanot_show_in_specific_page', esc_attr( $_POST['zhanot_show_in_specific_page'] ) );*/
}

add_action( 'save_post', 'zhanot_save_meta_box' );