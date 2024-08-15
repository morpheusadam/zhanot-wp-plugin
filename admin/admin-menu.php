<?php
/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function zhanot_plugin_menu() {
    add_submenu_page(
        'edit.php?post_type=zhanot',
        __( 'settings', ZHANOT_TEXT_DOMAIN ),
        __( 'settings', ZHANOT_TEXT_DOMAIN ),
        'manage_options',
        'zhanot-options',
        'zhanot_options_menu_page'
    );
}

function zhanot_show_admin_bar() {
    global $wp_admin_bar;
    if ( current_user_can( 'administrator' ) ) {
        $wp_admin_bar->add_menu( array(
            'parent' => 0,
            'id'     => 'zhanot-posts-admin-bar',
            'title'  => __( 'Zhanot Notifications', ZHANOT_TEXT_DOMAIN ),
            'href'   => admin_url( 'edit.php?post_type=zhanot' )
        ) );
    }
}

function zhanot_options_menu_page() {
    ?>
    <div class="zhanot-warp wrap">
        <h2><?php _e( 'Zhanot Notifications Settings', ZHANOT_TEXT_DOMAIN ) ?></h2>
        <nav class="nav-tab-wrapper">
            <?php
            foreach ( zhanot_allowed_tab() as $tab_key => $tab_label ) {
                echo '<a href="' . esc_url( add_query_arg( array( 'tab' => $tab_key ) ) ) . '" class="nav-tab ' . zhanot_get_active_class( $tab_key ) . '">' . $tab_label . '</a>';
            }
            ?>
        </nav>
        <?php zhanot_get_tab_content(); ?>
    </div>
    <?php
}

function zhanot_allowed_tab() {
    return array(
        'general' => __( 'General', ZHANOT_TEXT_DOMAIN ),
        'display' => __( 'Display Mode', ZHANOT_TEXT_DOMAIN ),
        'help'    => __( 'Help', ZHANOT_TEXT_DOMAIN ),
    );
}

function zhanot_get_tab_content() {
    $file = ZHANOT_INC_PATH . 'settings/' . zhanot_get_active_tab() . '.php';
    if ( is_file( $file ) && file_exists( $file ) ) {
        $save_function = 'zhanot_save_' . str_replace( '-', '_', zhanot_get_active_tab() ) . '_options';
        if ( function_exists( $save_function ) ) {
            call_user_func( $save_function );
        }
        include $file;
    }
}

function zhanot_get_active_tab() {
    $tab = array_keys( zhanot_allowed_tab() )[0];
    if ( isset( $_GET['tab'] ) && in_array( $_GET['tab'], array_keys( zhanot_allowed_tab() ) ) ) {
        $tab = $_GET['tab'];
    }

    return $tab;
}

function zhanot_get_active_class( $tab ) {
    return zhanot_get_active_tab() == $tab ? 'nav-tab-active' : null;
}