<?php
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Core\Files\CSS\Post;
use Elementor\Element_Base;
use Elementor\Element_Column;
use Elementor\Element_Section;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class The_Pack_Custom_CSS 
{
    public static function init()
    {
        add_action( 'elementor/element/after_section_end', [ __CLASS__, 'register_controls' ], 10, 2 );
		add_action( 'elementor/element/parse_css', [ __CLASS__, 'add_post_css' ], 10, 2 );
		add_action( 'elementor/editor/after_enqueue_scripts', [__CLASS__, 'enqueue_editor_scripts'], 10, 2);
    }

	public static function register_controls( Controls_Stack $element, $section_id ) {

		if ( $element instanceof Element_Section || $element instanceof Widget_Base ) {
			$required_section_id = '_section_responsive';
		} elseif ( $element instanceof Element_Column ) {
			$required_section_id = 'section_advanced';
		} else {
			$required_section_id = 'section_page_style';
		}

		if ( $required_section_id !== $section_id ) {
			return;
		}

		$element->start_controls_section(
			'_expand_section_custom_css',
			[
				'label' =>  esc_html__( 'ThePack Custom CSS', 'the-pack-addon' ),
				'tab' => 'section_page_style' === $section_id ? Controls_Manager::TAB_STYLE : Controls_Manager::TAB_ADVANCED,   
			]
		);

		$element->add_control(
			'tp_expand_custom_css',
			[
				'type' => Controls_Manager::CODE,
				'language' => 'css',
				'render_type' => 'ui',
				'separator' => 'none',
			]
		);

		$element->add_control(
			'tp_expand_custom_css_description',
			[
				'raw' => esc_html__( 'Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'the-pack-addon' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$element->end_controls_section();
	}

	/**
	 * @param $post_css Post
	 * @param $element  Element_Base
	 */
	public static function add_post_css( $post_css, $element ) {
		$element_settings = $element->get_settings();

		if ( empty( $element_settings['tp_expand_custom_css'] ) ) {
			return;
		}

		$css = trim( $element_settings['tp_expand_custom_css'] );

		if ( empty( $css ) ) {
			return;
		}
		$css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );

		// Add a css comment
		$css = sprintf( '/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector() ) . $css . '/* End custom CSS */';

		$post_css->get_stylesheet()->add_raw_css( $css );
	}

	public static function enqueue_editor_scripts() {
		wp_enqueue_script('tp-preview-custom', THE_PACK_PLUGIN_URL.'includes/extension/js/editor-support.js', array('jquery'), THE_PACK_PLUGIN_VERSION, true); 
	} 

}

The_Pack_Custom_CSS::init();
