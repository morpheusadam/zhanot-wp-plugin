<?php
namespace ZhanotElementorWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *
 * Zhanot widget for Elementor
 *
 * @since 1.0.0
 */
class Zhanot_Elementor_Base extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'zhanot-notification';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Zhanot Notification', ZHANOT_TEXT_DOMAIN );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

  /**
 * Get widget keywords.
 *
 * Retrieve the list of keywords the widget belongs to.
 *
 * @since 2.1.0
 * @access public
 *
 * @return array Widget keywords.
 */
public function get_keywords() {
  return [ 'shortcode', 'code', ZHANOT_TEXT_DOMAIN, 'notification' ];
}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

  /**
	 * Whether the reload preview is required or not.
	 *
	 * Used to determine whether the reload preview is required.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool Whether the reload preview is required.
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'zhanot-in-elementor' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', ZHANOT_TEXT_DOMAIN ),
			]
		);

    $this->add_control(
			'zhanot_el_id',
			[
				'label' => __( 'Enter Shortcode ID', ZHANOT_TEXT_DOMAIN ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => false,
				],
				'placeholder' => '',
				'default' => '',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
   protected function render() {
 		$shortcode = $this->get_settings_for_display( 'zhanot_el_id' );
 		$shortcode = do_shortcode( '[zhanot id="'. $shortcode .'"]' );
 		echo $shortcode;
 	}

  /**
 * Render shortcode widget as plain content.
 *
 * Override the default behavior by printing the shortcode insted of rendering it.
 *
 * @since 1.0.0
 * @access public
 */
public function render_plain_content() {
  $id = $this->get_settings( 'zhanot_el_id' );
  $shortcode = do_shortcode( '[zhanot id="'. $id .'"]' );
  echo $shortcode;
}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {}
}
