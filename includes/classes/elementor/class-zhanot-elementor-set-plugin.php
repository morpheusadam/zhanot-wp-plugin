<?php

namespace ZhanotElementorWidget;
/**
 * Class Zhanot_Elementor_Set_Plugin
 *
 * Main Zhanot_Elementor_Set_Plugin class
 * @since 1.2.0
 */
class Zhanot_Elementor_Set_Plugin
{
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Zhanot_Elementor_Set_Plugin The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return Zhanot_Elementor_Set_Plugin An instance of the class.
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

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts()
    {
    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files()
    {
        include_once ZHANOT_CLASS_PATH . "elementor/class-zhanot-elementor-base.php";
    }

    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets()
    {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();
        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Zhanot_Elementor_Base());
    }

    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct()
    {
        // Register widget scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
        // Register widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
    }
}

Zhanot_Elementor_Set_Plugin::instance();