<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register a new meta box
 */
function zhanot_register_notifications_meta_boxes()
{
    add_meta_box(
        'zhanot-post-shortcode',
        __('Use Zhanot', ZHANOT_TEXT_DOMAIN),
        'zhanot_shortcode_callback',
        'zhanot',
        'side',
        'high'
    );
    add_meta_box(
        'zhanot-noti-content',
        __('Notification Setting', ZHANOT_TEXT_DOMAIN),
        'zhanot_notifications_content_callback',
        'zhanot'
    );
}


function zhanot_shortcode_callback()
{
    ?>
    <label for="zhanot-shortcode" style="width: 100%;display: inline-block;margin: 0 0 15px 0;"><?php _e('Shortcode', ZHANOT_TEXT_DOMAIN) ?></label>
    <input type="text" name="zhanot-shortcode" id="zhanot-shortcode" dir="ltr" value='[zhanot id="<?php echo get_the_id(); ?>"]' size="31" readonly="readonly">
    <p class="description" style="margin-top: 7px;">
        <small><?php _e('Show in Pages and Posts', ZHANOT_TEXT_DOMAIN) ?></small>
    </p>
    <label for="zhanot-shortcode-php" style="width: 100%;display: inline-block;margin: 15px 0 15px 0;"><?php _e('PHP code', ZHANOT_TEXT_DOMAIN) ?></label>
    <code>
        <?php
        $shortcode = '[zhanot id="' . get_the_id() . '"]';
        echo "&lt;?php echo do_shortcode('{$shortcode}') ?&gt;"; ?>
    </code>
    <p class="description" style="margin-top: 7px;">
        <small><?php _e('Display anywhere on the website', ZHANOT_TEXT_DOMAIN) ?></small>
    </p>
    <!--
<div class="zhanot-preview-button">
  <div class="zhanot-preview-loader" style="display: none;">
   در حال ایجاد پیش نمایش...
  </div>
  <input type="hidden" name="zhanot_id" id="zhanot_id" value="<?php echo get_the_ID(); ?>">
  <button type="submit" name="submit_preview">پیش نمایش</button>
 </div>
 <div class="zhanot-admin-popup-overly" style="display: none;">
  <div class="zhanot-popup-wrapper">
   <div class="zhanot-popup-header">
    <h2>پیش نمایش اعلان</h2>
    <div class="zhanot-popup-close"><span class="dashicons dashicons-no-alt"></span></div>
   </div>
   <div class="zhanot-popup-content">
    <div class="zhanot_preview_message"></div>
   </div>
  </div>
 </div>-->
<?php }

/*
function zhanot_show_preview_callback() {
	$zhanot_id = sanitize_text_field( $_POST['zhanot_id'] );
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		echo do_shortcode( '[zhanot id="' . $zhanot_id . '"]' );
		wp_die();
	}
}
*/

/**
 *
 * Post type functions
 *
 */

/**
 * Register Zhanot
 */
function zhanot_register_post_type()
{
    $labels = array(
        'name' => __('Zhanot', ZHANOT_TEXT_DOMAIN),
        'singular_name' => __('Zhanot', ZHANOT_TEXT_DOMAIN),
        'menu_name' => __('Zhanot', ZHANOT_TEXT_DOMAIN),
        'name_admin_bar' => __('Zhanot', ZHANOT_TEXT_DOMAIN),
        'add_new' => __('New Notification', ZHANOT_TEXT_DOMAIN),
        'add_new_item' => __('Add new notification', ZHANOT_TEXT_DOMAIN),
        'new_item' => __('New Notification', ZHANOT_TEXT_DOMAIN),
        'edit_item' => __('Edit Notification', ZHANOT_TEXT_DOMAIN),
        'view_item' => __('View Notification', ZHANOT_TEXT_DOMAIN),
        'all_items' => __('All Notifications', ZHANOT_TEXT_DOMAIN),
        'search_items' => __('Search Notifications', ZHANOT_TEXT_DOMAIN),
        'parent_item_colon' => __('Parent Notification', ZHANOT_TEXT_DOMAIN),
        'not_found' => __('Not Found Notifications!', ZHANOT_TEXT_DOMAIN),
        'not_found_in_trash' => __('No notification found in trash', ZHANOT_TEXT_DOMAIN),
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Notifications', ZHANOT_TEXT_DOMAIN),
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'zhanot'),
        'capability_type' => 'page',
        'map_meta_cap' => true,
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 35,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-megaphone',
        'taxonomies' => array('zhanot-cats'),
        'exclude_from_search' => true,
    );
    register_post_type('zhanot', $args);
}

/*
 * Register post type columns
 */
function zhanot_columns_head($defaults)
{
    $defaults['zhanot_shortcode'] = __('Shortcode', ZHANOT_TEXT_DOMAIN);
    $defaults['zhanot_notification_type'] = __('Notification Type', ZHANOT_TEXT_DOMAIN);

    //$defaults['zhanot_expiration']        = __( 'Notification Expire', ZHANOT_TEXT_DOMAIN );
    return $defaults;
}

/*
 *  Columns content
 * */
function zhanot_columns_content($column, $post_id)
{
    if ($column == 'zhanot_shortcode') {
        echo '<span>[zhanot id="' . $post_id . '"]</span>';
        if (zhanot_get_post_meta($post_id, 'zhanot_post_auto_load', true)) {
            echo '<br><p style=" display: inline-block; margin-top: 12px; color: #36d81a; letter-spacing: normal !important; border: 1px solid; padding: 3px 8px; border-radius: 3px; ">' . __('Auto Show', ZHANOT_TEXT_DOMAIN) . '</p>';
        }
    }
    if ($column == 'zhanot_notification_type') {
        echo zhanot_html_status(get_the_id());
    }
    /*if ( $column == 'zhanot_expiration' ) {
        if ( get_post_meta( $post_id, 'zhanot_expiration_status', true ) ) {
            $date  = get_post_meta( $post_id, 'zhanot_expiration_date', true );
            $title = get_post_meta( $post_id, 'zhanot_expiration_hour', true ) . ':' . get_post_meta( $post_id, 'zhanot_expiration_minute', true );
            echo '<div class="zh-ex-status enable" style="color:#1fd02e">' . __( 'Enable', ZHANOT_TEXT_DOMAIN ) . '</div>';
            if ( get_locale() == 'fa_IR' ) {
                echo '<abbr title="' . zhanot_change_gre_to_jalali( $date, '/' ) . ' ' . $title . '">' . zhanot_change_gre_to_jalali( $date, '/' ) . '</abbr>';
            } else {
                echo '<abbr title="' . $date . '">' . $date . '</abbr>';
            }
        } else {
            echo '<div class="zh-ex-status disable" style="color:#ff0000">' . __( 'Disable', ZHANOT_TEXT_DOMAIN ) . '</div>';
        }
    }*/
}

/*
 * Remove column in zhanot post type
 */
function remove_manage_columns($columns)
{
    unset($columns['views']);

    return $columns;
}

function remove_column_init()
{
    add_filter('manage_zhanot_posts_columns', 'remove_manage_columns');
}

/*
 *  UnRegister taxonomy
 */
function zhanot_unregister_post_type_taxonomy()
{
    unregister_taxonomy('zhanot-cats');
}
