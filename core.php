<?php
/**
 * Load ui assets
 */
function zhanot_load_ui_assets()
{
    zhanot_wp_register_style('zhanot-loop-css', ZHANOT_CSS_URL . 'in-loop.min.css', null, ZHANOT_VERSION);
    if (zhanot_get_option('zhanot_in_post_css') == '1') {
        zhanot_wp_enqueue_style('zhanot-loop-css');
    }
    zhanot_wp_register_style('zhanot-ui-css', ZHANOT_CSS_URL . 'ui.min.css', null, ZHANOT_VERSION);
    zhanot_wp_register_script('zhanot-ui-js', ZHANOT_JS_URL . 'ui.min.js', ['jquery'], ZHANOT_VERSION, true);
}

/**
 * Load admin assets
 */
function zhanot_load_admin_assets()
{
    if (isset($_GET['post_type']) && $_GET['post_type'] == strtolower(ZHANOT_TEXT_DOMAIN) || isset($_GET['post']) && get_post_type($_GET['post']) == 'zhanot') {
        wp_enqueue_media();
        zhanot_wp_enqueue_style('wp-color-picker');
        zhanot_wp_register_style('persianDatepicker-css', ZHANOT_CSS_URL . 'persianDatepicker.css', null, ZHANOT_VERSION);
        zhanot_wp_register_style('admin-css', ZHANOT_CSS_URL . 'admin.min.css', null, ZHANOT_VERSION);
        zhanot_wp_register_style('zhanot-select2-css', ZHANOT_CSS_URL . 'select2.min.css', null, ZHANOT_VERSION);
        zhanot_wp_register_script('zhanot-select2-js', ZHANOT_JS_URL . 'select2.min.js', ['jquery'], ZHANOT_VERSION, true);
        zhanot_wp_register_script('zhanot-datepicker-js', ZHANOT_JS_URL . 'persianDatepicker.min.js', ['jquery'], ZHANOT_VERSION, true);
        zhanot_wp_enqueue_script('wp-theme-plugin-editor');
        zhanot_wp_enqueue_style('wp-codemirror');
        zhanot_wp_register_script('zhanot-admin-js', ZHANOT_JS_URL . 'admin.min.js', ['jquery', 'wp-color-picker', 'zhanot-datepicker-js'], ZHANOT_VERSION, true);
        wp_localize_script('zhanot-admin-js', 'zhanot_data', ['ajax_url' => admin_url('admin-ajax.php'), 't_select_image' => __('Select Image', ZHANOT_TEXT_DOMAIN), 't_select_placeholder' => __('Click to select options ...', ZHANOT_TEXT_DOMAIN), 'codeEditorJS' => wp_enqueue_code_editor(array('type' => 'text/javascript')), 'codeEditorCss' => wp_enqueue_code_editor(array('type' => 'text/css'))]);
    }
}

/**
 * Load language text domain
 */
function zhanot_load_text_domain()
{
    $locale = apply_filters('plugin_locale', get_locale(), ZHANOT_TEXT_DOMAIN);
    load_textdomain(ZHANOT_TEXT_DOMAIN, trailingslashit(WP_LANG_DIR) . ZHANOT_TEXT_DOMAIN . '/' . ZHANOT_TEXT_DOMAIN . '-' . $locale . '.mo');
    load_plugin_textdomain(ZHANOT_TEXT_DOMAIN, false, basename(dirname(__FILE__)) . '/languages/');
}

/**
 *
 * Auto loader
 *
 */

function zhanot_autoload($class)
{
    $path = null;
    $class = strtolower($class);
    $file = 'class-' . str_replace('_', '-', $class) . '.php';

    // the possible path containing classes
    $paths = array(
        ZHANOT_CLASS_PATH,
        ZHANOT_CLASS_PATH . 'VC/',
        ZHANOT_CLASS_PATH . 'view/',
        ZHANOT_CLASS_PATH . 'widgets/',
    );
    //wp_die($path . $file);
    foreach ($paths as $path) {
        if (is_readable($path . $file)) {
            include_once($path . $file);
            return;
        }
    }
}

/**
 * Include files
 */
function zhanot_include_files()
{
    // Auto-load classes on demand
    if (function_exists("__autoload")) {
        spl_autoload_register("__autoload");
    }
    spl_autoload_register('zhanot_autoload');

    include ZHANOT_LIB_PATH . 'jalali.php';
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    include ZHANOT_INC_PATH . 'functions.php';

    global $zhanot_loop, $zhanot_vc, $zhanot_dashboard, $zhanotTempC;

    $zhanot_loop = ZHANOT_NOTI_LOOP::instance();

    $zhanot_dashboard = new zhanot_show_posts_widget();

    $zhanotTempC = Zhanot_Template_Creator::instance();

    if (is_admin()) {
        include ZHANOT_ADMIN_PATH . 'license.php';
        include ZHANOT_ADMIN_PATH . 'admin-functions.php';
        include ZHANOT_ADMIN_PATH . 'admin-menu.php';
        include ZHANOT_ADMIN_PATH . 'admin-ajax.php';
        include ZHANOT_INC_PATH . 'metas/metas.php';
        include ZHANOT_INC_PATH . 'metas/save.php';
        include ZHANOT_INC_PATH . 'TMCE/TinyMce.php';
        include ZHANOT_CLASS_PATH . 'widgets/dashboard.php';
        include ZHANOT_ADMIN_PATH . 'admin-hooks.php';
    }

    if (is_plugin_active('js_composer/js_composer.php')) {
        $zhanot_vc = new Zhanot_Vc_Posts();
    }
    if (is_plugin_active('elementor/elementor.php')) {
        include ZHANOT_CLASS_PATH . 'elementor/class-zhanot-elementor-set-plugin.php';
    }
}

/**
 * Plugin activation callback
 */
function zhanot_plugin_activation()
{
    if (get_option('zhanot_version') != ZHANOT_VERSION) {
        update_option('zhanot_version', ZHANOT_VERSION);
    }
}

/**
 *  wp head callback
 */
function zhanot_wp_head()
{
    $css_codes = zhanot_get_option('zhanot_custom_css');
    $js_codes = zhanot_get_option('zhanot_custom_js');
    echo '<!-- ZHANOT PLUGIN WP NOTIFICATION BAR VER(' . ZHANOT_VERSION . ') -->' . PHP_EOL;
    echo (!empty($css_codes)) ? '<style id="zhanot-head-inline-css" type="text/css">' . wp_unslash(unserialize($css_codes)) . '</style>' . PHP_EOL : '';
    echo (!empty($js_codes)) ? '<script id="zhanot-head-inline-js" type="text/javascript">' . wp_unslash(unserialize($js_codes)) . '</script>' . PHP_EOL : '';
}

/**
 *  wp footer callback
 */
function zhanot_wp_footer()
{
    if (zhanot_get_all_posts_count('zhanot') >= 1) {
        if (zhanot_get_option('zhanot_mobile_mode') == '1') {
            zhanot_show_posts_counter();
        }
        if (zhanot_get_all_posts_count('zhanot') >= 1) {
            echo '<div id="zhanot-sticky-elements"></div>';
        }
        global $zhanotTempC;
        $zhanotTempC->for_each();
    }
}

/**
 *  wp change translate text
 * @param $translation
 * @param $text
 * @return string|void
 */
function zhanot_get_text($translation, $text, $domain)
{
    if ('zhanot' == get_post_type()) {
        switch ($text) {
            case 'Publish':
                return __('Create', ZHANOT_TEXT_DOMAIN);
                break;
            case 'Post updated.':
                return __('Notification update.', ZHANOT_TEXT_DOMAIN);
                break;
            case 'Post published.':
                return __('Notification published.', ZHANOT_TEXT_DOMAIN);
                break;
        }
    }

    return $translation;
}
